<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;
use DB;
use App\ChatRoom;
use App\Http\Requests;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{

   public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('admin', [
            'except' => [
                'store', 'edit','create', 'update',
                'destroy', 'index'
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
        $inbox = Message::inbox(Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        $sent =  Message::sent(Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        return view('messages.index', compact('inbox', 'sent'));
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
    public function store(MessageRequest $request)
    {
        $chat_room = new ChatRoom;
        $chat_room->status = 1;

        if($chat_room->save()){
            $message = new Message($request->all());
            $message->room_id = $chat_room->id;
            if($message->save()){
                return "true";
            } 
        }  
        return "false";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        if($message) {
            // get all message between both users 
            $history = Message::all();
            $message->status = 1;
            $message->save();
            $sender = $message->sender;
            $receiver = $message->receiver;
            return view('messages.show', compact('history', 'sender', 'receiver'));
        } else {
            abort(404);
        }
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
}
