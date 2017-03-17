@extends('layouts.admin')

@section('title')
Menu Detail
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
	<h1><a href="/menu"><i class="grey chevron circle left icon"></i></a> Menu Detail for {{$menu->menuName}}</h1>
	<hr>
</div>


<div class="ui top attached tabular menu">
  <a class="item active" data-tab="dish">Dish</a>
  <a class="item" data-tab="rate">Rate</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="dish">
  <div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Menu Dish</button>
	</div>
	<table class="ui table" id="tblMenu">
		<thead>
			<tr>
				<th>Menu Dish</th>
				<th>Dish Type</th>
				<th class="center aligned">Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach($menu->dishes as $menuDish)
			<tr>
				<td>{{$menuDish->dishName}}</td>
				<td>{{$menuDish->dishType->dishTypeName}}</td>
				<td class="center aligned">
					<button class="ui red button" onclick="$('#delete{{$menuDish->dishCode}}').modal('show');"><i class="delete icon"></i> Remove</button>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="ui bottom attached tab segment" data-tab="rate">
  <div class="ui grid">
		<div class="ten wide column">
			<h3>Menu Rates</h3>
			<table class="ui table" id="tblMenuRate">
				<thead>
					<tr>
						<th>Menu Type</th>
						<th>Number of Pax</th>
						<th>Amount</th>
						<th>Effective Date</th>
						<th class="center aligned">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($menuRates as $menuRate)
					<tr>
						@if( $menuRate->servingType == '1' )
						<td>Buffet</td>
						@elseif( $menuRate->servingType == '2' )
						<td>Set</td>
						@endif
						<td>{{ $menuRate->pax }}</td>
						<td>Php {{ $menuRate->amount }}</td>
						<td>{{ $menuRate->effectiveDate }}</td>
						<td class="center aligned">
							<button class="ui icon circular blue button" onclick="$('#updateRate{{$menuRate->menuRateCode}}').modal('show');"><i class="edit icon"></i></button>
							<button class="ui icon circular red button" onclick="$('#deleteRate{{$menuRate->menuRateCode}}').modal('show');"><i class="delete icon"></i></button>
						</td>
					</tr>							
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="six wide column">
			<div class="ui segment">
				<h3>New Menu Rate</h3>
				{!! Form::open(['url' => '/menu/addMenuRate', 'id' => 'createForm', 'class' => 'ui form']) !!}
				<div class="ui form">
					{{ Form::hidden('menu_code', $menu->menuCode) }}
					{{ Form::hidden('menu_rate_code', $newID) }}
					<div class="two fields">
						<div class="required field">
							{{ Form::label('menu_type', 'Menu Type') }}
							{{ Form::select('menu_type', $menuTypes, null, ['id' => 'menuTypes', 'placeholder' => 'Choose Menu Type', 'class' => 'ui search dropdown']) }}
						</div>
						<div class="required field" id="divQuantitys">
							{{ Form::label('pax', 'Number of Pax') }}
							{{ Form::text('pax', null, ['maxlength'=>'9', 'placeholder' => 'Type No. of Pax']) }}
						</div>
					</div>
					<div class="two fields">
							<div class="required field">
								{{ Form::label('amount', 'Amount') }}
								<div class="ui center labeled input">
									<div class="ui label">Php</div>
									{{ Form::text('amount', null, ['maxlength'=>'12','class' => 'money', 'placeholder' => 'Amount']) }}
								</div>
							</div>
							<div class="required field">
								{{ Form::label('effective_date', 'Effective Date') }}
								{{ Form::text('effective_date', null, ['class' => 'effectiveDate', 'placeholder' => 'Select Date']) }}
							</div>
						</div>
					<div class="actions">
						{{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
						{{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
						{!! Form::close() !!}
					</div>
					<div class="ui error message"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- menu dish -->

@if(count($menu->dishes) > 0)
@foreach($menu->dishes as $menuDish)
<div class="ui modal" id="delete{{$menuDish->dishCode}}">
	<div class="header">Remove Menu Dish</div>
	<div class="content">
		<p>Do you want to remove this menu dish?</p>
	</div>
	<div class="actions">
		{!! Form::open(['url' => '/menu/removeMenuDish']) !!}
		{{ Form::hidden('menu_code', $menu->menuCode) }}
		{{ Form::hidden('dish_code', $menuDish->dishCode) }}
		{{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
		{{ Form::button('No', ['class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>
</div>
@endforeach
@endif

<div class="ui modal" id="create">
	<div class="header">New Menu Dish</div>
	<div class="content">
		{!! Form::open(['url' => '/menu/addMenuDish', 'id' => 'createForm', 'class' => 'ui form']) !!}
		<div class="ui form">


			{{ Form::hidden('menu_code', $menu->menuCode) }}

			<div class="required field">
				{{ Form::label('dish_code', 'Dish') }}
				{{ Form::select('dish_code', $dishes, null, ['placeholder' => 'Choose Dish', 'class' => 'ui search dropdown']) }}
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

@if(count($menuRates) > 0)
@foreach($menuRates as $menuRate)
<div class="ui modal" id="updateRate{{$menuRate->menuRateCode}}">
	<div class="header">Update</div>
	<div class="content">
		{!! Form::open(['url' => '/menu/updateMenuRate', 'id' => 'createForm', 'class' => 'ui form']) !!}
		<div class="ui form">
			{{ Form::hidden('menu_rate_code', $menuRate->menuRateCode) }}
			{{ Form::hidden('menu_code', $menu->menuCode) }}
			<div class="required field">
				{{ Form::label('menu_type', 'Serving Type') }}
				{{ Form::select('menu_type', $menuTypes, $menuRate->servingType, ['id' => 'servingtype', 'placeholder' => 'Choose Serving Type', 'class' => 'ui search dropdown']) }}
			</div>
			<div class="required field">
				{{ Form::label('pax', 'Number of Pax') }}
				{{ Form::text('pax', $menuRate->pax, ['maxlength'=>'9', 'placeholder' => 'Type Number of Pax']) }}
			</div>
			<div class="required field">
				{{ Form::label('amount', 'Amount') }}
				{{ Form::text('amount', $menuRate->amount, ['class' => 'money','placeholder' => 'Type Amount']) }}
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

<div class="ui modal" id="deleteRate{{$menuRate->menuRateCode}}">
	<div class="header">Deactivate</div>
	<div class="content">
		<p>Do you want to delete this Menu Rate?</p>
	</div>
	<div class="actions">
		{!! Form::open(['url' => '/menu/deleteMenuRate']) !!}
		{{ Form::hidden('menu_rate_code', $menuRate->menuRateCode) }}
		{{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
		{{ Form::button('No', ['class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>
</div>
@endforeach
@endif

@endsection

@section('js')
<script>
	$(document).ready( function(){
		$('.effectiveDate').datetimepicker();

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

			dish_code: {
				identifier : 'dish_code',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please select a menu dish'
				}
				]
			},
			menu_type: {
				identifier : 'menu_type',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please select a menu type'
				}
				]
			},
			pax: {
				identifier : 'pax',
				rules: [ 
				
				{
				  type   : "regExp[^[1-9][0-9]*$]",
				  prompt : 'Please enter a valid number of pax'
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

















		$('#menus').addClass("active grey");
		$('#menu_content').addClass("active");
		$('#menu').addClass("active");
		$('.money').mask("##0.00", {reverse: true});
		$('.menu .item').tab();

		var table = $('#tblMenu').DataTable();
		var tablerate = $('#tblMenuRate').DataTable();
	});
</script>
@endsection