@extends('layouts.admin')

@section('title')
	Catering Package Detail
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
		<h1>Create Catering Package</h1>
		<hr>
	</div>
	{!! Form::open(['url' => '/cateringPackage', 'id' => 'createForm', 'class' => 'ui form']) !!}
	<div class="ui form">
		<div class="ui error message"></div>
		{{ Form::hidden('cateringPackage_code', $newID) }}
		<div class="ui horizontal divider">Package Information</div>
		<div class="two fields">
			<div class="required field">
				{{ Form::label('cateringPackage_name', 'Name') }}
				{{ Form::text('cateringPackage_name', null, ['maxlength'=>'100', 'placeholder' => 'Type Catering Package Name']) }}
			</div>
			<div class="field">
				{{ Form::label('cateringPackage_description', 'Description') }}
				{{ Form::textarea('cateringPackage_description', null, ['placeholder' => 'Type Catering Package Description', 'rows' => '2']) }}
			</div>
		</div>
		<div class="two fields">

			<div class="required field">
				{{ Form::label('packageInitAmount', 'Initial Amount') }}
				<div class="ui center labeled input">
					<div class="ui label">Php</div>
					{{ Form::text('packageInitAmount',  null, ['class' => 'money', 'placeholder' => 'This is an autocomputed field.','readonly' => '']) }}
				</div>
			</div>
			<div class="required field">
				{{ Form::label('amount', 'Amount') }}
				<div class="ui center labeled input">
					<div class="ui label">Php</div>
					{{ Form::text('amount', null, ['maxlength'=>'12', 'class' => 'money', 'placeholder' => 'Amount']) }}
				</div>
			</div>
		</div>

		<div class="ui horizontal divider">Menu Details</div>
		<div class="ui segment">
			<div class="required field">
				{{ Form::label('cateringPackage_menu[]', 'Menu') }}
				{{ Form::select('cateringPackage_menu[]', $menus, null, ['placeholder' => 'Choose a menu.', 'class' => 'ui fluid search dropdown', 'multiple' => '', 'id' => 'cateringPackage_menu']) }}
			</div>
			<div class="required field" id="sit" style="display: none;">
				<table id="tblItemList" class="ui compact celled definition table">
					<thead class="full-width">
						<tr>
							<th>Menu</th>
							<th>Pax/Serving</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>

		<div class="ui horizontal divider">Item Details</div>
		<div class="ui segment">
			<div class="required field">
				{{ Form::label('cateringPackage_item[]', 'Item') }}
				{{ Form::select('cateringPackage_item[]', $items, null, ['placeholder' => 'Choose an item.', 'class' => 'ui fluid search dropdown', 'multiple' => '', 'id' => 'cateringPackage_item']) }}
			</div>
			<div class="required field" id="lists" style="display: none;">
				<table id="tblItemLists" class="ui compact celled definition table">
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
	<br><br>
	<div class="actions">
		{{ Form::button('Submit', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
		{{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
		{!! Form::close() !!}
	</div>

@endsection

@section('js')
<style>


        #amount, #packageInitAmount{
            text-align: right;
        }

</style>
<script>
	var amount = 0;
	function addAmount(value){
    	var amount = $("#"+value).attr('data-amount');
    	var row = $("#"+value).attr('data-row');
    	alert(amount + ' ' + row);
    	$('#amount' + row).html(amount);
    }

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

    var subtotal = 0;

    $('#cateringPackage_menu').dropdown({
		onAdd: function(value,text,$addedChoice){

			document.getElementById('sit').style.display = "block";
			$("#tblItemList").find('tbody')
			.append($('<tr>')
				.attr('id', value)
				.append($('<td>')
					.append("<p>" + text + "</p>")
					).append($('<td>')
					.append($('<select>')
						.attr('name', 'rate[' + value + ']')
						.attr('id', 'rate' + value)
						.attr('required', 'true')
						.attr('class', 'menuRates')
						.attr('onchange', 'addAmount(this.value)')
						.append("<option value='' data-row='"+value+"' data-amount='0.00'>Select a rate</option>")
						)
					).append($('<td>')
					.append($('<label>')
						.attr('id', 'amount' + value)
						.html('0.00')
						)
					));

			$.ajax({
		        type: 'GET',
		        url: '/menu/getRates/' + value,
		        success: function (data) {
		        	console.log(data);
		            for (var i = 0; i < data.length; i++) {
		                $('tr#' + value).find('select#rate' +  value).append("<option id='"+data[i].menuRateCode+"' value='"+data[i].menuRateCode+"' data-row='"+value+"' data-amount='"+data[i].amount+"'>"+ data[i].pax + " pax/" + (data[i].servingType == '1' ? 'Buffet':'Set') +"</option>");
		            }
		        }
		    });
    	},
    	onRemove: function(value,text,$addedChoice){
    		$('#' + value).remove();
    		if($('tr', $('table#tblItemList').find('tbody')).length < 1){
    			document.getElementById('sit').style.display = "none";
    		}
    	}
    });

    $('#cateringPackage_item').dropdown({
		onAdd: function(value,text,$addedChoice){

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
						)
					));
    	},
    	onRemove: function(value,text,$addedChoice){
    		$('#item' + value).remove();
    		if($('tr', $('table#tblItemLists').find('tbody')).length < 1){
    			document.getElementById('lists').style.display = "none";
    		}
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
			amount: {
				identifier : 'amount',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please enter the amount'
				}

				]
			},
    cateringPackage_menu: {
      identifier : 'cateringPackage_menu',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please select a menu'
      }
      ]
    },
    cateringPackage_item: {
      identifier : 'cateringPackage_item',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please select a item'
      }
      ]
    },
    menu_rate_code: {
				identifier : 'menu_rate_code',
				rules: [ 
				
				{
				  type   : 'empty',
				  prompt : 'Please select a menu rate'
				}
				]
			},
			quantity: {
				identifier : 'quantity',
				rules: [ 
				
				{
				  type   : "regExp[^[1-9][0-9]*$]",
				  prompt : 'Please enter a valid number of Quantity'
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

    $('.money').mask("#,##0.00", {reverse: true});
    $('.number').mask("##0", {reverse: true});

    var table = $('#tblMenu').DataTable();
    var tableItem = $('#tblItem').DataTable();
  });
</script>
@endsection