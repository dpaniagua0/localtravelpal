
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


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>
@section('app-js')
    <script type="text/javascript">
        $("select.basic-multiple").select2();

    </script>
@endsection