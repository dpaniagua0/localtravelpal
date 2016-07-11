@extends('layouts.app')
@section('page-title','Search Destinations')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
    
      <div class="row">
        <div class="col-md-12">
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
       

        <div class="row">
        
          <div class="col-md-12">
            <div class="row">
              <hr>
              <div class="col-md-3">
                <h4>Interested in:</h4>
                <div class="interest-categories">
                  @foreach($categories as $category)
                    <div class="checkbox checkbox-primary">
                        <input id="checkbox{{$category->id}}" type="checkbox" name="byCategory[]">
                        <label for="checkbox{{$category->id}}">
                            {{$category->name}}
                        </label>
                    </div>
                  @endforeach 
                </div>
              </div>

              <div class="col-md-9">
                  @if(count($destinations) > 0) 
                 
                  @if($query != "")
                    <h4>Results for: {{ count($destinations) }}</h4>
                    
                  @else 
                    <h4>All results</h4>
                  @endif
                  
                  {!! Helpers::render_destinations($destinations) !!}
              </div>

            </div>  
           
          </div>
        </div>
        @endif
      </div>
    </div>
    @if(count($destinations) <= 0)
    <h1 class="alert alert-info text-center">We can't find this place right now.</h1>
    @endif
  </div>
</div>
</div>
@endsection

@section('app-js')
<script type="text/javascript">
  $(function(){
    $("select.basic-multiple").select2();
  });
</script>
@endsection



