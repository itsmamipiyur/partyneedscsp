@extends('layouts.admin')

@section('title')
	Item
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
		<h1>Item</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Item</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblitem">
		  <thead>
		    <tr>
			    <th>Name</th>
			    <th>Item Type</th>
			    <th>Subtype</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($items) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($items as $item)
			  	<tr>
			      <td>{{$item->itemName}}</td>
			      @if($item->itemType == '1')
			      		<td>Dinnerware</td>
			      @elseif($item->itemType == '2')
			      		<td>Equipment</td>
			      @endif
			      @if($item->itemType == '1')
			      		<td>{{$item->itemDinnerware->dinnerwareType->dinnerwareTypeName}}</td>
			      @elseif($item->itemType == '2')
			      		<td>{{$item->itemEquipment->equipmentType->equipmentTypeName}}</td>
			      @endif
			      <td class="center aligned">
			      	<a href="{{url('/item/'. $item->itemCode)}}" class="ui teal button">Item Detail</a>
					<button class="ui blue button" onclick="show('{{$item->itemType}}'); $('#update{{$item->itemCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($item->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$item->itemCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$item->itemCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($items) > 0)
@foreach($items as $item)
	<div class="ui modal" id="update{{$item->itemCode}}">
	  <div class="header">Update Item</div>
	  <div class="content">
	    {!! Form::open(['url' => '/item/item_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		
	    		{{ Form::hidden('item_code', $item->itemCode) }}
	    		<div class="required field">
	    			{{ Form::label('item_name', 'Item Name') }}
         			{{ Form::text('item_name', $item->itemName, ['maxlength'=>'25', 'placeholder' => 'Type Item Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('item_description', 'Item Description') }}
          			{{ Form::textarea('item_description', $item->itemDesc, ['maxlength'=>'200', 'placeholder' => 'Type Item Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('uom_code', 'Unit of Measurement') }}
         			{{ Form::select('uom_code', $uoms, $item->uomCode, ['placeholder' => 'Choose Unit of Measurement', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_type', 'Item Type') }}
         			{{ Form::select('item_type', $itemTypes, $item->itemType, ['id' => 'itemTypeu', 'placeholder' => 'Choose Item Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" id="divDinnType" style="display: none;">
	    			{{ Form::label('dinnerware_type', 'SubType') }}
	    		@if($item->itemType == '1')
         			{{ Form::select('dinnerware_type', $dinnTypes, $item->itemDinnerware->dinnerwareTypeCode, ['placeholder' => 'Choose Dinnerware Type', 'class' => 'ui search dropdown']) }}
	    		@else
	    			{{ Form::select('dinnerware_type', $dinnTypes, null, ['placeholder' => 'Choose Dinnerware Type', 'class' => 'ui search dropdown']) }}
	    		@endif 
	    		</div>
	    		<div class="required field" id="divEquiType" style="display: none;">
	    			{{ Form::label('equipment_type', 'SubType') }}
	    		@if($item->itemType == '2')
         			{{ Form::select('equipment_type', $equiTypes, $item->itemEquipment->equipmentTypeCode, ['placeholder' => 'Choose Equipment Type', 'class' => 'ui search dropdown']) }}
         		@else
         			{{ Form::select('equipment_type', $equiTypes, null, ['placeholder' => 'Choose Equipment Type', 'class' => 'ui search dropdown']) }}	
	    		@endif
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

	<div class="ui modal" id="delete{{$item->itemCode}}">
	  <div class="header">Deactivate Item</div>
	  <div class="content">
	    <p>Do you want to deactivate this Item?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/item/' . $item->itemCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$item->itemCode}}">
	  <div class="header">Restore Item</div>
	  <div class="content">
	    <p>Do you want to Restore this Item?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/item/item_restore']) !!}
	  		{{ Form::hidden('item_code', $item->itemCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Item</div>
	  <div class="content">
	    {!! Form::open(['url' => '/item', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		
	    		<div class="disabled field">
	    			<!-- {{ Form::label('item_code', 'Code') }} -->
         			{{ Form::hidden('item_code', $newID, ['placeholder' => 'Type Item Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_name', 'Name') }}
         			{{ Form::text('item_name', '', ['maxlength'=>'25', 'placeholder' => 'Type Item Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('item_description', 'Description') }}
          			{{ Form::textarea('item_description', '', ['maxlength'=>'200', 'placeholder' => 'Type Item Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('uom_code', 'Unit of Measurement') }}
         			{{ Form::select('uom_code', $uoms, null, ['placeholder' => 'Choose Unit of Measurement', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_type', 'Item Type') }}
         			{{ Form::select('item_type', $itemTypes, null, ['id' => 'itemTypes', 'placeholder' => 'Choose Item Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" id="divEquiTypes" style="display: none;">
	    			{{ Form::label('equipment_type', 'SubType') }}
         			{{ Form::select('equipment_type', $equiTypes, null, ['placeholder' => 'Choose Equipment Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" id="divDinnTypes" style="display: none;">
	    			{{ Form::label('dinnerware_type', 'SubType') }}
         			{{ Form::select('dinnerware_type', $dinnTypes, null, ['placeholder' => 'Choose Dinnerware Type', 'class' => 'ui search dropdown']) }}
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
		item_name: {
		  identifier : 'item_name',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter a name'
			},
			{
        

            type   : "regExp[^[a-zA-Z -'-]+$]",
            // type   : 'regExp[^[a-zA-Z0-9_-]*[a-zA-Z]+[a-zA-Z0-9]*$]',

        	
           
			prompt: "Name can only consist of letters, spaces, apostrophe and dashes"
        	}
		  ]
		},
		
		uom_code: {
        identifier: 'uom_code',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an uom type'
          }
        ]
      },
		item_type: {
        identifier: 'item_type',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an item type'
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


  	 






    $('#item').addClass("active grey");
    $('#Item_content').addClass("active");
    $('#Item').addClass("active");

    var table = $('#tblitem').DataTable();

    $('#itemTypes').on("change", function(){
    	var val = $( "select#itemTypes" ).val();
    	

//dinnerware_type
    	if(val == '1'){
    		document.getElementById('divDinnTypes').style.display = "block";
    		document.getElementById('divEquiTypes').style.display = "none";
    		alert('Hey');
    		var formValidationRules =
			{

			item_name: {
		  identifier : 'item_name',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter a name'
			},
			{
        

           type   : "regExp[^[a-zA-Z -'-]+$]",
            // type   : 'regExp[^[a-zA-Z0-9_-]*[a-zA-Z]+[a-zA-Z0-9]*$]',

        	
           
			prompt: "Name can only consist of letters, spaces, apostrophe and dashes"
        	}
		  ]
		},
		
		uom_code: {
        identifier: 'uom_code',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an uom type'
          }
        ]
      },
		item_type: {
        identifier: 'item_type',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an item type'
          }
        ]
      },



    		dinnerware_type: {
		        identifier: 'dinnerware_type',
		        rules: [
		          {
		            type   : 'empty',
		            prompt : 'Please select an dinnerware type'
		          }
		        ]
		      }
		  }
		      $('.ui.form').form(formValidationRules);




    	}else if(val == '2'){
    		document.getElementById('divDinnTypes').style.display = "none";
    		document.getElementById('divEquiTypes').style.display = "block";

    		alert('Hoy');
    		var formValidationRules =
			{

			item_name: {
		  identifier : 'item_name',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter a name'
			},
			{
        

           type   : "regExp[^[a-zA-Z -'-]+$]",
            // type   : 'regExp[^[a-zA-Z0-9_-]*[a-zA-Z]+[a-zA-Z0-9]*$]',

        	
           
			prompt: "Name can only consist of letters, spaces, apostrophe and dashes"
        	}
		  ]
		},
		
		uom_code: {
        identifier: 'uom_code',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an uom type'
          }
        ]
      },
		item_type: {
        identifier: 'item_type',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an item type'
          }
        ]
      },



    		dinnerware_type: {
		        identifier: 'equipment_type',
		        rules: [
		          {
		            type   : 'empty',
		            prompt : 'Please select an equipment type'
		          }
		        ]
		      }
		  }
		      $('.ui.form').form(formValidationRules);
    	}else{
    		document.getElementById('divDinnTypes').style.display = "none";
    		document.getElementById('divEquiTypes').style.display = "none";
    	}
    });



//update modal
    $('#itemTypeu').on("change", function(){
    	var val = $( "select#itemTypeu" ).val();

//dinnerware type
    	if(val == '1'){
    		document.getElementById('divDinnType').style.display = "block";
    		document.getElementById('divEquiType').style.display = "none";

    		alert('Hey');
    		var formValidationRules =
			{

			item_name: {
		  identifier : 'item_name',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter a name'
			},
			{
        

           type   : "regExp[^[a-zA-Z -'-]+$]",
            // type   : 'regExp[^[a-zA-Z0-9_-]*[a-zA-Z]+[a-zA-Z0-9]*$]',

        	
           
			prompt: "Name can only consist of letters, spaces, apostrophe and dashes"
        	}
		  ]
		},
		
		uom_code: {
        identifier: 'uom_code',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an uom type'
          }
        ]
      },
		item_type: {
        identifier: 'item_type',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an item type'
          }
        ]
      },



    		dinnerware_type: {
		        identifier: 'dinnerware_type',
		        rules: [
		          {
		            type   : 'empty',
		            prompt : 'Please select an dinnerware type'
		          }
		        ]
		      }
		  }
		      $('.ui.form').form(formValidationRules);



//equipment type
    	}else if(val == '2'){
    		document.getElementById('divDinnType').style.display = "none";
    		document.getElementById('divEquiType').style.display = "block";

    		alert('Hoy');
    		var formValidationRules =
			{

			item_name: {
		  identifier : 'item_name',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter a name'
			},
			{
        

           type   : "regExp[^[a-zA-Z -'-]+$]",
            // type   : 'regExp[^[a-zA-Z0-9_-]*[a-zA-Z]+[a-zA-Z0-9]*$]',

        	
           
			prompt: "Name can only consist of letters, spaces, apostrophe and dashes"
        	}
		  ]
		},
		
		uom_code: {
        identifier: 'uom_code',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an uom type'
          }
        ]
      },
		item_type: {
        identifier: 'item_type',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an item type'
          }
        ]
      },



    		dinnerware_type: {
		        identifier: 'equipment_type',
		        rules: [
		          {
		            type   : 'empty',
		            prompt : 'Please select an equipment type'
		          }
		        ]
		      }
		  }
		      $('.ui.form').form(formValidationRules);

    	}else{
    		document.getElementById('divDinnType').style.display = "none";
    		document.getElementById('divEquiType').style.display = "none";
    		alert('a');
    	}
    });
  });

  function show(itemType){

//dinneware type
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
