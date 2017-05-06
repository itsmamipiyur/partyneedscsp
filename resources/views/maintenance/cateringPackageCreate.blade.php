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
			<div class="required field">
				{{ Form::label('cateringPackage_pax', 'No. of Pax') }}
				{{ Form::number('cateringPackage_pax', null, ['placeholder' => 'Type No. of Pax', 'min' => '0']) }}
			</div>
		</div>
		<div class="two fields">
			<div class="required inline fields">
				<label>Serving Type</label>
				<div class="field">
					<div class="ui radio checkbox">
						<input type="radio" name="servingType" checked="checked" id="rdoBuffet" value="1">
						<label>Buffet</label>
					</div>
				</div>
				<div class="field">
					<div class="ui radio checkbox">
						<input type="radio" name="servingType" id="rdoSet" value="2">
						<label>Set</label>
					</div>
				</div>
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

		<div class="ui horizontal divider">Menu Details</div>
		<div class="ui segment">
			<div class="required field">
				{{ Form::label('cateringPackage_menu[]', 'Menu') }}
				<select name="cateringPackage_menu[]" class="ui disabled fluid search dropdown" multiple="" id="cateringPackage_menu">
					<option value="">Choose a menu...</option>
					@foreach($menus as $menu)
					<option value="{{ $menu->menuCode }}" data-buffet="{{ (count($menu->rates()->buffet()) > 0) ? $menu->rates()->latestBuffet()->amount : '0' }}" data-set="{{ (count($menu->rates()->set()) > 0) ? $menu->rates()->latestSet()->amount : '0' }}">{{ $menu->menuName }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="ui horizontal divider">Item Details</div>
		<div class="ui segment">
			<div class="required field">
				{{ Form::label('cateringPackage_item[]', 'Item') }}
				<select name="cateringPackage_item[]" class="ui fluid search dropdown" multiple="" id="cateringPackage_item">
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
	var subtotalMenu = 0;
	var subtotalItem = 0;
	var amount = 0;
	var type = "";
	var pax = "hehehe";

	function computeSubtotal(value, amount){
		amount = parseFloat(amount);
    	var qty = (($("input#quantity"+value).val() == '') ? 0 : parseFloat($("input#quantity"+value).val()));
    	var hr = (($("input#hour"+value).val() == '') ? 0 : parseFloat($("input#hour"+value).val()));
    	$('td#subt'+value).html(((amount*qty)*hr).toFixed(2));

    	$('#tblItemLists').sumtr({
    		formatValue : function(val) { 
    			subtotalItem = parseFloat(val.toFixed(2)); 
    			return  val.toFixed(2); 
    		},
    	});

    	console.log(subtotalItem);
    	var totalSub = subtotalMenu - subtotalItem;
	    dispSubt = Math.abs(totalSub.toFixed(2));
		$('#packageInitAmount').val(dispSubt);
    }


	$('#cateringPackage_pax').on('blur', function(){
		if( $(this).val() == '' || $(this).val() == '0'){
			$('#cateringPackage_menu').parent().addClass('disabled');
			$('#cateringPackage_menu').dropdown('clear');
			subtotalMenu = 0;
			var totalSub = subtotalMenu - subtotalItem;
	    	dispSubt = Math.abs(totalSub.toFixed(2));
		    $('#packageInitAmount').val(dispSubt);
		}else{
			$('#cateringPackage_menu').parent().removeClass('disabled');
		}
	});

	$('#cateringPackage_menu').dropdown({
	    onAdd: function(value, text, choice) {
	      pax = (($('#cateringPackage_pax').val() != '') ? $('#cateringPackage_pax').val() : 0);
	      if($('#rdoBuffet').is(':checked')){
	      	amount =  $(this).children('option[value=' + $(choice).data('value') + ']').data('buffet');
	      	type = "Buffet";
	      }else if($('#rdoSet').is(':checked')){
	      	amount =  $(this).children('option[value=' + $(choice).data('value') + ']').data('set');
	      	type = "Set";
	      }

	      subtotalMenu += (parseFloat(amount) * parseInt(pax));
	      var totalSub = Math.abs(subtotalMenu - subtotalItem);
	      var dispSubt = totalSub.toFixed(2);
	      $('#packageInitAmount').val(dispSubt);
	    },
	    onRemove: function(value, text, choice) {
	      pax = (($('#cateringPackage_pax').val() != '') ? $('#cateringPackage_pax').val() : 0);
	      if($('#rdoBuffet').is(':checked')){
	      	amount =  $(this).children('option[value=' + $(choice).data('value') + ']').data('buffet');
	      	type = "Buffet";
	      }else if($('#rdoSet').is(':checked')){
	      	amount =  $(this).children('option[value=' + $(choice).data('value') + ']').data('set');
	      	type = "Set";
	      }
	      console.log(pax);
	      subtotalMenu -= (parseFloat(amount) * parseInt(pax));
	      var totalSub = subtotalMenu - subtotalItem;
	      dispSubt = Math.abs(totalSub.toFixed(2));
		  $('#packageInitAmount').val(dispSubt);
	    },
	});

	$('#cateringPackage_item').dropdown({
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

  // $(document).ready( function(){
  //   $('#menus').addClass("active grey");
  //   $('#menu_content').addClass("active");
  //   $('#menu').addClass("active");

     $('.money').mask("#,##0.00", {reverse: true});
     $('.number').mask("##0", {reverse: true});
  // });




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

			cateringPackage_pax: {
				identifier : 'cateringPackage_pax',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please enter the PAX'
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


</script>
@endsection