<div id="send-message" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ ucwords(trans('common.send_a_message')) }}</h4>
      </div>
       {!! Form::open([
                'route' => 'messages.store',
                'class' => 'form-horizontal',
                'method' => 'POST',
                'id' => 'send-message'
           ]) !!}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">

            {!! Form::hidden('user_id', Auth::user()->id) !!}

            {!! Form::hidden('recipients[]', $destination->owner->id) !!}

            <div class="form-group pl-5 pr-5">
                {!! Form::text('subject', null, [
                  'class' => 'form-control', 
                  'placeholder' => 'Subject',
                  'data-fv-message' => 'The subject is required',
                  'data-fv-notempty' => 'true'
                ]) !!}
            </div>
            <div class="form-group pl-5 pr-5">
              {!! Form::textarea('message', null, [
                  'class' => 'form-control', 'placeholder' => 'Message',
                  'data-fv-message' => 'The message is required',
                  'data-fv-notempty' => 'true',
                  'data-fv-maxlength' => '250'
 
              ]) !!}
            </div> 
          
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
      </div>

      {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->