@extends('layouts.admin')

@section('title')
	Inventory
@endsection

@section('content')


	<div class="row">
		<h1>Inventory</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>Add Stock</button>
	</div>

	<div class="row">
		<table class="ui table" id="tblinventory">
			<div class="header">Inventory List</div>
		  <thead>
		    <tr>

			    <th>Name</th>
			    <th>Type</th>
			    <th>Stock</th>
			    <th>Description</th>
		  	</tr>
		  </thead>
		  <tbody>

		  	<tr>
		  		<td colspan="3" class="center aligned"><strong>Nothing to show.</strong></td>
		  	</tr>


		  </tbody>
		</table>
	</div>

	<div class="row">
	<button type="button" class="ui orange button" onclick="$('#release').modal('show');"><i class="info icon"></i>Release</button>
	</div>

		<div class="row">
		<table class="ui table" id="tblinventory">
			<div class="header">Inventory List</div>
		  <thead>
		    <tr>
			    <th>Code</th>
			    <th>Description</th>
			    <th>Date Released</th>
			    <th>Action</th>
		  	</tr>
		  </thead>
		  <tbody>

		  	<tr>
		  		<td colspan="3" class="center aligned"><strong>Nothing to show.</strong></td>
		  		<td><a class="ui blue button" href="{{URL::to('/inventoryRelease')}}">
		  		<i class="announcement icon"></i> Return</a></td>
		  	</tr>


		  </tbody>
		</table>
	</div>
	





	<div class="ui modal" id="create">
	  <div class="header">Add Stock</div>
	  <div class="content">
	    {!! Form::open(['url' => '/inventory']) !!}
	    	<div class="ui form">
	    		@if (count($errors) > 0)
	    		<div class="ui message">
				    <div class="header">We had some issues</div>
				    <ul class="list">

				    </ul>
				</div>
				@endif
				<div class="required field">
					{{ Form::label('menu_code', 'Item') }}
						{{ Form::select('items', $items, null, ['placeholder' => 'Choose Item', 'class' => 'ui search dropdown']) }}
				</div>

				<div class="required field">
	    			{{ Form::label('item_type', 'Item Type') }}
         			{{ Form::select('item_type', $itemTypes, null, ['id' => 'itemTypes', 'placeholder' => 'Choose Item Type', 'class' => 'ui search dropdown']) }}
	    		</div>

	    		<div class="required field" id="divEquiTypes" style="display: none;">
	    			{{ Form::label('equipment_type', 'Equipment Type') }}
         			{{ Form::select('equipment_type', $equiTypes, null, ['placeholder' => 'Choose Equipment Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" id="divDinnTypes" style="display: none;">
	    			{{ Form::label('dinnerware_type', 'Dinnerware Type') }}
         			{{ Form::select('dinnerware_type', $dinnTypes, null, ['placeholder' => 'Choose Dinnerware Type', 'class' => 'ui search dropdown']) }}
	    		</div>

				<div class="required field">
					{{ Form::label('decor_name', 'Quantity') }}
						{{ Form::text('decor_name', "", ['placeholder' => 'Type Quantity']) }}
				</div>
				<div class="required field">
									{{ Form::label('amount', 'Amount') }}
									<div class="ui center labeled input">
									<div class="ui label">Php</div>
									{{ Form::text('amount', null, ['class' => 'money', 'placeholder' => 'Amount']) }}
									</div>
							</div>

	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>



	<div class="ui modal" id="create">
	  <div class="header">Add Stock</div>
	  <div class="content">
	    {!! Form::open(['url' => '/inventory']) !!}
	    	<div class="ui form">
	    		@if (count($errors) > 0)
	    		<div class="ui message">
				    <div class="header">We had some issues</div>
				    <ul class="list">

				    </ul>
				</div>
				@endif
				<div class="required field">
					{{ Form::label('items', 'Item') }}
						{{ Form::select('items', $items, null, ['placeholder' => 'Choose Item', 'class' => 'ui search dropdown']) }}
				</div>

				<div class="required field">
	    			{{ Form::label('item_type', 'Item Type') }}
         			{{ Form::select('item_type', $itemTypes, null, ['id' => 'itemTypes', 'placeholder' => 'Choose Item Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		
	    		<div class="required field" id="divEquiTypes" style="display: none;">
	    			{{ Form::label('equipment_type', 'Equipment Type') }}
         			{{ Form::select('equipment_type', $equiTypes, null, ['placeholder' => 'Choose Equipment Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" id="divDinnTypes" style="display: none;">
	    			{{ Form::label('dinnerware_type', 'Dinnerware Type') }}
         			{{ Form::select('dinnerware_type', $dinnTypes, null, ['placeholder' => 'Choose Dinnerware Type', 'class' => 'ui search dropdown']) }}
	    		</div>

				<div class="required field">
					{{ Form::label('quantity', 'Quantity') }}
						{{ Form::text('quantity', "", ['placeholder' => 'Type Quantity']) }}
				</div>
				<div class="required field">
									{{ Form::label('amount', 'Amount') }}
									<div class="ui center labeled input">
									<div class="ui label">Php</div>
									{{ Form::text('amount', null, ['class' => 'money', 'placeholder' => 'Amount']) }}
									</div>
							</div>











	<div class="ui modal" id="return">
		<div class="header">Return</div>
		<div class="content">
			{!! Form::open(['url' => '/inventory']) !!}
				<div class="ui form">
					@if (count($errors) > 0)
					<div class="ui message">
						<div class="header">We had some issues</div>
						<ul class="list">

						</ul>
				</div>
				@endif
				<div class="required field">
					{{ Form::label('menu_code', 'Item') }}
						{{ Form::select('items', $items, null, ['placeholder' => 'Choose Item', 'class' => 'ui search dropdown']) }}
				</div>

				<div class="required field">
					{{ Form::label('penalty_type', 'Penalty Type') }}
						{{ Form::select('penalty_type', $penaltyType, null, ['placeholder' => 'Choose Penalty Type', 'class' => 'ui search dropdown']) }}
				</div>


				<div class="required field">
					{{ Form::label('decor_name', 'Quantity') }}
						{{ Form::text('decor_name', "", ['placeholder' => 'Type Quantity']) }}
				</div>
				<div class="required field">
									{{ Form::label('amount', 'Amount') }}
									<div class="ui center labeled input">
									<div class="ui label">Php</div>
									{{ Form::text('amount', null, ['class' => 'money', 'placeholder' => 'Amount']) }}
									</div>
							</div>

				</div>
				</div>
		<div class="actions">
						{{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
						{{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
				{!! Form::close() !!}
		</div>
	</div>

	<div class="ui modal" id="return">
		<div class="header">Return</div>
		<div class="content">
			{!! Form::open(['url' => '/inventory']) !!}
				<div class="ui form">
					@if (count($errors) > 0)
					<div class="ui message">
						<div class="header">We had some issues</div>
						<ul class="list">

						</ul>
				</div>
				@endif
				<div class="required field">
					{{ Form::label('menu_code', 'Item') }}
						{{ Form::select('items', $items, null, ['placeholder' => 'Choose Item', 'class' => 'ui search dropdown']) }}
				</div>

				<div class="required field">
					{{ Form::label('penalty_type', 'Penalty Type') }}
						{{ Form::select('penalty_type', $penaltyType, null, ['placeholder' => 'Choose Penalty Type', 'class' => 'ui search dropdown']) }}
				</div>

				<div class="required field">
					{{ Form::label('decor_name', 'Quantity') }}
						{{ Form::text('decor_name', "", ['placeholder' => 'Type Quantity']) }}
				</div>
				<div class="required field">
									{{ Form::label('amount', 'Amount') }}
									<div class="ui center labeled input">
									<div class="ui label">Php</div>
									{{ Form::text('amount', null, ['class' => 'money', 'placeholder' => 'Amount']) }}
									</div>
							</div>


@endsection

@section('js')
<script>
  $(document).ready( function(){
    $('#inventory').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblinventory').DataTable();


 	$('#itemTypes').on("change", function(){
    	var val = $( "select#itemTypes" ).val();

    	if(val == '1'){
    		document.getElementById('divDinnTypes').style.display = "block";
    		document.getElementById('divEquiTypes').style.display = "none";
    	}else if(val == '2'){
    		document.getElementById('divDinnTypes').style.display = "none";
    		document.getElementById('divEquiTypes').style.display = "block";
    	}else{
    		document.getElementById('divDinnTypes').style.display = "none";
    		document.getElementById('divEquiTypes').style.display = "none";
    	}
    });

    $('#itemTypeu').on("change", function(){
    	var val = $( "select#itemTypeu" ).val();

    	if(val == '1'){
    		document.getElementById('divDinnType').style.display = "block";
    		document.getElementById('divEquiType').style.display = "none";
    	}else if(val == '2'){
    		document.getElementById('divDinnType').style.display = "none";
    		document.getElementById('divEquiType').style.display = "block";
    	}else{
    		document.getElementById('divDinnType').style.display = "none";
    		document.getElementById('divEquiType').style.display = "none";
    	}
    });
  });

  function show(itemType){
  	if(itemType == '1'){
		document.getElementById('divDinnType').style.display = "block";
		document.getElementById('divEquiType').style.display = "none";
	}else if(itemType == '2'){
		document.getElementById('divDinnType').style.display = "none";
		document.getElementById('divEquiType').style.display = "block";
	}else{
		document.getElementById('divDinnType').style.display = "none";
		document.getElementById('divEquiType').style.display = "none";
	}
  }
</script>
@endsection