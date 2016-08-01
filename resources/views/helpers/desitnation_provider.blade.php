{{--*/$user_img_file = $owner->img_file; /*--}} 
{{--*/$user_img_path = $owner->img_path; /*--}}

@if(!empty($user_img_path) && !empty($user_img_file))
  {{--*/$user_profile_img = "/{$user_img_path}/200x200/{$user_img_file}"; /*--}}
@else
  {{--*/$user_profile_img = "http://placehold.it/200x200"; /*--}}
@endif

@if(!empty($user->avatar))
  {{--*/ $user_profile_img = $destination->owner->avatar;/*--}}
@endif 

<div class="section locopal-section pt-15 pb-15">
	<div class="section-inner text-center">
		<h1 class="reviews-header"><span>Your LocoPal</span></h1>
		<h2 class="text-center">{{ $owner->name }}</h2>
		<img class="img-rounded " src="{{$user_profile_img}}"/>
		<p class="text-justify mt-15">{{ $owner->bio }}</p>
		<a class="btn btn-default" href="{{ route('users.profile', $owner->id) }}">View Profile</a>
	</div>
</div>