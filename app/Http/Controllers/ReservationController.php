<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Destination;
use App\Http\Requests;
use App\Http\Requests\ReservationRequest;
use Auth;
use DB;

class ReservationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['checkout']]);

        $this->middleware('admin', [
            'only' => [
                'edit', 'create','show','delete', 
                'update'
            ]
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::paginate(20);
        return view('reservations.index', compact('reservations'));
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
    public function store(ReservationRequest $request)
    {
        /**
        * Reservations status 
        * 2 => approved
        * 3 => unavailable 
        */
        $reservation = new Reservation($request->all());
        $reservation->start = date("Y-m-d H:i:s", strtotime($request->date." ".$request->start_time));
        $reservation->end = date("Y-m-d H:i:s", strtotime($request->date." ".$request->end_time));

        if($reservation->save()){
            if(Auth::user()->hasRole('super_admin')){
                $reservations = DB::table('reservations')
                ->select('id', 'date', 'start','end','status')
                ->where('destination_id','=', $request->destination_id);
               return json_encode(array("success" => true, "reservations" => $reservations));
            } else {
                return json_encode(array("success" => false));
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
    public function update(Request $request, $id)
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

    public function details($id) {
        $reservation = Reservation::findOrfail($id);
        return view('reservations.details_modal', compact('reservation'));
    }

    public function checkout(ReservationRequest $request){
        $reservation = Reservation::findOrfail($request->reservation_id);
        return view('reservations.checkout', compact('reservation'));
    }
}
