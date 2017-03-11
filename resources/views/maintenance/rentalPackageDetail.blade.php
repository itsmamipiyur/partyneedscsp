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
		<h1><a href="/rentalPackage"><i class="grey chevron circle left icon"></i></a> Rental Package Detail for {{$rentalPackage->rentalPackageName}}</h1>
		<hr>
	</div>

	<div class="row">
		<div class="row">
			<button type="button" class="ui orange button" onclick="$('#createItem').modal('show');"><i class="add icon"></i>Add Package Item</button>
		</div>
		<div class="row">					
			<table class="ui table" id="tblPackage">
			  <thead>
			    <tr>
			    	<th>Quantity</th>
				    <th>Item</th>
				    <th class="center aligned">Action</th>
			  	</tr>
			  </thead>
			  <tbody>
				@foreach($rentalPackage->items as $item)
					<tr>
						<td>{{$item->pivot->quantity}}</td>
						<td>{{$item->itemName}}</td>
						<td class="center aligned">
							<button class="ui blue button" onclick="$('#updateItem{{$item->itemCode}}').modal('show');"><i class="edit icon"></i> Update</button>
							<button class="ui red button" onclick="$('#deleteItem{{$item->itemCode}}').modal('show');"><i class="delete icon"></i> Remove</button>
						</td>
					</tr>
				@endforeach
			  </tbody>
			</table>
		</div>
	</div>


@if(count($rentalPackage->items) > 0)
@foreach($rentalPackage->items as $item)
	<div class="ui small modal" id="deleteItem{{$item->itemCode}}">
	  <div class="header">Remove Item</div>
	  <div class="content">
	    <p>Do you want to remove this item?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/rentalPackage/removeItem']) !!}
	  		{{ Form::hidden('rentalPackage_code', $rentalPackage->rentalPackageCode) }}
	  		{{ Form::hidden('item_code', $item->itemCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui small modal" id="updateItem{{$item->itemCode}}">
	  <div class="header">Update {{$item->itemName}}</div>
	  <div class="content">
	    {!! Form::open(['url' => '/rentalPackage/updateItem', 'id' => 'createForm', 'class' => 'ui form']) !!}
	  		{{ Form::hidden('rentalPackage_code', $rentalPackage->rentalPackageCode) }}
	  		{{ Form::hidden('item_code', $item->itemCode) }}
	  		<div class="ui form">
		  		<div class="required field">
	    			{{ Form::label('quantity', 'Quantity') }}
	     			{{ Form::text('quantity', $item->pivot->quantity, ['maxlength'=>'9', 'placeholder' => 'quantity', 'autofocus' => 'true']) }}
	    		</div>
	  		</div>
	  		<div class="ui error message"></div>
	  </div>
	  <div class="actions">
            {{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif
	<div class="ui modal" id="createItem">
	  <div class="header">New Package Item</div>
	  <div class="content">
	    {!! Form::open(['url' => '/rentalPackage/addItem', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		
          		{{ Form::hidden('rentalPackage_code', $rentalPackage->rentalPackageCode) }}
	    		<table id="tblItem" class="ui compact celled definition table" >
				  <thead class="full-width">
				    <tr>
				      <th></th>
				      <th>Item</th>
				      <th>Quantity</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($items as $item)
				  	<tr>
				      <td class="collapsing">
				        <div class="ui fitted checkbox">
							{{ Form::checkbox('rentalPackage_item[]', $item->itemCode, null, ['id'=>'rentalPackage_item', 'class' => 'item']) }}
							<label></label>
				        </div>
				      </td>
				      <td>{{$item->itemName}}</td>
				      <td>
				      {{ Form::text("quantity[$item->itemCode]", '', ['maxlength'=>'9', 'id'=>'quantity', 'placeholder' => 'Quantity', 'class' => 'textfield']) }}
				      </td>
				    </tr>
				  	@endforeach
				  </tbody>
				</table>
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

		quantity: {
      identifier : 'quantity',
      rules: [
      {
	        type   : "regExp[^[1-9][0-9]*$]",
			prompt : 'Please enter a valid quantity'
	      }

      ]
    },
		rentalPackage_item: {
      identifier : 'rentalPackage_item',
      rules: [
      {
        type   : 'checked',
        prompt : 'Please select a package item'
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

    var table = $('#tblPackage').DataTable();
    var tableItem = $('#tblItem').DataTable();
  });
</script>
@endsection