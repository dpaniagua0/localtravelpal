@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">

         <h1>{!! $thread->subject !!}</h1>
        <div class="row">
            <div >
            @foreach($messages as $message)
                @if(isset($message->user->img_path) && $message->user->img_path != "")
                  {{--*/ $img_src = asset($message->user->img_path.'/50x50/'.$message->user->img_file) /*--}}
                @else
                  {{--*/ $img_src = "http://placehold.it/50x50" /*--}}
                @endif
                <div class="media">
                    <a class="pull-left" href="#">
                        <img src="{{$img_src}}" alt="{!! $message->user->name !!}" class="img-circle">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading">{!! $message->user->name !!}</h5>
                        <p>{!! $message->body !!}</p>
                        <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                    </div>
                    {{--*/ $recipent = $message->recipients[0]->id /*--}}
                </div>
                <hr>
            @endforeach
            </div>
            {{ $messages->links() }}
        </div>
        <div class="row">
            {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
            <!-- Message Form Input -->
            <div class="form-group">
                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                {!! Form::hidden('recipients[]', $recipent)!!}
            </div>
           

            <!-- Submit Form Input -->
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop