
<div class="form-group {{ $errors->has('profile_image') ? ' has-error' : '' }}">
    {!! Form::label('profile_image', 'Profile Image', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div style="max-width:150px">
        @if(isset($user->img_path) && $user->img_path != "" )
        
            <img class="img-thumbnail preview-thumbnail" src="{{ asset($user->img_path.'/original/'.$user->img_file)}}" style="width: 150px;height:150px;">
       
        @else
            <img class="img-thumbnail preview-thumbnail" src="http://placehold.it/150x150" style="width: 150px;height:150px;">
      
        @endif
            <span class="btn btn-default btn-file btn-block">
            Browse <input class="preview-img" type="file" id="profile_image" name="profile_image">
        
            </span>
        </div>

        @if ($errors->has('profile_image'))
            <span class="help-block">
            <strong>{{ $errors->first('profile_image') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">

        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name' ]) !!}

        @if ($errors->has('name'))
            <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email' ]) !!}

        @if ($errors->has('email'))
            <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('bio') ? ' has-error' : '' }}">
    {!! Form::label('bio', 'Biography', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('bio', null, ['class' => 'form-control no-resize', 'placeholder' => 'Biography' ]) !!}

        @if ($errors->has('bio'))
            <span class="help-block">
            <strong>{{ $errors->first('bio') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('video_url') ? ' has-error' : '' }}">
    {!! Form::label('video_url', 'Video Biography', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">

        {!! Form::text('video_url', null, ['class' => 'form-control no-resize', 'placeholder' => 'Video url [Youtube/Vimeo]' ]) !!}

        @if ($errors->has('video_url'))
        <span class="help-block">
            <strong>{{ $errors->first('video_url') }}</strong>
        </span>
        @endif
        <br>
        <p class="bg-warning">
            <b>To ensure trust, safety, and a high level of quality, each Insider is asked to create a profile video to tell your potential travelers a little more about your experience. Keep it simple! Let us know:
                <ol>
                    <li>Who you are</li>
                    <li>About your experience(s)</li>
                    <li>What makes you a (fun!) local expert</li>
                </ol>
            </b>

        </p>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('users.profile', $user->id) !!}" class="btn btn-default">Cancel</a>
    </div>
</div>
