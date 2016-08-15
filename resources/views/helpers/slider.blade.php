<div id="home-carousel" class="carousel slide" data-ride="carousel">

  @if(Auth::check() && Auth::user()->hasRole('super_admin'))
  <div class="upload-controls">
    <a data-target="#upload-slider" class="btn btn-primary" data-toggle="modal">Upload images</a>
  </div>
  @endif
  <!-- Indicators
  <ol class="carousel-indicators">
    <li data-target="home-carousel" data-slide-to="0" class="active"></li>
    <li data-target="home-carousel" data-slide-to="1"></li>
    <li data-target="home-carousel" data-slide-to="2"></li>
  </ol>
-->
<!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">

  @if(count($images) > 0)
    <?php $index = 0; ?>
    @foreach($images as $img)
    {{--*/ $slide_src = (isset($img) && $img != "") ? $img : 'http://placehold.it/1280x500'; /*--}}
    {{--*/ $active = ($index < 1)? 'active' : ''; /*--}}
    <div class="item {{ $active }}">
      <img src="{{ $slide_src }}" class="" alt="{{$img}}">
    </div>
    <?php $index++; ?>
    @endforeach
  @else 
    <div class="item active">
      <img src="http://placehold.it/1280x500" class="" alt="place_holder">
    </div>
  @endif
</div>

  <!-- Controls 
  <a class="left carousel-control" href="#home-carousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#home-carousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
-->
<!-- Search form -->
<div class="search-destinations">
  <h1 class="text-center">Find A Local Pal</h1>
  <h3 class="text-center pb-30">Discover unique experiences offered by locals</h3>
  {!! Form::open([
  'route' => 'destinations.search',
  'class' => 'search-form pt-15 pb-15 pr-15 pl-15',
  'method' => 'post'
  ]) !!}
  <div class="input-group">
    {!! Form::text('search', null, [
    'placeholder' => 'Enter your destination to find local experiences.', 'class' => 'form-control',

    ]) !!}
    <span class="input-group-btn">
      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
    </span>
  </div>


  {!! Form::close() !!}
</div>

</div>

@if(Auth::check() && Auth::user()->hasRole('super_admin'))
<!-- Modal -->
<div class="modal fade" id="upload-slider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Carousel images</h4>
      </div>
      {!! Form::open([
      'class' => 'form-horizontal',
      'method' => 'POST',
      'files' => true
      ]) !!}
      <div class="modal-body">
        @if(count($images) > 0)
          <legend>Current images</legend>
          <div class="form-group ">
            <?php $index = 0; ?>
            @foreach($images as $img)
              {{--*/ $slide_src = (isset($img) && $img != "") ? $img : 'http://placehold.it/1280x500'; /*--}}
              {{--*/ $active = ($index < 1)? 'active' : ''; /*--}}
              <div class="col-md-3 mb-5">
                <div class="thumbnail">
                  <img src="{{ $slide_src }}"  alt="{{$img}}">
                  <div class="caption">
                    {!! Form::open([ 'url' => 'home/deleteimg/']) !!}
                      
                      {{--*/ $path = str_replace('storage', 'public', $img) /*--}}
                      
                      {!! Form::hidden('path', $path) !!}
                    <button type="ubmit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="delete image">
                        <i class="glyphicon glyphicon-trash"></i>
                    </button>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
              <?php $index++; ?>
            @endforeach
          </div>
        @endif


      <div class="form-group {{ $errors->has('images') ? ' has-error' : '' }}">
        {!! Form::label('images', 'Upload images', ['class' => 'col-sm-2 control-label']) !!}   
        <div class="col-sm-10">
          {!! Form::file('images[]',array(
              'multiple'=>true, 'class' => 'file-loading',
              'data-show-upload' => true, 'id' => 'images'
              )); 
          !!}
        </div>
      </div>
    </div>
    <div class="modal-footer">
    </div>
    {!! Form::close() !!}
  </div>
</div>
</div>
@endif

@section('app-js')
<script type="text/javascript">
$(function() {

   $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').attr('content') }
    });

  $("#images").fileinput({
    uploadUrl: "/upload/images",
    uploadAsync: true,
    maxFileCount: 5,
    showCaption: false,
    allowedFileExtensions: ['png', 'jpg', 'jpeg']
  });

   
});
</script>
@endsection

