@extends('layouts.app')
@section('page-title','List an experience')
@section('content')
    <div class="section">
        <div class="section-inner">
            <h1>Why be a Locopal Insider?</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet molestie augue. Nam auctor tristique tellus, id finibus diam tincidunt in. Phasellus maximus nunc neque, vel finibus sapien euismod eu. Aenean tristique quis lorem nec venenatis. Duis ac libero non purus luctus euismod a sit amet nisi. Nullam vehicula nisi mi, nec sollicitudin arcu fringilla in. Vestibulum rutrum elit neque, quis sagittis est semper vitae. Donec eu gravida ante, vitae elementum arcu.
            </p>

            <div class="rewards-section clearfix">
                @for($i = 0; $i < 4; $i++)
                    <div class="insider-reward">
                        <img src="http://placehold.it/350x150" alt="http://placehold.it/350x150">
                        <div class="pt-15 pb-15">
                            <h4>Meet Great People</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet molestie augue. Nam auctor tristique tellus, id finibus diam tincidunt in
                            </p>
                        </div>
                    </div>
                @endfor
             
            </div>

        </div>  
    </div>

    <div class="section">
        <div class="section-inner">
            <h1>What every Locopal Insider gets?</h1>
            <div class="insider-gets clearfix">
                <div class="icon-check">
                    <h4 class="pl-15 inline-block">Accept payments from anywhere in the world</h4>
                </div>
                <div class="icon-check">
                    <h4 class="pl-15 inline-block">Flexible Schedule</h4>
                </div>
                <div class="icon-check">
                    <h4 class="pl-15 inline-block">Easy-To-Use</h4>
                </div>
                <div class="icon-check">
                    <h4 class="pl-15 inline-block">Receive refounds in your local currency</h4>
                </div>
                <div class="icon-check">
                    <h4 class="pl-15 inline-block">Free Marketing</h4>
                </div>
                 <div class="icon-check">
                    <h4 class="pl-15 inline-block">Locopal Toolbox</h4>
                </div>
                
            </div>
            <a class="btn btn-default insider-btn" href="{{ route('destinations.create') }}">Become A Locopal Insider</a>
           
        </div>  
    </div>

    <div class="section testimonials-section">
        <div class="section-inner">
            <h1 class="pt-15 pb-5 mt-5">Testimonials</h1>
            <p class="testimonial-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tincidunt scelerisque sodales. Nulla tincidunt sit amet nisl maximus bibendum. Phasellus nec ornare neque. Aliquam arcu turpis, pulvinar ac sodales accumsan, euismod eu felis. 
            </p>
        </div>
    </div>
@endsection



