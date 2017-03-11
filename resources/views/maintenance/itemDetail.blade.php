@extends('layouts.admin')

@section('title')
Item Detail
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
	<h1><a href="/item"><i class="grey chevron circle left icon"></i></a> Item Detail for {{$item->itemName}}</h1>
	<hr>
</div>


<!-- dish -->
<div class="row">
	<div class="ui segment">
		<h3>Rates</h3>
		<div class="ui grid">
			<div class="eight wide column">
				<div class="row">
					<table class="ui table" id="tblItem">
						<thead>
							<tr>
								<th>Rate Amount</th>
								<th>Rate Unit</th>
								<th class="center aligned">Action</th>
							</tr>
						</thead>
						<tbody>

							@foreach($itemRates as $itemRate)
							<tr>
								<td>{{$itemRate->amount}}</td>
								@if($itemRate->uomCode == '1')
								<td>Hour</td>
								@elseif($itemRate->uomCode == '2')
								<td>Day</td>
								@endif
								<td class="center aligned">
									<button class="ui icon circular blue button" onclick="$('#updateRate{{$itemRate->itemRateCode}}').modal('show');"><i class="edit icon"></i></button>
									<button class="ui icon circular red button" onclick="$('#deleteRate{{$itemRate->itemRateCode}}').modal('show');"><i class="delete icon"></i></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

			<!-- rate -->
			<div class="eight wide column">
				<div class="row">
					<div class="ui segment">
						<h3>New Rate</h3>
						{!! Form::open(['url' => '/item/addItemRate', 'id' => 'createForm', 'class' => 'ui form']) !!}
						{{ Form::hidden('item_rate_code', $newID) }}
						{{ Form::hidden('item_code', $item->itemCode) }}
						<div class="ui form">	    
							<div class="two fields">
								<div class="required field">
									{{ Form::label('unit', 'Unit') }}
									{{ Form::select('unit', $units, null, ['id' => 'unit', 'placeholder' => 'Choose Unit', 'class' => 'ui search dropdown']) }}
								</div>
							</div>
							<div class="required field">
								{{ Form::label('amount', 'Amount') }}
								<div class="ui center labeled input">
									<div class="ui label">Php</div>
									{{ Form::text('amount', null, ['maxlength'=>'12','class' => 'money', 'placeholder' => 'Amount']) }}
								</div>
							</div>
							<div class="ui error message"></div>
						</div>
						<div class="actions">
							{{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
							{{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="ui segment">
		<h3>Penalty Fee</h3>
		<div class="ui grid">
			<div class="eight wide column">
				<div class="row">
					<table class="ui table" id="tblPenalty">
						<thead>
							<tr>
								<th>Penalty Type</th>
								<th>Minimum Level</th>
								<th>Fee</th>
								<th class="center aligned">Action</th>
							</tr>
						</thead>
						<tbody>

							@foreach($penaltyFees as $penaltyFee)
							<tr>
								@if($penaltyFee->penaltyType == '1')
								<td>Missing</td>
								@elseif($penaltyFee->penaltyType == '2')
								<td>Damaged</td>
								@endif
								<td>{{$penaltyFee->minLevel}}</td>
								<td>{{$penaltyFee->amount}}</td>
								<td class="center aligned">
									<button class="ui icon circular blue button" onclick="$('#updatePenalty{{$penaltyFee->penaltyItemCode}}').modal('show');"><i class="edit icon"></i></button>
									<button class="ui icon circular red button" onclick="$('#deletePenalty{{$penaltyFee->penaltyItemCode}}').modal('show');"><i class="delete icon"></i></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

			<!-- rate -->
			<div class="eight wide column">
				<div class="row">
					<div class="ui segment">
						<h3>New Penalty</h3>
						{!! Form::open(['url' => '/item/addPenalty', 'id' => 'createForm', 'class' => 'ui form']) !!}
						{{ Form::hidden('penalty_code', $newIDs) }}
						{{ Form::hidden('item_code', $item->itemCode) }}
						<div class="ui form">	    
							<div class="two fields">
								<div class="required field">
									{{ Form::label('penalty_type', 'Penalty Type') }}
									{{ Form::select('penalty_type', $penaltyTypes, null, ['id' => 'unit', 'placeholder' => 'Choose Penalty Type', 'class' => 'ui search dropdown']) }}
								</div>
								<div class="required field">
									{{ Form::label('minimum_level', 'Minimum Level') }}
									{{ Form::text('minimum_level', null, ['maxlength'=>'10', 'id' => 'minLevel', 'placeholder' => 'Type Minimum Level']) }}
								</div>
							</div>
							<div class="required field">
								{{ Form::label('amount', 'Amount') }}
								<div class="ui center labeled input">
									<div class="ui label">Php</div>
									{{ Form::text('amount', null, ['maxlength'=>'12','class' => 'money', 'placeholder' => 'Amount']) }}
								</div>
							</div>
							<div class="ui error message"></div>
						</div>
						<div class="actions">
							{{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
							{{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if(count($itemRates) > 0)
@foreach($itemRates as $itemRate)
<div class="ui modal" id="updateRate{{$itemRate->itemRateCode}}">
	<div class="header">Update</div>
	<div class="content">
		{!! Form::open(['url' => '/item/updateItemRate', 'id' => 'createForm', 'class' => 'ui form']) !!}
		{{ Form::hidden('item_rate_code', $itemRate->itemRateCode) }}
		{{ Form::hidden('item_code', $item->itemCode) }}
		<div class="ui form">	    
			<div class="required field">
				{{ Form::label('amount', 'Amount') }}
				<div class="ui center labeled input">
					<div class="ui label">Php</div>
					{{ Form::text('amount', $itemRate->amount, ['maxlength'=>'12','class' => 'money', 'placeholder' => 'Amount']) }}
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

<div class="ui modal" id="deleteRate{{$itemRate->itemRateCode}}">
	<div class="header">Deactivate</div>
	<div class="content">
		<p>Do you want to delete this Item Rate?</p>
	</div>
	<div class="actions">
		{!! Form::open(['url' => '/item/deleteItemRate']) !!}
		{{ Form::hidden('item_rate_code', $itemRate->itemRateCode) }}
		{{ Form::hidden('item_code', $item->itemCode) }}
		{{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
		{{ Form::button('No', ['class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>
</div>
@endforeach
@endif


@if(count($penaltyFees) > 0)
@foreach($penaltyFees as $penaltyFee)
<div class="ui modal" id="updatePenalty{{$penaltyFee->penaltyItemCode}}">
	<div class="header">Update</div>
	<div class="content">
		{!! Form::open(['url' => '/item/updatePenalty', 'id' => 'createForm', 'class' => 'ui form']) !!}
		{{ Form::hidden('penalty_code', $penaltyFee->penaltyItemCode) }}
		{{ Form::hidden('item_code', $item->itemCode) }}
		<div class="ui form">	    
			<div class="two fields">
				<div class="required field">
					{{ Form::label('minimum_level', 'Minimum Level') }}
					{{ Form::text('minimum_level', $penaltyFee->minLevel, ['maxlength'=>'10', 'id' => 'minLevel', 'placeholder' => 'Type Minimum Level']) }}
				</div>
				<div class="required field">
					{{ Form::label('amount', 'Amount') }}
					<div class="ui center labeled input">
						<div class="ui label">Php</div>
						{{ Form::text('amount', $penaltyFee->amount, ['maxlength'=>'12','class' => 'money', 'placeholder' => 'Amount']) }}
					</div>
				</div>
			</div>
			<div class="ui error message"></div>
		</div>
	</div>
	<div class="actions">
		{{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
		{{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>
</div>

<div class="ui modal" id="deletePenalty{{$penaltyFee->penaltyItemCode}}">
	<div class="header">Deactivate</div>
	<div class="content">
		<p>Do you want to delete this Penalty?</p>
	</div>
	<div class="actions">
		{!! Form::open(['url' => '/item/deletePenalty']) !!}
		{{ Form::hidden('penalty_code', $penaltyFee->penaltyItemCode) }}
		{{ Form::hidden('item_code', $item->itemCode) }}
		{{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
		{{ Form::button('No', ['class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>
</div>
@endforeach
@endif


<!-- item dish -->
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
			unit: {
				identifier : 'unit',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please select a unit'
				}
				]
			},
			dish_code: {
				identifier : 'dish_code',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please select a item dish'
				}
				]
			},
			item_type: {
				identifier : 'item_type',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please select a item type'
				}
				]
			},
			pax: {
				identifier : 'pax',
				rules: [ 
				{
					type   : 'empty',
					prompt : 'Please enter the No. of pax'
				}
				]
			},
			minimum_level: {
				identifier : 'minimum_level',
				rules: [ 
				{
					type   : 'empty',
					prompt : 'Please enter the minimum level'
				}
				]
			},

			amount: {
				identifier : 'amount',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[0]',
				    prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[00]',
				    prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[0.00]',
				    prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[00.00]',
				    prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[000.00]',
				    prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[0000.00]',
				    prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[00000.00]',
				    prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[000000.00]',
				    prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[0000000.00]',
				    prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[00000000.00]',
				    prompt : 'Please enter the valid amount'
				},
				{
				    type   : 'not[000000000.00]',
				    prompt : 'Please enter the valid amount'
				},
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

		$('#items').addClass("active grey");
		$('#item_content').addClass("active");
		$('#item').addClass("active");
		$('.money').mask("##0.00", {reverse: true});

		var table = $('#tblItem').DataTable();
		var penalty = $('#tblPenalty').DataTable();
	});
</script>
@endsection