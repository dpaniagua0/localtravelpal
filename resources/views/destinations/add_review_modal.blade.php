<!-- Add new wishlist modal -->
<div class="modal fade" id="add-review" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add a review</h4>
      </div>
       

   {!! Form::open([
            'route' => 'destination.storeReview',
            'class' => 'form-horizontal',
            'method' => 'POST',
            'id' => 'reviews-form'
        ]) !!}
       
       {!! Form::hidden('user_id', Auth::user()->id);  !!}
       {!! Form::hidden('destination_id', $destination->id);  !!}
      <div class="modal-body">

         <div class="form-group {{ $errors->has('comment') ? ' has-error' : '' }}">
            <div class="col-sm-12">
                {!! Form::textarea('comment', null, [
                        'class' => 'form-control', 'placeholder' => 'Comments',
                        'data-fv-message' => 'The comment field is required',
                        'data-fv-notempty' => 'true'
 
                    ]) !!}

                @if ($errors->has('comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('comment') }}</strong>
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