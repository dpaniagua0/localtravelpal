@extends('layouts.app')
@section('page-title','Destinations')
@section('content')
    <div class="container">
        {!! Helpers::destination_reviews($destination, true) !!}
    </div>
@endsection



