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
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Equipment Type</button>
		<a href="{{ url('/archive/equipmentType') }}" class="ui teal button"><i class="archive icon"></i>Archive</a>
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
					<button class="ui blue button" onclick="$('#update{{$equipmentType->equipmentTypeCode}}').modal('show');"><i class="edit icon"></i> Update</button>
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
	<div class="ui modal" id="update{{$equipmentType->equipmentTypeCode}}">
	  <div class="header">Update Equipment Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/equipmentType/equipmentType_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">

	    		{{ Form::hidden('equipment_type_code', $equipmentType->equipmentTypeCode) }}
	    		<div class="required field">
	    			{{ Form::label('equipment_type_name', 'Name') }}
         			{{ Form::text('equipment_type_name', $equipmentType->equipmentTypeName, ['maxlength'=>'25', 'placeholder' => 'Type Equipment Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('equipment_type_description', 'Description') }}
          			{{ Form::textarea('equipment_type_description', $equipmentType->equipmentTypeDesc, ['maxlength'=>'200', 'placeholder' => 'Type Equipment Type Description', 'rows' => '2']) }}
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

	<div class="ui modal" id="delete{{$equipmentType->equipmentTypeCode}}">
	  <div class="header">Deactivate</div>
	  <div class="content">
	    <p>Do you want to deactivate this Equipment type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/equipmentType/' . $equipmentType->equipmentTypeCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$equipmentType->equipmentTypeCode}}">
	  <div class="header">Restore</div>
	  <div class="content">
	    <p>Do you want to Restore this Equipment type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/equipmentType/equipementType_restore']) !!}
	  		{{ Form::hidden('equipment_type_code', $equipmentType->equipmentTypeCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Equipment Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/equipmentType', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		

	    		<div class="disabled field">
	    	
         			{{ Form::hidden('equipment_type_code', $newID, ['placeholder' => 'Type Equipment Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('equipment_type_name', 'Name') }}
         			{{ Form::text('equipment_type_name', '', ['maxlength'=>'25', 'placeholder' => 'Type Equipment Type Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('equipment_type_description', 'Description') }}
          			{{ Form::textarea('equipment_type_description', '', ['maxlength'=>'200', 'placeholder' => 'Type Equipment Type Description', 'rows' => '2']) }}
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
