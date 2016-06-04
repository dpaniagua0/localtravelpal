 
 {!! Form::hidden('owner_id', Auth::user()->id) !!}
 <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title*', ['class' => 'col-sm-2 control-label']) !!}   
    <div class="col-sm-10">

        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title*' ]) !!}

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
        {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location*' ]) !!}
        
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
       
        {!! Form::text('min_capacity', null, ['class' => 'form-control', 'placeholder' => 'min capacity' ]) !!}
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
         {!! Form::text('max_capacity', null, ['class' => 'form-control', 'placeholder' => 'max capacity' ]) !!}
      
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
    <div class="col-sm-3">
        <div class="input-group">
          <span class="input-group-addon">$</span>
           {!! Form::text('price', null, ['class' => 'form-control', 
           'placeholder' => 'Price*', 'aria-label' => 'Amount (to the nearest dollar)' ]) !!}
       
          <span class="input-group-addon">.00</span>
        </div>


        
        @if ($errors->has('price'))
        <span class="help-block">
            <strong>{{ $errors->first('price') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', 'Summary*', ['class' => 'col-sm-2 control-label']) !!}   
    <div class="col-sm-10">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Summary*' ]) !!}
        
        @if ($errors->has('summary'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('category_list') ? ' has-error' : '' }}">
    {!! Form::label('category_list', 'Categories', ['class' => 'col-sm-2 control-label']) !!}
   <div class="col-sm-10">
        @if(!isset($experience))
            {!! Form::select('category_list[]', $categories, null, ['class' =>'form-control basic-multiple' ,'multiple']); !!}
        @else
            {!! Form::select('category_list[]', $categories, $experience->categories, ['class' =>'form-control basic-multiple','multiple']); !!}
        @endif
        @if ($errors->has('category_list'))
        <span class="help-block">
            <strong>{{ $errors->first('category_list') }}</strong>
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