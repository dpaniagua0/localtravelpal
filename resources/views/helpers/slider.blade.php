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
    <?php $index = 0; ?>
    @foreach($images as $img)
      {{--*/ $slide_src = (isset($img) && $img != "") ? $img : 'http://placehold.it/1280x500'; /*--}}
      {{--*/ $active = ($index < 1)? 'active' : ''; /*--}}
      <div class="item {{ $active }}">
        <img src="{{ $slide_src }}" class="" alt="{{$img}}">
      </div>
    <?php $index++; ?>
    @endforeach
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
  <div class="search-destinations pt-5 pb-5">
    {!! Form::open([
      'route' => 'destinations.search',
      'class' => 'form-inline',
      'method' => 'post'
    ]) !!}
    <div class="form-group pl-5 pr-5" style="width:100%">
          {!! Form::text('search', null, [
              'placeholder' => 'Enter your new destination to find local experiences', 'class' => 'form-control pull-left mr-5',
              'style' => 'width:86%'

          ]) !!}
          <button type="submit" class="btn btn-default pull-rigth ml-15">Search</button>
   
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
        <h4 class="modal-title" id="myModalLabel">Upload images</h4>
      </div>
      {!! Form::open([
          'route' => 'home.uploadImages',
          'class' => 'form-horizontal',
          'method' => 'POST',
          'files' => true
      ]) !!}
      <div class="modal-body">
        <div class="form-group {{ $errors->has('images') ? ' has-error' : '' }}">
            {!! Form::label('images', 'Images', ['class' => 'col-sm-2 control-label']) !!}   
            <div class="col-sm-10">
            {!! Form::file('images[]',array(
              'multiple'=>true, 'class' => 'file file-loading',
              'data-show-upload' => true
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


