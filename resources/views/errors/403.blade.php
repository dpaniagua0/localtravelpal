@extends('layouts.app')

@section('page-title', '403 Unauthorized action.')
@section('content')
<div class="container">
    <div class="row">
        <h1>You don't have access to this section.</h1>
        <a href="{{ url('/home') }}">Go to Homepage</a>
          
    </div>
</div>
@endsection