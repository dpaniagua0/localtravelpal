<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Destination;
use App\Http\Requests;
use App\Http\Requests\ReservationRequest;
use Auth;
use DB;
use Srmklive\PayPal\Facades\PayPal as PayPal;
use Srmklive\PayPal\Services\AdaptivePayments;

class ReservationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [ 'except' => 'summary']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('super_admin')){
            $reservations = Reservation::paginate(20);
        //} else {
          
        } else {
            $user_email = Auth::user()->email;
            $reservations = Reservation::byUser($user_email)->paginate(5);
        }
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservations.create');
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

        if($request->status == 2){
            $reservation->css_class = 'bg-available';
        } else {
            $reservation->css_class = 'bg-unavailable';
        }

        if($reservation->save()){
            $reservations = DB::table('reservations')
            ->select('id', 'date', 'start','end','status', 'css_class as className')
            ->where('destination_id','=', $request->destination_id);
            return json_encode(array("success" => true, "reservations" => $reservations));
        } else {
            return json_encode(array('success' => false));
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
        $reservation = Reservation::find($id);
        $start = date("Y-m-d H:i:s", strtotime($request->date." ".$request->start_time));
        $end = date("Y-m-d H:i:s", strtotime($request->date." ".$request->end_time));

        if($request->status == 2){
            $css_class = 'bg-available';
        } else {
            $css_class = 'bg-unavailable';
        }
        $request->offsetSet('css_class', $css_class);
        $request->offsetSet('start', $start);
        $request->offsetSet('end', $end);

        if($reservation->update($request->all())){
            $reservations = DB::table('reservations')
            ->select('id', 'date', 'start','end','status', 'css_class as className')
            ->where('destination_id','=', $request->destination_id);
            return json_encode(array("success" => true, "reservations" => $reservations));
        } else {
            return json_encode(array('success' => false));
        }
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

    public function requestReservation(ReservationRequest $request){
         /**
        * Reservations status 
        * 2 => approved
        * 3 => unavailable 
        */
        $reservation = new Reservation($request->all());
        $res_date = date("Y-m-d", strtotime($request->date));
        $reservation->date = $res_date;
        $reservation->start = date("Y-m-d H:i:s", strtotime($res_date." ".$request->start_time));
        $reservation->end = date("Y-m-d H:i:s", strtotime($res_date." ".$request->end_time));

        if($request->status == 2){
            $reservation->css_class = 'bg-available';
        } else {
            $reservation->css_class = 'bg-unavailable';
        }

        if($reservation->save()){
            return json_encode(array("success" => true));
        } else {
            return json_encode(array('success' => false));
        }
    }

    public function checkout(ReservationRequest $request){
        $reservation = Reservation::find($request->reservation_id);
        $destination = $reservation->destination;
        $provider = $destination->owner;
        if(!$reservation){
            $reservation = new Reservation($request->all());
        }
        return view('reservations.checkout', compact('reservation', 'destination', 'provider'));
    }

    public function processPayment(Request $request){
        $reservation = Reservation::find($request->id);
        if($reservation){
            $primary_receiver = $request->owner_email;
            $feed_receiver = "locopal-payment@locopal.com";
        //  $total_amount = $destination->
        }
    }

    public function preapproved(Request $request) {

        $reservation = Reservation::find($request->id);
        $reservation->is_set = 1;
        //The reservation has been paid.
        $reservation->status = 4;
        $reservation->save();
       
        $provider = new AdaptivePayments(); 

        $destination = $reservation->destination;
        $main_receiver = $destination->owner->email;
        $fee_receiver = "locopal-payment@locopal.com";
       
        $guest = $request->people_qty;
        $price = $reservation->destination->price;
        
        $sub_total = ($price * $guest);
        $fee = ($sub_total * 0.10);
        $total_amount = $sub_total + $fee;
     
        // Change the values accordingly for information
        $data = [
            'receivers'  => [
                [
                    'email' => $main_receiver,
                    'amount' => $total_amount,
                    'primary' => true,
                ],
                [
                    'email' => $fee_receiver,
                    'amount' => $fee,
                    'primary' => false
                ]
            ],
            'payer' => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('/summary'), 
            'cancel_url' => url('/cancel'),
        ];

        $response = $provider->createPayRequest($data);

    
        $redirect_url = $provider->getRedirectUrl('approved', $response['payKey']);

        return redirect($redirect_url);
    }

    public function summary(Request $request){
        return view('reservations.summary');
    }
}
