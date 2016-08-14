<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'message',
       'sender_id',
       'receiver_id'
    ];


    public function scopeInbox($query, $user_id){
      return $query->where('receiver_id', '=', $user_id);
    }

    public function scopeSent($query, $user_id){
      return $query->where('sender_id', '=', $user_id);
    }

    public function sender(){
      return $this->belongsTo('App\User', 'sender_id');
    }

    public function receiver(){
      return $this->belongsTo('App\User', 'receiver_id');
    }
}
