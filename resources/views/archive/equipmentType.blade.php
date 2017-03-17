@extends('layouts.admin')

@section('title')
	Equipment Type
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
		<h1>Equipment Type</h1>
		<hr>
	</div>

	<div class="row">
		<a href="{{url('/equipmentType')}}" class="ui brown button"><i class="add icon"></i>Back to Maintenance</a>
	</div>
	<div class="row">
		<table class="ui table" id="tblequipmenttype">
		  <thead>
		    <tr>
			    <th>Type</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($equipmentTypes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($equipmentTypes as $equipmentType)
			  	<tr>
			      <td>{{$equipmentType->equipmentTypeName}}</td>
			      <td>{{$equipmentType->equipmentTypeDesc}}</td>
			      <td class="center aligned">
					@if($equipmentType->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$equipmentType->equipmentTypeCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$equipmentType->equipmentTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($equipmentTypes) > 0)
@foreach($equipmentTypes as $equipmentType)
	
	<div class="ui modal" id="restore{{$equipmentType->equipmentTypeCode}}">
	  <div class="header">Restore</div>
	  <div class="content">
	    <p>Do you want to Restore this Equipment type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/equipmentType/equipmentType_restore']) !!}
	  		{{ Form::hidden('equipment_type_code', $equipmentType->equipmentTypeCode) }}
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
		equipment_type_name: {
		  identifier : 'equipment_type_name',
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









    $('#equipmentType').addClass("active grey");
    $('#item_content').addClass("active");
    $('#item').addClass("active");

    var table = $('#tblequipmenttype').DataTable();
  });
</script>
@endsection
