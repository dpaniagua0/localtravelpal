<div class="modal fade" id="add-reservation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Set a new reservation</h4>
      </div>

      @if(Auth::check())
        {{--*/ $user = Auth::user() /*--}}
      @endif
      {!! Form::open([
            'route' => 'reservations.request',
            'method' => 'POST',
            'id' => 'reservation-form'
      ]) !!}
      <div class="modal-body">
        
            {!! Form::hidden('destination_id', $destination->id) !!}
            {!! Form::hidden('provider_id', $destination->owner_id) !!}

            {!! Form::hidden('is_private', 1) !!}

            {!! Form::hidden('is_set', 0) !!}
          <div class="form-group">
          <label>Date</label>
     
            {!! Form::text('date', null, [
                'class' => 'form-control res-date', 'placeholder' => 'Date*',
                ]) !!}
        </div>
        
        <div class="form-group">
          <label>Start time</label>
          {!! Form::hidden('start', null, [ 'class' => 'form-control']) !!}
          {!! Form::text('start_time', null, [ 
            'class' => 'form-control', 
            'id' => 'starttime',
            'data-fv-notempty' => 'true', 
            'data-fv-message' => 'The end time is required'
            ]) !!}
        </div>
        <div class="form-group">
          <label>End time</label>
          {!! Form::hidden('end', null, [ 'class' => 'form-control']) !!}  
          {!! Form::text('end_time', null, [ 
            'class' => 'form-control', 'id' => 'endtime',
            'data-fv-notempty' => 'true', 
            'data-fv-message' => 'The end time is required'
            ]) !!}
        </div>
        <div class="form-group">
          <label>Name</label>
          {!! Form::hidden('name', null, [ 'class' => 'form-control']) !!}  
          {!! Form::text('name', $user->name, [ 
            'class' => 'form-control',
            ]) !!}
        </div>
        <div class="form-group">
          <label>Email</label>
          {!! Form::hidden('email', null, [ 'class' => 'form-control']) !!}  
          {!! Form::text('email', $user->email, [ 
              'class' => 'form-control',
              'data-fv-notempty' => 'true', 
              'data-fv-message' => 'The email field is required',
              'data-fv-emailaddress'=>"true",
              'data-fv-emailaddress-message' => "The value is not a valid email address"

            ]) !!}
        </div>

        <div class="form-group">
          <label>Phone</label>
          {!! Form::hidden('phone', null, [ 'class' => 'form-control']) !!}  
          {!! Form::text('phone', null, [ 
            'class' => 'form-control',
          
            ]) !!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>