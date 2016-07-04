@extends('layouts.app')
@section('page-title','Upload images')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                     <div class="panel-heading">Upload images</div>

                    <div class="panel-body">
                     
                      <p class="alert alert-warning">
                        This view is only available for admin users.
                        Here you can upload images to the system in order to use them as resources like backgrounds, etc.
                      </p>
                      @include('common.errors')
                     
                        {!! Form::open([
                            'route' => 'images.store',
                            'class' => 'form-horizontal',
                            'method' => 'POST',
                            'id' => 'destination-form',
                            'files' => true
                          ]) !!}

                           <div class="form-group">
                              {!! Form::label('images', 'Images', ['class' => 'col-sm-2 control-label']) !!}
                              <div class="col-sm-10">

                                  {!! Form::file('images[]',array(
                                    'multiple'=>true, 'class' => 'file-loading',
                                    'data-show-upload' => true, 'id' => 'images'
                                    )); 
                                  !!}
                                 
                            </div>
                         </div>   
                       
                      {!! Form::close() !!}
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('app-js')
<script type="text/javascript">
$(function() {
  $("select.basic-multiple,select.basic-single").select2({
   theme: "bootstrap"
  });

  $("#images").fileinput({
    uploadAsync: true,
    maxFileCount: 5,
    showCaption: false
  });

   
});
</script>
@endsection






