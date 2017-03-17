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
		<a href="{{url('/item')}}" class="ui brown button"><i class="archive icon"></i>Back to Maintenance</a>
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
        

            type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

	        	
	           
				prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
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
        

           type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

	        	
	           
				prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
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
        

           type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

	        	
	           
				prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
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
        

           type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

	        	
	           
				prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
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
        
type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

	        	
	           
				prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
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
