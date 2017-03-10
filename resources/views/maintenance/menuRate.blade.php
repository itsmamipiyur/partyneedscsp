@extends('layouts.admin')

@section('title')
	Menu Rate
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Menu Rate</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Menu Rate</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblmenurate">
		  <thead>
		    <tr>
		    	<th>Menu</th>
		    	<th>Serving Type</th>
			    <th>Amount</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($menuRates) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($menuRates as $menuRate)
			  	<tr>
			  	  <td>{{$menuRate->menu->menuName}}</td>
			  	  @if($menuRate->servingType == '1')
			  	  	<td>Buffet</td>
			  	  @elseif($menuRate->servingType == '2')
			  	  	<td>Set</td>
			  	  @endif
			  	  @if($menuRate->servingType == '1')
			  	  	<td>Php {{$menuRate->amount}}/{{$menuRate->quantity}} kg</td>
			  	  @elseif($menuRate->servingType == '2')
			  	  	<td>Php {{$menuRate->amount}}</td>
			  	  @endif
			      
			      <td class="center aligned">
					<button class="ui blue button" onclick="show('{{$menuRate->servingType}}'); $('#update{{$menuRate->menuRateCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($menuRate->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$menuRate->menuRateCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$menuRate->menuRateCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($menuRates) > 0)
@foreach($menuRates as $menuRate)
	<div class="ui modal" id="update{{$menuRate->menuRateCode}}">
	  <div class="header">Update</div>
	  <div class="content">
	   {!! Form::open(['url' => '/menuRate/menuRate_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
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
	    		{{ Form::hidden('menu_rate_code', $menuRate->menuRateCode) }}
	    		<div class="required field">
	    			{{ Form::label('menu_code', 'Menu') }}
         			{{ Form::select('menu_code', $menus, $menuRate->menuCode, ['placeholder' => 'Choose Menu', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('serving_type', 'Serving Type') }}
         			{{ Form::select('serving_type', $servingTypes, $menuRate->servingType, ['id' => 'servingtype', 'placeholder' => 'Choose Serving Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" id="divQuantity" style="display: none;">
	    			{{ Form::label('quantity', 'Quantity') }}
         			{{ Form::text('quantity', $menuRate->quantity, ['placeholder' => 'Type Quantity']) }}
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

	<div class="ui modal" id="delete{{$menuRate->menuRateCode}}">
	  <div class="header">Deactivate</div>
	  <div class="content">
	    <p>Do you want to delete this Menu Rate?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menuRate/' . $menuRate->menuRateCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$menuRate->menuRateCode}}">
	  <div class="header">Restore</div>
	  <div class="content">
	    <p>Do you want to Restore this Menu Rate?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menuRate/menuRate_restore']) !!}
	  		{{ Form::hidden('menu_rate_code', $menuRate->menuRateCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New</div>
	  <div class="content">
	    {!! Form::open(['url' => '/menuRate', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
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

	    		<div class="disabled field">
	    			{{ Form::label('menu_rate_code', 'Code') }}
         			{{ Form::text('menu_rate_code', $newID, ['placeholder' => 'Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('menu_code', 'Menu') }}
         			{{ Form::select('menu_code', $menus, null, ['placeholder' => 'Choose Menu', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('serving_type', 'Serving Type') }}
         			{{ Form::select('serving_type', $servingTypes, null, ['id' => 'servingTypes', 'placeholder' => 'Choose Serving Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" id="divQuantitys" style="display: none;">
	    			{{ Form::label('quantity', 'Quantity') }}
         			{{ Form::text('quantity', null, ['placeholder' => 'Type Quantity']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('amount', 'Amount') }}
         			{{ Form::text('amount', null, ['class' => 'money','placeholder' => 'Type Amount']) }}
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
		menu_code: {
        identifier: 'menu_code',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select a menu'
          }
        ]
      },
		serving_type: {
        identifier: 'serving_type',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select a serving type'
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





    $('#menuRate').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblmenurate').DataTable();

    $('#servingTypes').on("change", function(){
    	var val = $( "select#servingTypes" ).val();

    	if(val == '1'){
    		document.getElementById('divQuantitys').style.display = "block";
    	}else{
    		document.getElementById('divQuantitys').style.display = "none";
    	}
    });

    $('#servingtype').on("change", function(){
    	var val = $( "select#servingtype" ).val();

    	if(val == '1'){
    		document.getElementById('divQuantity').style.display = "block";
    	}else{
    		document.getElementById('divQuantity').style.display = "none";
    	}
    });

    $('.money').mask("##0.00", {reverse: true});
  });

  function show(val){
  	alert(val);
  	if(val == '1'){
    		document.getElementById('divQuantity').style.display = "block";
    	}else{
    		document.getElementById('divQuantity').style.display = "none";
    	}
  }
</script>
@endsection
