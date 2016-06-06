@extends('layouts.app')

@section('page-title','Home')

@section('content')
<style>

.slider-container {
    width: 100%;
    margin: 0 auto;
    display: block;
    height: 500px;
}


</style>
<div class="slider-container">
  {!! Helpers::home_slider($files)  !!}
</div>

@endsection
