{{--*/ $duration_type = $destination->duration_type; /*--}}
{{--*/ $duration = $destination->duration; /*--}}

@if($duration_type == 0)
    {{--*/ $duration = "{$duration} minutes"; /*--}}
@elseif($duration_type == 1)
    {{--*/ $duration = "{$duration} hours"; /*--}}
@elseif($duration_type == 2){
    {{--*/ $duration = "{$duration} days"; /*--}}
@endif

<p class="alert alert-info mt-10 text-center">
 	<b>${{ money_format('%i', $destination->price) }} per person for {{ $duration }}</b>
</p>