{{--  Define the guide status --}}
{{--  '0' = Draft --}}
{{--  '1' = Waiting for approbation --}}
{{--  '2' = Approved --}}
{{--  '3' = Cancel --}}

@if($status == 1)
	<span class="label label-info">Waiting for Approbation</span>
@elseif($status == 2)
	<span class="label label-success">Aprroved</span>
@elseif($statud = 3)
	<span class="label label-danger">Cancel</span>
@endif
