@extends('layouts.app')

@section('page-title', '403 Unauthorized action.')
@section('content')
<div class="container">
    <div class="row">
        <h1>Page not found</h1>
        <a href="{{ url('/') }}">Go to Home</a>
          
    </div>
</div>
@endsection