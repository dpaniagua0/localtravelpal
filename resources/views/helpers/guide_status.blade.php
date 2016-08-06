{{--  Define the guide status --}}
{{--  '0' = Draft --}}
{{--  '1' = Published --}}
{{--  '2' = Hidden --}}


@if($status == 0)
	<span class="label label-default">Draft</span>
@elseif($status == 1)
	<span class="label label-success">Published</span>
@elseif($status == 2)
	<span class="label label-warning">Hidden</span>
@endif
