@extends('layouts.admin')

@section('title')
	Inventory Release
@endsection

@section('content')
 <form class="ui form">
<div class="two fields">
<div class="field">
{{ Form::label('', 'Inventory Release Code:') }}
</div>
<div class="field">
{{ Form::label('', 'Description:') }}
</div>
</div>
<div class="field">
{{ Form::label('', 'Date Released:') }}
</div>

</form>

<div class="row">
		<table class="ui table" id="tblinventory">
			  <div class="row"></div>
			  <div class="row"></div>
			  <div class="row"></div>
			  <div class="row"></div>
			  <div class="row"></div>
			    <h1>Inventory Release</h1>
			    <hr>
		  <thead>

		    <tr>
			    <th>Name</th>
			    <th>Quantity Released</th>
			    <th>Quantity Returned</th>
		  	</tr>
		  </thead>
		  <tbody>

		  	<tr>
		  		<td colspan="2" class="center aligned"><strong>Nothing to show.</strong></td>
		  		<td>{{ Form::text('decor_name', "", ['placeholder' => 'Type Quantity']) }}</td>
		  	</tr>


		  </tbody>
		</table>
	</div>
@endsection


@section('js')

<script>

$(document).ready(function() {


  $('#inventory').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblinventory').DataTable();


});


</script>
@endsection
