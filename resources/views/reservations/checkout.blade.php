@extends('layouts.app')
@section('page-title','Checkout')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
       <div class="panel-heading">Reservation Checkout</div>

       <div class="panel-body">
        
        {!! Form::model($reservation,[
                  'route' => 'reservations.preapproved',
                  'class' => 'form-reservation',
                  'method' => 'POST',
                  'id' => 'reservation-form'
              ]) !!}

        <div class="col-md-6">
            {{ Form::hidden('id', $reservation->id) }}

              <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  {!! Form::label('name', 'Full name*') !!}   
                  
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
         
                      {!! Form::selectRange('people_qty', 1, $reservation->destination->max_capacity, null, [ 
                        'class' => 'form-control guest-select',
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

              <div class="form-group">
                {!! Form::label('message', 'Send a message to the provider')  !!}
                {!! Form::textarea('message', null, [
                    'class' => 'form-control no-resize', 'palceholder' => 'Message',
                    'rows' => 10
                ])  !!}
              </div>
           
              <p class="alert alert-warning">
                This reservation has been approved, it i'll be charged in a single step.
              </p>
              {!! Form::submit('Process Payment', ['class' => 'btn btn-primary']) !!}
              <img class="pull-right" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" alt="PayPal Logo">
              <div class="clearfix"></div>
        </div>
        <div class="col-md-5 col-md-offset-1">
          {{--*/$cover = $destination->hasCover();/*--}}
          @if(isset($cover))
            {{--*/$cover_path = "$cover->img_path";/*--}}
            {{--*/$cover_file = "$cover->img_file";/*--}}
            {{--*/$cover_image = "/$cover_path/350x200/$cover_file";/*--}}
          @else 
            {{--*/ $cover_image = "http://placehold.it/350x200"; /*--}}
          @endif
          <legend>{{ $destination->title }}</legend >
          <img src="{{ $cover_image }}" class="img-responsive img-rounded" />
          <h5>With {{ $provider->name }} in {{ $destination->location }}</h5>
          {!! Helpers::tour_time($destination) !!}
          <div class="reservation-info">
            <label><b>Reservation date: {{ date("l d, F Y", strtotime($reservation->date))}}</b></label>
            <hr>
            {{--*/ $subtotal = ($destination->price * $reservation->people_qty )/*--}}
            <label><b>Subtotal: </b><span class="sub-total">$ {{ money_format('%i', $subtotal) }}</span></label>
            <br>
            {{--*/ $service_fee = ($subtotal * 0.10); /*--}}
            <label><b>Service fee: </b><span class="service-fee">$ {{ money_format('%i', $service_fee) }}</span></label>
            <br>
            <label><b>Total: <span class="total">$ {{ money_format('%i',$subtotal + $service_fee) }}</span></b></label>
          </div>
        </div>   
        {!! Form::close() !!}    
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@section('app-js')
<script type="text/javascript">
  $(function(){
    var guests = $("select.guest-select");
    var price = "{{ $destination->price }}";
    var fee_rate = 0.10;
    guests.on("change", function(){
      var guestQyt = $(this).val();
      var subtotal = guestQyt * price;
      var serviceFee = subtotal * fee_rate;
      var total  = subtotal + serviceFee;

      $("span.sub-total").html("$ " + subtotal.toFixed(2));
      $("span.service-fee").html("$ " + serviceFee.toFixed(2));
      $("span.total").html("$ " + total.toFixed(2));

    });
  });
</script>
@endsection

