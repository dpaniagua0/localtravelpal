@extends('layouts.app')
@section('page-title','Create Experience')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
       <div class="panel-heading">Checkout</div>

       <div class="panel-body">
        Reservation
       
       {{ $reservation }}
        <div class="col-md-6">

          {!! Form::model($reservation,[
                  'route' => 'reservations.preapproved',
                  'class' => 'form-reservation',
                  'method' => 'POST',
                  'id' => 'reservation-form'
              ]) !!}


              <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  {!! Form::label('Full name', 'First name*') !!}   
                  
                    {!! Form::text('name', null, [
                      'class' => 'form-control', 'placeholder' => 'First name*',
                      'data-fv-message' => 'The name field is required',
                      'data-fv-notempty' => 'true'

                      ]) !!}
                      @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('location') }}</strong>
                      </span>
                      @endif
                
              </div>
              <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                  {!! Form::label('email', 'Email*') !!}   
                  
                    {!! Form::text('email', null, [
                      'class' => 'form-control', 'placeholder' => 'Email*',
                      'data-fv-message' => 'The email field is required',
                      'data-fv-notempty' => 'true'

                      ]) !!}
                      @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                      @endif
                
              </div>
              <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                  {!! Form::label('people_qty', 'Guest*') !!}   
                  
                    {!! Form::text('people_qty', null, [
                      'class' => 'form-control', 'placeholder' => 'Guest*',
                      'data-fv-message' => 'The guest field is required',
                      'data-fv-notempty' => 'true'

                      ]) !!}
                      @if ($errors->has('people_qty'))
                      <span class="help-block">
                          <strong>{{ $errors->first('people_qty') }}</strong>
                      </span>
                      @endif
                
              </div>
              <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                  {!! Form::label('phone', 'Phone*') !!}   
                  
                    {!! Form::text('phone', null, [
                      'class' => 'form-control', 'placeholder' => 'Phone*',
                      'data-fv-message' => 'The phone field is required',
                      'data-fv-notempty' => 'true'

                      ]) !!}
                      @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                      @endif
                
              </div>


              {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                

          {!! Form::close() !!}
         
        </div>
        <div class="col-md-6">

        </div>       
      </div>
    </div>
  </div>
</div>
</div>
@endsection

