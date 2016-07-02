@if($destination->hasCover())
{{--*/$image = $destination->hasCover();/*--}}
{{--*/$img_file = $destination->hasCover()->img_file; /*--}} 
{{--*/$img_path = $destination->hasCover()->img_path; /*--}}

<div class="destination-image destination-cover">
	<img src="/{{$img_path}}/700x300/{{$img_file}}" alt="...">
	<div class="image-actions">
		<ul class="list-inline">
			<li><a class="btn btn-danger btn-xs">Delete</a></li>
			<li><a href="/{{$img_path}}/original/{{$img_file}}" class="btn btn-primary btn-xs" target="_blank">
				Show
				</a>
			</li>
			<!--<li>
				<a class="btn btn-success cover-btn btn-xs"
				destination-id="{{ $destination->id }}" 
				image-id="{{ $image->id }}"
				data-token="{{ csrf_token() }}">
				Cover
			</a>
			</li>-->
		</ul>
	</div>
</div>
@endif