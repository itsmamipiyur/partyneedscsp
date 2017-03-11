@extends('layouts.admin')
@section('title')
Package
@endsection
@section('content')
@if ($alert = Session::get('alert-success'))
<div class="ui success message">
	<div class="header">Success!</div>
	<p>{{ $alert }}</p>
</div>
@endif
@if (count($errors) > 0)
<div class="ui message">
	<div class="header">We had some issues</div>
	<ul class="list">
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="row">
	<h1>Catering Package</h1>
	<hr>
</div>
<div class="row">
	<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Catering Package</button>
</div>
<div class="row">
	<table class="ui table" id="tblPackage">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Amount</th>
				<th class="center aligned">Action</th>
			</tr>
		</thead>
		<tbody>
			@if(count($cateringPackages) < 0)
			<tr>
				<td colspan="3"><strong>Nothing to show.</strong></td>
			</tr>
			@else
			@foreach($cateringPackages as $cateringPackage)
			<tr>
				<td>{{$cateringPackage->cateringPackageName}}</td>		      
				<td>{{$cateringPackage->cateringPackageDesc}}</td>
				<td>Php {{$cateringPackage->cateringPackageAmount}}</td>
				<td class="center aligned">
					<a href="{{url('/cateringPackage/'. $cateringPackage->cateringPackageCode)}}" class="ui teal button">Package Details</a>
					<button class="ui blue button" onclick="$('#update{{$cateringPackage->cateringPackageCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($cateringPackage->deleted_at == null)
					<button class="ui red button" onclick="$('#delete{{$cateringPackage->cateringPackageCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
					@else
					<button class="ui orange button" onclick="$('#restore{{$cateringPackage->cateringPackageCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
					@endif
				</td>
			</tr>
			@endforeach
			@endif	
		</tbody>
	</table>
