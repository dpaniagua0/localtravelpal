<!-- Add new wishlist modal -->
<div class="modal fade" id="add-list" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add new wishlist</h4>
      </div>
       

   {!! Form::open([
            'route' => 'wishlists.store',
            'class' => 'form-horizontal',
            'method' => 'POST',
            'id' => 'wishlist-form'
        ]) !!}
       
       {!! Form::hidden('owner_id', Auth::user()->id);  !!}
         
      <div class="modal-body">

         <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name*', ['class' => 'col-sm-2 control-label']) !!}   
            <div class="col-sm-10">
                {!! Form::text('name', null, [
                        'class' => 'form-control', 'placeholder' => 'Name*',
                        'data-fv-message' => 'The name field is required',
                        'data-fv-notempty' => 'true'
 
                    ]) !!}

                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
                <span class="help-block form-response">
                </span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

    {!! Form::close(); !!}
    </div>
  </div>
</div>

<!-- End modal -->