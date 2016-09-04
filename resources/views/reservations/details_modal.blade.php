<div class="modal fade" id="reservation-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Reservations Details</h4>
      </div>

      {{--*/ $available_active = ""; /*--}}
      {{--*/ $unavailable_active = ""; /*--}}

      {{--*/ $display_date = date("l d, F Y", strtotime($reservation->date))/*--}}

      @if($reservation->status == 2)
        {{--*/ $available_active = "active"; /*--}}
      @else
        {{--*/ $unavailable_active = "active"; /*--}}
      @endif

      {!! Form::model($reservation,[
            'route' =>  ['reservations.update', $reservation->id],
            'method' => 'patch',
            'id' => 'reservation-edit-form'
      ]) !!}

      {{--*/ $reservation->start_time = date('h:i A', strtotime($reservation->start))/*--}}

      {{--*/ $reservation->end_time = date('h:i A', strtotime($reservation->end))/*--}}
      <div class="modal-body">
      
       
       {!! Form::hidden('destination_id', $reservation->destination_id) !!}
        <div class="form-group">
          <label>Date</label>
          {!! Form::hidden('date', null, [ 'id' => 'date']) !!}
     
          {!! Form::text('res_date', $display_date, [ 'class' => 'form-control', 'disabled', 'id' => 'res_date']) !!}
        </div>

        <div class="form-group">
          <label>Available / Unavailable</label>
          <br>
          <div class="btn-group" data-toggle="buttons">
            <label class="reservation-status btn btn-success {{ $available_active }}">
              <input type="radio" name="status" value="2" autocomplete="off" checked> Available
            </label>
            <label class="reservation-status btn btn-warning {{ $unavailable_active }}">
              <input type="radio" name="status" value="3" autocomplete="off"> Unavailable
            </label>
          </div>
        </div>
        <div class="form-group">
          <label>Start time</label>
          {!! Form::hidden('start', null, [ 'class' => 'form-control']) !!}
          {!! Form::text('start_time', null, [ 'class' => 'form-control', 'id' => 'starttime']) !!}
        </div>
        <div class="form-group">
          <label>End time</label>
          {!! Form::hidden('end', null, [ 'class' => 'form-control']) !!}  
          {!! Form::text('end_time', null, [ 'class' => 'form-control', 'id' => 'endtime']) !!}
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