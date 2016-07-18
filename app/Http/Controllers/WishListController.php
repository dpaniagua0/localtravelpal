<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\WishListRequest;
use App\WishList;
use App\User;
use App\Destination;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WishListRequest $request)
    {
        $wish_list = new WishList($request->all());   
        $user = User::findOrfail($request->owner_id);
        if($request->ajax()){
            if($wish_list->save()){
                $wish_list->destinations()->attach($request->destination_id);
                return "<p class='alert alert-success'>Added to List</p>";
            } else {
                return "<p class='alert alert-danger'>Oops! something is wrong please try again later.</p>";
            }
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
        //
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
    public function update(WishListRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addTo(Request $request) {
        $wish_list = WishList::find($request->list_id);
        $destination = Destination::find($request->destination_id);
        if($wish_list && $destination){
            $wish_list->destinations()->sync([ $request->destination_id ]);
                return "true";
            
        }
        return "false";
    }
}
