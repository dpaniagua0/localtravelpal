<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\DestinationRequest;
use App\Destination;
use App\Category;

class DestinationController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['search', 'show']]);

        $this->middleware('admin', ['except' => ['search', 'show']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = Destination::paginate('15');
        return view('destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name','id');
        return view('destinations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationRequest $request)
    {
        $destination = new Destination($request->all());
        if($destination->save() && $destination->categories()->sync($request->category_list)){
            return redirect('destinations');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $destination = Destination::findOrfail($id);
        return view('destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DestinationRequest $request, $id)
    {
        //
    }

    public function search(Request $request) {
      
        $query = $request->search;
        $destinations = Destination::byLocation($request->search)->get();
        return view('destinations.search', compact('destinations', 'query'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destination = Destination::findOrfail($id);
        if($destination){
            if($destination->delete()){
                return redirect('destinations');
            }
        }
    }
}
