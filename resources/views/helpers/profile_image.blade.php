
@if(isset($user->img_path))
  {{--*/ $image_source = $user->img_path /*--}}
@else
  {{--*/ $image_source = "http://placehold.it/250x250" /*--}}
@endif
                 
<div class="profile-image">
  <img class="img-thumbnail" style="width: 100%" src="{{ asset('storage/avatars/1/c4ca4238a0b923820dcc509a6f75849b.jpg') }}">
  @if(Auth::check() && Auth::user()->id == $user->id)
    <a href="{{ route('users.profile_edit', Auth::user()->id) }}" class="update-profile-image pt-10 pb-10 pr-10 pl-10">
      Update image
    </a>
  @endif 
</div>