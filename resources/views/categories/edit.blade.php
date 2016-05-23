@extends('layouts.app')

@section('page-title', 'Edit Category')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Category</div>

                <div class="panel-body">
                  @include('common.errors')
                  {!! Form::model($category,[
                        'route' => ['categories.update', $category->id],
                        'class' => 'form-horizontal',
                        'method' => 'PATCH'
                      ]) !!}

                    @include('categories.fields')

                  {!! Form::close() !!}
                  
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
