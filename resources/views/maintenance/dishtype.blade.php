@extends('layouts.admin')

@section('title')
	Dish Type
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
		<h1>Dish Type</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');" style="background-color: rgb(0,128,0);"><i class="add icon"></i>New Dish Type</button>
		<a href="{{ url('/archive/dishType') }}" class="ui teal button" style="background-color: rgb(0,128,128);"><i class="archive icon"></i>Archive</a>
	</div>
	<div class="row">
		<table class="ui table" id="tblDishType">
		  <thead>
		    <tr>
			    <th>Name</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($dishtypes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($dishtypes as $dishtype)
			  	<tr>
			      <td>{{$dishtype->dishTypeName}}</td>
			      <td>{{$dishtype->dishTypeDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$dishtype->dishTypeCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($dishtype->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$dishtype->dishTypeCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$dishtype->dishTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($dishtypes) > 0)
@foreach($dishtypes as $dishtype)
	<div class="ui modal" id="update{{$dishtype->dishTypeCode}}">
	  <div class="header">Update Dish Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/dishType/dishType_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		<div class="ui error message"></div>
	    		{{ Form::hidden('dishtype_code', $dishtype->dishTypeCode) }}
	    		<div class="required field">
	    			{{ Form::label('dishtype_name', 'Name') }}
         			{{ Form::text('dishtype_name', $dishtype->dishTypeName, ['maxlength'=>'25', 'placeholder' => 'Type Dish Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('dishtype_description', 'Description') }}
          			{{ Form::textarea('dishtype_description', $dishtype->dishTypeDesc, ['maxlength'=>'200', 'placeholder' => 'Type Dish Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
	    	
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$dishtype->dishTypeCode}}">
	  <div class="header">Deactivate Dish Type</div>
	  <div class="content">
	    <p>Do you want to deactivate this dish type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dishType/' . $dishtype->dishTypeCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$dishtype->dishTypeCode}}">
	  <div class="header">Restore Dish Type</div>
	  <div class="content">
	    <p>Do you want to Restore this dish type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dishtype/dishtype_restore']) !!}
	  		{{ Form::hidden('dishtype_code', $dishtype->dishTypeCode) }}
            {{ Form::button('Yes', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Dish Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/dishType', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		<div class="ui error message"></div>

	    		<div class="disabled field">
         			{{ Form::hidden('dishtype_code', $newID, ['placeholder' => 'Type Dish Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('dishtype_name', 'Name') }}
         			{{ Form::text('dishtype_name', '', ['maxlength'=>'25', 'placeholder' => 'Type Dish Type Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('dishtype_description', 'Description') }}
          			{{ Form::textarea('dishtype_description', '', ['maxlength'=>'200', 'placeholder' => 'Type Dish Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
	    	
        </div>
	  <div class="actions">
            {{ Form::button('Submit', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
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
		dishtype_name: {

		  identifier : 'dishtype_name',
		  
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








    $('#dishtype').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tblDishType').DataTable();
  });
</script>
@endsection