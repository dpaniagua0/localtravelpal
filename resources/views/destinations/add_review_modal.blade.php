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
         <div class="form-group">
          <h4 class="text-center">Destination Rate</h4> 
          <div class="col-sm-8 col-md-offset-4">
            <div class="radio radio-primary inline-block">
                <input class="sort-by" id="radio1" 
                  type="radio" name="rating"
                  value="1">
                  <label for="radio1">
                    1
                  </label>
            </div>
             <div class="radio radio-primary inline-block">
                <input class="sort-by" id="radio2" 
                  type="radio" name="rating"
                  value="2">
                  <label for="radio2">
                    2
                  </label>
            </div>
            <div class="radio radio-primary inline-block">
                <input class="sort-by" id="radio3" 
                  type="radio" name="rating"
                  value="3">
                  <label for="radio3">
                    3
                </label>
            </div>
             <div class="radio radio-primary inline-block">
                <input class="sort-by" id="radio4" 
                  type="radio" name="rating"
                  value="4">
                  <label for="radio4">
                    4
                  </label>
            </div>
             <div class="radio radio-primary inline-block">
                <input class="sort-by" id="radio5" 
                  type="radio" name="rating"
                  value="5">
                  <label for="radio5">
                    5
                  </label>
            </div>
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