</div>
@if(count($cateringPackages) > 0)
@foreach($cateringPackages as $cateringPackage)
<div class="ui modal" id="update{{$cateringPackage->cateringPackageCode}}">
	<div class="header">Update Catering Package</div>
	<div class="content">
		{!! Form::open(['url' => '/cateringPackage/cateringPackage_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
		<div class="ui form">

			{{ Form::hidden('cateringPackage_code', $cateringPackage->cateringPackageCode) }}
			<div class="required field">
				{{ Form::label('cateringPackage_name', 'Name') }}
				{{ Form::text('cateringPackage_name', $cateringPackage->cateringPackageName, ['maxlength' => '25', 'placeholder' => 'Type Package Name', 'autofocus' => 'true']) }}
			</div>
			<div class="field">
				{{ Form::label('cateringPackage_description', 'Description') }}
				{{ Form::textarea('cateringPackage_description', $cateringPackage->cateringPackageDesc, ['maxlength' => '200', 'placeholder' => 'Type Package Description', 'rows' => '2']) }}
			</div>
			<div class="required field">
				{{ Form::label('amount', 'Amount') }}
				<div class="ui center labeled input">
					<div class="ui label">Php</div>
					{{ Form::text('amount', $cateringPackage->cateringPackageAmount, ['class' => 'money', 'placeholder' => 'Amount']) }}
				</div>
			</div>
		</div>
		<div class="ui error message"></div>
	</div>
	<div class="actions">
		{{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
		{{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>
</div>
<div class="ui modal" id="delete{{$cateringPackage->cateringPackageCode}}">
	<div class="header">Deactivate Catering Package</div>
	<div class="content">
		<p>Do you want to deactivate this Catering Package?</p>
	</div>
	<div class="actions">
		{!! Form::open(['url' => '/cateringPackage/' . $cateringPackage->cateringPackageCode, 'method' => 'delete']) !!}
		{{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
		{{ Form::button('No', ['class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>
</div>
<div class="ui modal" id="restore{{$cateringPackage->cateringPackageCode}}">
	<div class="header">Restore Catering Package</div>
	<div class="content">
		<p>Do you want to Restore this Catering Package?</p>
	</div>
	<div class="actions">
		{!! Form::open(['url' => '/cateringPackage/cateringPackage_restore']) !!}
		{{ Form::hidden('cateringPackage_code', $cateringPackage->cateringPackageCode) }}
		{{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
		{{ Form::button('No', ['class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>
</div>
@endforeach
@endif
<div class="ui modal" id="create">
	<div class="header">New Catering Package</div>
	<div class="content">
		{!! Form::open(['url' => '/cateringPackage', 'id' => 'createForm', 'class' => 'ui form']) !!}
		<div class="ui form">

			<div class="disabled field">
				{{ Form::hidden('cateringPackage_code', $newID, ['placeholder' => 'Type Package Code']) }}
			</div>
			<div class="required field">
				{{ Form::label('cateringPackage_name', 'Name') }}
				{{ Form::text('cateringPackage_name', '', ['maxlength' => '25', 'placeholder' => 'Type Package Name', 'autofocus' => 'true']) }}
			</div>
			<div class="field">
				{{ Form::label('cateringPackage_description', 'Description') }}
				{{ Form::textarea('cateringPackage_description', '', ['maxlength' => '200', 'placeholder' => 'Type Package Description', 'rows' => '2']) }}
			</div>
			<div class="required field">
				{{ Form::label('amount', 'Amount') }}
				<div class="ui center labeled input">
					<div class="ui label">Php</div>
					{{ Form::text('amount', null, ['maxlength' => '12', 'class' => 'money', 'placeholder' => 'Amount']) }}
				</div>
			</div>
			<div class="ui horizontal divider">Package Details</div>

			<div class="row">
				<div class="ui grid">
					<div class="eight wide column">
						<div class="required field">
							{{ Form::label('cateringPackage_menu', 'Menu') }}
							{{ Form::select('cateringPackage_menu[]', $menus, '', ['id'=>'cateringPackage_menu', 'multiple' => 'multiple', 'placeholder' => 'Select Menu', 'class' => 'ui fluid dropdown' ]) }}
						</div>
						<div id="divDinnTypes" style="display: none;">
							<table id="tblMenu" class="ui compact celled definition table">
								<thead class="full-width">
									<tr>
										<th>Menu</th>
										<th>Number of Pax</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div class="eight wide column">
						<div class="required field">
							{{ Form::label('cateringPackage_item[]', 'Items') }}
							{{ Form::select('cateringPackage_item[]', $items, '', ['id'=>'cateringPackage_item', 'multiple' => 'multiple', 'placeholder' => 'Select Item', 'class' => 'ui fluid dropdown' ]) }}
						</div>
						<div class="required field" id="sit" style="display: none;">
							<table id="tblItem" class="ui compact celled definition table">
								<thead class="full-width">
									<tr>
										<th>Item</th>
										<th>Quantity</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>

		</div>
		<div class="ui error message"></div>
	</div>
	<div class="actions">
		{{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
		{{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>

</div>	
@endsection
@section('js')
<script>
	$(document).ready( function(){
		$('.ui.modal').modal({
			onApprove : function() {
          //Submits the semantic ui form
          //And pass the handling responsibilities to the form handlers,
          // e.g. on form validation success
          //$('.ui.form').submit();
          console.log('approve');
          //Return false as to not close modal dialog
          return false;
      }
  });
		
		var formValidationRules =
		{
			cateringPackage_name: {
				identifier : 'cateringPackage_name',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please enter a name'
				},
				{

					type   : 'regExp[^(?![0-9 -]*$)[a-zA-Z0-9 -]+$]',
					prompt: "Name can only consist of alphanumeric, spaces and dashes"
				}
				]
			},
			cateringPackage_menu: {
				identifier : 'cateringPackage_menu',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please select a package menu'
				}
				]
			},
			cateringPackage_item: {
				identifier : 'cateringPackage_item',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please select a package item'
				}
				]
			},
			amount: {
				identifier : 'amount',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please enter the amount'
				}

				]
			}
		}
		var formSettings =
		{
			onSuccess : function() 
			{
				$('.modal').modal('hide');
			}
		}
		$('.ui.form').form(formValidationRules, formSettings);
		var i = $('input[name*="parameter"]').length;
		$('#cateringPackages').addClass("active grey");
		$('#cateringPackage_content').addClass("active");
		$('#cateringPackage').addClass("active");
		$('#cateringPackage_menu').dropdown({
			onAdd: function(value,text,$addedChoice){
				document.getElementById('divDinnTypes').style.display = "block";
    		//alert(value);
    		$("#tblMenu").find('tbody')
    		.append($('<tr>')
    			.attr('id', value)
    			.append($('<td>')
    				.append("<p>" + text + "</p>")
    				).append($('<td>')
    				.append($('<input>')
    					.attr('name', 'pax[' + value + ']')
    					.attr('data-validate', 'pax')
    					.attr('required', 'true')
    					.attr('type', 'text')
    					.attr('maxlength', '5')
    					)
    				)
    				);
    		//validation
    		var formValidationRules =
    		{
    			cateringPackage_name: {
    				identifier : 'cateringPackage_name',
    				rules: [
	    				{
	    					type   : 'empty',
	    					prompt : 'Please enter a name'
	    				},
	    				{

	    					type   : 'regExp[^(?![0-9 ]*$)[a-zA-Z0-9 ]+$]',
	    					prompt: "Name can only consist of letters, spaces"
	    				}
    				]
    			},
    			cateringPackage_menu: {
    				identifier : 'cateringPackage_menu',
    				rules: [
    				{
    					type   : 'empty',
    					prompt : 'Please select a package menu'
    				}
    				]
    			},
    			cateringPackage_item: {
    				identifier : 'cateringPackage_item',
    				rules: [
    				{
    					type   : 'empty',
    					prompt : 'Please select a package item'
    				}
    				]
    			},
    			amount: {
				identifier : 'amount',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please enter the valid amount'
				}
				
				]
			},
    			pax: {
    				identifier : 'pax',
    				rules: [
    				{
    					type   : 'empty',
    					prompt : 'Please specify number of pax.'
    				}
    				]
    			}
    		}
    		$('.ui.form').form(formValidationRules);
    	},
    	onRemove: function(value,text,$addedChoice){
    		//document.getElementById('divDinnTypes').style.display = "none";
    		//alert(value);
    		$('#' + value).remove();
    		//alert($('tr', $('table#tblMenu').find('tbody')).length);
    		if($('tr', $('table#tblMenu').find('tbody')).length < 1){
    			document.getElementById('divDinnTypes').style.display = "none";
    		}
    	}
    });
		$('#cateringPackage_item').dropdown({
			onAdd: function(value,text,$addedChoice){
				document.getElementById('sit').style.display = "block";
				$("#tblItem").find('tbody')
				.append($('<tr>')
					.attr('id', value)
					.append($('<td>')
						.append("<p>" + text + "</p>")
						).append($('<td>')
						.append($('<input>')
							.attr('name', 'quantity[' + value + ']')
							.attr('data-validate', 'quantity')
							.attr('required', 'true')
							.attr('type', 'text')
							.attr('maxlength', '5')
							)
						)
						);
    		//validation
    		var formValidationRules =
    		{
    			cateringPackage_name: {
    				identifier : 'cateringPackage_name',
    				rules: [
    				{
    					type   : 'empty',
    					prompt : 'Please enter a name'
    				},
    				{

    					type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

	        	
	           
				prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
    				}
    				]
    			},
    			cateringPackage_menu: {
    				identifier : 'cateringPackage_menu',
    				rules: [
    				{
    					type   : 'empty',
    					prompt : 'Please select a package menu'
    				}
    				]
    			},
    			cateringPackage_item: {
    				identifier : 'cateringPackage_item',
    				rules: [
    				{
    					type   : 'empty',
    					prompt : 'Please select a package item'
    				}
    				]
    			},
    			amount: {
				identifier : 'amount',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please enter the valid amount'
				}
				]
				},
    			quantity: {
    				identifier : 'quantity',
    				rules: [
    				{
    					type   : 'empty',
    					prompt : 'Please specify the quantity of item/s',
    				}
    				]
    			},
    			pax: {
    				identifier : 'pax',
    				rules: [
    				{
    					type   : 'empty',
    					prompt : 'Please specify the number of pax of menu/s',
    				}
    				]
    			},
    		}
    		$('.ui.form').form(formValidationRules);
    	},
    	onRemove: function(value,text,$addedChoice){
    		
    		//alert(value);
    		$('#' + value).remove();
    		//alert($('tr', $('table#tblMenu').find('tbody')).length);
    		if($('tr', $('table#tblItem').find('tbody')).length < 1){
    			document.getElementById('sit').style.display = "none";
    		}
    	}
    });
		$('.money').mask("##0.00", {reverse: true});
		var table = $('#tblPackage').DataTable();
		$('#cateringPackageType').on("change", function(){
			var val = $( "select#cateringPackageType" ).val();
			if(val == '1'){
				document.getElementById('typeSelect').style.display = "block";
			}else{
				document.getElementById('typeSelect').style.display = "none";
			}
		});
	});
</script>
@endsection