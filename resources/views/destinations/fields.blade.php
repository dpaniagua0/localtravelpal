 
{!! Form::hidden('owner_id', Auth::user()->id) !!}

<div class="tab-content  mt-15">
    <div class="tab-pane active" id="basic-tab">
        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
            {!! Form::label('title', 'Title*', ['class' => 'col-sm-2 control-label']) !!}   
            <div class="col-sm-10">

                {!! Form::text('title', null, [
                        'class' => 'form-control', 'placeholder' => 'Title*',
                        'data-fv-message' => 'The title capacity field is required',
                        'data-fv-notempty' => 'true'
                    ]) !!}

                @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
            {!! Form::label('location', 'Location*', ['class' => 'col-sm-2 control-label']) !!}   
            <div class="col-sm-10">
                {!! Form::text('location', null, [
                        'class' => 'form-control', 'placeholder' => 'Location*',
                        'data-fv-message' => 'The location capacity field is required',
                        'data-fv-notempty' => 'true'
 
                    ]) !!}

                @if ($errors->has('location'))
                <span class="help-block">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group  {{ $errors->has('max_capacity') ? ' has-error' : ''}}">
            {!! Form::label('min_capacity', 'People*', ['class' => 'col-sm-2 control-label']) !!}   
            <div class="col-sm-3 {{ $errors->has('min_capacity') ? ' has-error' : '' }}">

                <div class="input-group input-group-lg">
                  <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-users"></i></span>

                  {!! Form::text('min_capacity', null, [
                        'class' => 'form-control', 'placeholder' => 'min capacity' ,
                        'data-fv-message' => 'The min capacity field is required',
                        'data-fv-notempty' => 'true',
                        'data-fv-digits' => 'true',
                        'data-fv-digits-message' => 'only numbers, not decimals',


                        ]) !!}
                </div>
                @if ($errors->has('min_capacity'))
                  <span class="help-block">
                    <strong>{{ $errors->first('min_capacity') }}</strong>
                </span>
                @endif
            </div>

            <div class="col-sm-3 {{ $errors->has('max_capacity') ? ' has-error' : '' }}">
                <div class="input-group input-group-lg">
                  <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-users"></i></span>
                  {!! Form::text('max_capacity', null, [
                        'class' => 'form-control', 'placeholder' => 'max capacity',
                        'data-fv-message' => 'The max capacity field is required',
                        'data-fv-notempty' => 'true',
                        'data-fv-digits' => 'true',
                        'data-fv-digits-message' => 'only numbers, not decimals',

                        ]) !!}
                </div>

                @if ($errors->has('max_capacity'))
                    <span class="help-block">
                        <strong>{{ $errors->first('max_capacity') }}</strong>
                    </span>
                @endif
            </div>
        </div>

    <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
        {!! Form::label('price', 'Price*', ['class' => 'col-sm-2 control-label']) !!}   
        <div class="col-sm-3 {{ $errors->has('price') ? ' has-error' : ''}}">
            <div class="input-group">
              <span class="input-group-addon">$</span>
              {!! Form::text('price', null, ['class' => 'form-control', 
                    'placeholder' => '00.00', 'aria-label' => 'Amount (to the nearest dollar)',
                    'data-fv-message' => 'The price field is required',
                    'data-fv-notempty' => 'true',
                    'data-fv-integer' => 'true',
                    'data-fv-integer-message' => 'only numbers',

                ]) !!}

              <span class="input-group-addon">USD</span>
            </div>



            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('price_rate') ? ' has-error' : '' }}">
        {!! Form::label('price_rate', 'Price Rate*', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">

            {!! Form::select('price_rate', array(1 => 'person', 2 => 'flat rate'), null, 
                ['class' =>'form-control basic-multiple',
                    'data-fv-message' => 'The price rate field is required',
                    'data-fv-notempty' => 'true',
                ]); 
                !!}
            
            @if ($errors->has('price_rate'))
            <span class="help-block">
                <strong>{{ $errors->first('price_rate') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('duration') || $errors->has('duration_type') ? ' has-error' : '' }}">
        {!! Form::label('duration', 'Duration*', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-md-10">

            <div class="col-md-3 form-group">
                {!! Form::text('duration', null, [
                    'class' => 'form-control col-md-5',
                    'data-fv-message' => 'The duration field is required',
                    'data-fv-notempty' => 'true',
                    'data-fv-digits' => 'true',
                    'data-fv-digits-message' => 'only numbers, not decimals',

                    ]) !!}
                @if ($errors->has('duration'))
                <span class="help-block">
                    <strong>{{ $errors->first('duration') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-md-3 form-group">

                {!! Form::select('duration_type', array(0 => 'minutes',1 => 'hours', 2 => 'days'), null, ['class' =>'form-control basic-single']); !!}

                @if($errors->has('duration_type'))
                <span class="help-block">
                    <strong>{{ $errors->first('duration_type') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description', 'Summary*', ['class' => 'col-sm-2 control-label']) !!}   
        <div class="col-sm-10">
            {!! Form::textarea('description', null, [
                'class' => 'form-control', 'placeholder' => 'Summary*',
                'data-fv-message' => 'The description field is required',
                'data-fv-notempty' => 'true', 

                ]) !!}
            
            @if ($errors->has('summary'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('category_list') ? ' has-error' : '' }}">
        {!! Form::label('category_list', 'Categories*', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            @if(!isset($destination))
            {!! Form::select('category_list[]', $categories, null, [
                'class' =>'form-control basic-multiple' ,'multiple',
                'data-fv-message' => 'The categories field is required',
                'data-fv-notempty' => 'true',
                ]); !!}
            @else
            {!! Form::select('category_list[]', $categories, $destination->categories_list, 
                ['class' =>'form-control basic-multiple','multiple',
                'data-fv-message' => 'The categories field is required',
                'data-fv-notempty' => 'true',
                ]); !!}
            @endif
            @if ($errors->has('category_list'))
            <span class="help-block">
                <strong>{{ $errors->first('category_list') }}</strong>
            </span>
            @endif
        </div>
    </div>


<!--<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        @if(Auth::user()->hasRole('super_admin'))
        <a href="{!! route('destinations.index') !!}" class="btn btn-default">Cancel</a>
        @else
        <a href="{!! route('destinations.search') !!}" class="btn btn-default">Cancel</a>
        @endif
    </div>
</div>  -->
    </div>
<!-- Imges tab -->
    <div id="images-tab" class="tab-pane">
        <div class="form-group {{ $errors->has('video_url') ? ' has-error' : '' }}">
            {!! Form::label('video_url', 'Video', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">

                {!! Form::text('video_url', null, ['class' => 'form-control no-resize', 'placeholder' => 'Video url [Youtube/Vimeo]' ]) !!}

                @if ($errors->has('video_url'))
                <span class="help-block">
                    <strong>{{ $errors->first('video_url') }}</strong>
                </span>
                @endif
                <br>
                <p class="bg-warning">
                    <b>
                        You can add a video to your experience to allow the locopal user, have a short introduction to it.
                    <b>
                </p>
                @if(isset($destination))
                {!! Helpers::render_video($destination->video_source, $destination->alien_video_id)  !!}
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('photos') ? ' has-error' : '' }}">
            {!! Form::label('photos', 'Photos', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">

                 {!! Form::file('photos[]',array(
                  'multiple'=>true, 'class' => 'file-loading',
                  'data-show-upload' => true, 'id' => 'photos'
                  )); 
                  !!}
                @if ($errors->has('photos'))
                <span class="help-block">
                    <strong>{{ $errors->first('photos') }}</strong>
                </span>
                @endif
                <br>
                @if(isset($destination) && count($destination->images) > 0)

                    @foreach($destination->images as $image)
                        <a href="#" class="thumbnail col-md-3">
                          <img src="/{{$image->img_path}}/medium/{{$image->img_file}}" alt="...">
                        </a>
                    @endforeach
                @endif
            </div>
        </div>


    </div>


    <!-- Previous/Next buttons -->
    <ul class="pager wizard">
        <li class="previous"><a href="javascript: void(0);">Previous</a></li>
        <li class="next"><a href="javascript: void(0);">Next</a></li>
    </ul>
</div>




