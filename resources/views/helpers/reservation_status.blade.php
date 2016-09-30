{{--  Define the guide status --}}
{{--  '0' = Draft --}}
{{--  '1' = Waiting for approbation --}}
{{--  '2' = Approved --}}
{{--  '3' = Cancel --}}
{{-- '4' = Paid & Set --}}

@if($status == 1)
	<span class="label label-info">Waiting for Approbation</span>
@elseif($status == 2)
	<span class="label label-success">Aprroved</span>
@elseif($status == 3)
	<span class="label label-danger">Cancel</span>
@elseif($status == 4)
	<span class="label label-primary">Paid</span>
@endif