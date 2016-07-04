{!! Helpers::destination_cover($destination) !!}

@foreach($images as $image)
<div class="destination-image">
    <img src="/{{$image->img_path}}/medium/{{$image->img_file}}" alt="...">
    <div class="image-actions">
        <ul class="list-inline">
          <!--  <li><a class="btn btn-danger btn-xs">Delete</a></li>-->
            <li>
                <a class="btn btn-primary btn-xs" href="/{{$image->img_path}}/original/{{$image->img_file}}" target="_blank">
                    Show
                </a>
            </li>
            <li>
                <a class="btn btn-success cover-btn btn-xs"
                destination-id="{{ $destination->id }}" 
                image-id="{{ $image->id }}"
                data-token="{{ csrf_token() }}">
                Cover
                </a>
            </li>
        </ul>
    </div>
</div>
@endforeach
{!! $images->fragment('images-tab')->render() !!}