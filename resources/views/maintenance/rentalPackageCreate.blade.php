@extends('layouts.admin')

@section('title')
	Rental Package Detail
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
		<h1>Create Rental Package</h1>
		<hr>
	</div>
	{!! Form::open(['url' => '/rentalPackage', 'id' => 'createForm', 'class' => 'ui form']) !!}
	<div class="ui form">
		<div class="ui error message"></div>
		{{ Form::hidden('rentalPackageCode', $newID) }}
		<div class="ui horizontal divider">Package Information</div>
		<div class="two fields">
			<div class="required field">
	    			{{ Form::label('rentalPackage_name', 'Name') }}
         			{{ Form::text('rentalPackage_name', '', ['maxlength' => '25', 'placeholder' => 'Type Package Name', 'autofocus' => 'true']) }}
	    		</div>
			<div class="field">
				{{ Form::label('cateringPackage_description', 'Description') }}
				{{ Form::textarea('cateringPackage_description', null, ['placeholder' => 'Type Catering Package Description', 'rows' => '2']) }}
			</div>
		</div>


		<div class="two fields">
			<div class="required field">
	    			{{ Form::label('rentalPackage_duration', 'Duration') }}
         			{{ Form::text('rentalPackage_duration', '', ['id' => 'rentalPackage_duration', 'maxlength'=>'4', 'placeholder' => 'Duration']) }}
	    		</div>

	    		<div class="required field">
	    			{{ Form::label('rentalPackage_unit', 'Unit') }}
         			{{ Form::select('rentalPackage_unit', $units, null, ['id' => 'rentalPackage_unit', 'placeholder' => 'Choose Unit', 'class' => 'ui fluid dropdown']) }}
	    		</div>
		</div>



		<div class="two fields">
			<div class="required field">
				{{ Form::label('packageInitAmount', 'Initial Amount') }}
				<div class="ui center labeled input">
					<div class="ui label">Php</div>
					{{ Form::text('packageInitAmount',  null, ['style' => 'text-align: right;', 'class' => 'money', 'placeholder' => 'This is an autocomputed field.','readonly' => '']) }}
				</div>
			</div>
			<div class="required field">
				{{ Form::label('amount', 'Amount') }}
				<div class="ui center labeled input">
					<div class="ui label">Php</div>
					{{ Form::text('amount', null, ['style' => 'text-align: right;','maxlength'=>'12', 'class' => 'money', 'placeholder' => 'Amount']) }}
				</div>
			</div>
		</div>



		<div class="ui horizontal divider">Item Details</div>
		<div class="ui segment">
			<div class="required field">
				{{ Form::label('rentalPackage_item[]', 'Item') }}
				<select name="rentalPackage_item[]" class="ui fluid search dropdown" multiple="" id="rentalPackage_item">
					<option value="">Choose an item...</option>
					@foreach($items as $item)
					<option value="{{ $item->itemCode }}" data-hour="{{ (count($item->rates()->hour()) > 0) ? $item->rates()->latestHour()->amount : '0' }}" data-day="{{ (count($item->rates()->day()) > 0) ? $item->rates()->latestDay()->amount : '0' }}" id="#itemopt{{ $item->itemCode }}">{{ $item->itemName }}</option>
					@endforeach
				</select>
			</div>
			<div class="required field" id="lists" style="display: none;">
				<table id="tblItemLists" class="ui compact celled definition table">
					<thead class="full-width">
						<tr>
							<th>Item</th>
							<th>Quantity</th>
							<th>Duration (in hour)</th>
							<th class="right aligned">Amount</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr class="summary">
							<td colspan="3" class="right aligned">Subtotal:</td>
							<td class="right aligned" id="totsub"><strong>0.00</strong></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<br><br>
	<div class="actions">
		{{ Form::button('Submit', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
		{{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>

@endsection


@section('js')
<script>

	var subtotalItem = 0;
	var amount = 0;
	var pax = "hehehe";





	


	function computeSubtotal(value, amount){
		amount = parseFloat(amount);
    	var qty = (($("input#quantity"+value).val() == '') ? 0 : parseFloat($("input#quantity"+value).val()));
    	var hr = parseFloat($('#rentalPackage_duration').val());


  //   	$('#rentalPackage_unit').change(function() {
		// var status = this.value;
	 //     if(status == 1){
	 //     	hr = parseFloat($('#rentalPackage_duration').val()* 1);
	 //     }else if(status == 2){
	 //     	hr = parseFloat($('#rentalPackage_duration').val()* 24);
	 //     }

		// });




    	$('td#subt'+value).html(((amount*qty)*hr).toFixed(2));
    	// var hr = (($("rentalPackage_duration").val() == '') ? 0 : parseFloat($("rentalPackage_duration").val()));

    	// $('td#subt'+value).html(((amount*qty)*hr).toFixed(2));



    	$('#tblItemLists').sumtr({
    		formatValue : function(val) { 
    			subtotalItem = parseFloat(val.toFixed(2)); 
    			return  val.toFixed(2); 
    		},
    	});

    	console.log(subtotalItem);
    	var totalSub = subtotalItem;
	    dispSubt = Math.abs(totalSub.toFixed(2));
		$('#packageInitAmount').val(dispSubt);
    }


	

	

	$('#rentalPackage_item').dropdown({
		onAdd: function(value, text, choice){
			console.log(value);
			var amount =  $(this).children('option[value=' + $(choice).data('value') + ']').data('hour');
			console.log(amount);

			document.getElementById('lists').style.display = "block";
			$("#tblItemLists").find('tbody')
			.append($('<tr>')
				.attr('id', 'item'+value)
				.append($('<td>')
					.append("<p>" + text + "</p>")
					).append($('<td>')
					.append($('<input>')
						.attr('name', 'quantity[' + value + ']')
						.attr('id', 'quantity' + value)
						.attr('required', 'true')
						.attr('placeholder', 'Type Quantity')
						.attr('type', 'number')
						.attr('min', '0')
						.attr('onBlur', 'computeSubtotal("' + value + '", ' + amount + ')')
						)
					).append($('<td>')
					.append($('<input>')
						.attr('name', 'hour[' + value + ']')
						.attr('id', 'hour' + value)
						.attr('required', 'true')
						.attr('placeholder', 'Type Hour')
						.attr('type', 'number')
						.attr('min', '0')
						.attr('onBlur', 'computeSubtotal("' + value + '", ' + amount + ')' )
						)
					).append($('<td>')
						.attr('id', 'subt' + value)
						.attr('class', 'sum right aligned')
						.html('0.00')));
		},
		onRemove: function(value, text, choice){
    		$('#tblItemLists').sumtr({
	    		formatValue : function(val) { 
	    			subtotalItem -= parseFloat(val.toFixed(2));
	    			console.log('hehehe : ' + subtotalItem);  
	    			return subtotalItem.toFixed(2); 
	    		},
	    	});

			$('#item' + value).remove();
    		if($('tr', $('table#tblItemLists').find('tbody')).length < 1){
    			document.getElementById('lists').style.display = "none";
    			subtotalItem = 0;
    			$('td#totsub').html('0.00');
    		}


	    	var totalSub = subtotalMenu - subtotalItem;
	    	dispSubt = Math.abs(totalSub.toFixed(2));
		    $('#packageInitAmount').val(dispSubt);
		},
	});




 	var formValidationRules =
	{
		rentalPackage_name: {
		  identifier : 'rentalPackage_name',
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
		rentalPackage_duration: {
      identifier : 'rentalPackage_duration',
      rules: [
      {
		  type   : "regExp[^[1-9][0-9]*$]",
		  prompt : 'Please enter a valid number of Duration'
		},
      {
        type   : 'empty',
        prompt : 'Please enter the Duration'
      }

      ]
    },
		rentalPackage_unit: {
      identifier : 'rentalPackage_unit',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please select a Unit'
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
    rentalPackage_item: {
      identifier : 'rentalPackage_item',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please select a rental item'
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

	$('.money').mask("#,##0.00", {reverse: true});
    $('.number').mask("##0", {reverse: true});
</script>
@endsection
