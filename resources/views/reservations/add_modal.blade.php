<div class="modal fade" id="add-reservation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Set a new reservation</h4>
      </div>
      {!! Form::open([
            'route' => 'reservations.store',
            'method' => 'POST',
            'id' => 'reservation-form'
      ]) !!}

      <div class="modal-body">
      
        {!! Form::hidden('destination_id', $destination->id) !!}
        <div class="form-group">
          <label>Date</label>
          {!! Form::hidden('date', null, [ 'id' => 'date']) !!}
     
          {!! Form::text('res_date', null, [ 'class' => 'form-control', 'disabled', 'id' => 'res_date']) !!}
        </div>
        <div class="form-group">
          <label>Start time</label>
          {!! Form::text('start_time', null, [ 'class' => 'form-control', 'id' => 'starttime']) !!}
        </div>
        <div class="form-group">
          <label>End time</label>
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