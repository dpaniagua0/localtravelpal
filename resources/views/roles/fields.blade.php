
 <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}   
    <div class="col-sm-10">

        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Role name' ]) !!}

        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}">
    {!! Form::label('display_name', 'Display name', ['class' => 'col-sm-2 control-label']) !!}   
    <div class="col-sm-10">
        {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Display name' ]) !!}
        
        @if ($errors->has('display_name'))
        <span class="help-block">
            <strong>{{ $errors->first('display_name') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}   
    <div class="col-sm-10">
        {!! Form::textarea('description', null,['class' => 'form-control no-resize', 'placeholder' => 'Description' ]) !!}
        
        @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit(trans('common.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('roles.index') !!}" class="btn btn-default">{{trans('common.cancel')}}</a>
  </div>
</div>