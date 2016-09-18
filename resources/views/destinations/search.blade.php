@extends('layouts.app')
@section('page-title','Search Destinations')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
    
      <div class="row">
        <div class="col-md-12">
         <div class="search-bar pt-5 pb-5">
          {!! Form::open([
          'route' => 'destinations.search',
          'class' => 'search-form form-inline',
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
       

        <div class="row">
        
          <div class="col-md-12">
            <div class="row">
              <hr>
              <div class="col-md-3 col-sm-4">
                <h4>Interested in:</h4>
                <div class="interest-categories col-xs-6 col-sm-12 col-md-12">
                  @foreach($categories as $category)
                    <div class="checkbox checkbox-primary">
                        <input class="search-category" id="checkbox{{$category->id}}" 
                        type="checkbox" name="byCategory[]"
                        value="{{$category->id}}">
                        <label for="checkbox{{$category->id}}">
                            {{$category->name}}
                        </label>
                    </div>
                  @endforeach 
                </div>
                <h4 class="mt-30"> Sort By: </h4>
                <div class="col-xs-6 col-sm-12 col-md-12">
                  @foreach($sort_by as $v => $k)
                    <div class="radio radio-primary">
                        <input class="sort-by" id="radio{{$v}}" 
                        type="radio" name="sortBy[]"
                        value="{{$v}}">
                        <label for="radio{{$v}}">
                            {{ ucwords($k) }}
                        </label>
                    </div>
                  @endforeach
                </div>
              </div>

              <div class="col-md-9 col-sm-8 col-xs-12">
                  @if(count($destinations) > 0) 
                 
                  @if($query != "")
                    <h4>Destinations</h4>
                    
                  @else 
                    <h4>All results</h4>
                  @endif
                  <div class="result-destinations"> 
                    {{--*/ $col_size = "col-sm-8 col-xs-6 col-md-6" /*--}}
                    {!! Helpers::render_destinations($destinations, $col_size) !!}
                  </div>
              </div>

            </div>  
           
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('app-js')
<script type="text/javascript">
  $(function(){
    $("select.basic-multiple").select2();

    var categoryFilters = $(".search-category");
    var sortFilters = $(".sort-by");
    $(categoryFilters).on("change", function(){
      var categories = getCategories();
      var sortBy = getSortOption();
      DESTINATIONS.searchByCategory(categories, sortBy);
    });

    $(sortFilters).on("change", function(){
      var categories = getCategories();
      var sortBy = getSortOption();
      DESTINATIONS.searchByCategory(categories, sortBy);
    });

    var searchForm = $("form.search-form");
   /* $(searchForm).on("submit", function(e){
      e.preventDefault();
      var categories = getCategories();

      alert(categories);
    });*/
  });

  function getCategories(){
    var categories = [];
      $(".search-category:checked").each(function(){
        var category = $(this).val();
        categories.push(category);
      });
    return categories;  
  }

  function getSortOption(){
    var option = $(".sort-by:checked").val();
    return option;
  }

</script>
@endsection



