@extends('layouts.app')
@section('page-title','Destinations')
@section('content')

{{-- Sender profile image --}}
@if(isset($sender->img_path) && $sender->img_path != "")
  {{--*/ $sender_source = asset($sender->img_path.'/50x50/'.$sender->img_file) /*--}}
@else
  {{--*/ $sender_source = "http://placehold.it/50x50" /*--}}
@endif
         
@if(!empty($sender->avatar))
    {{--*/ $sender_source = $user->avatar;/*--}}
@endif  

{{-- Receiver profile image --}} 
@if(isset($receiver->img_path) && $receiver->img_path != "")
  {{--*/ $receiver_source = asset($receiver->img_path.'/50x50/'.$receiver->img_file) /*--}}
@else
  {{--*/ $receiver_source = "http://placehold.it/50x50" /*--}}
@endif
         
@if(!empty($receiver->avatar))
    {{--*/ $receiver_source = $user->avatar;/*--}}
@endif  


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Conversation
                    </div>

                    <div class="panel-body">
                        @foreach($history as $message)
                        <div class="well">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($sender->id == $message->sender->id)
                                        <img src="{{ $sender_source }}"/>
                                    @elseif($receiver->id == $message->receiver->id)  
                                        <img src="{{ $receiver_source }}"/>
                                    @endif
                                    <b>{{ ucwords($message->sender->name) }}</b>
                                </div>
                                <div class="col-md-8 text-right">
                                    @if(date('Y-m-d',strtotime($message->created_at)) == date('Y-m-d'))
                                       <b> Today {{ date('h:i A', strtotime($message->created_at)) }}</b>
                                    @else
                                        <b>{{ date('l jS \of F Y h:i:s A', strtotime($message->created_at)) }}</b>
                                    @endif
                                </div>
                            </div>
                            <div class="row pt-5">
                                <div class="col-md-12">
                                    {{ $message->message }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection