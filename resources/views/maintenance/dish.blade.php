@extends('layouts.admin')

@section('title')
	Dish
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
		<h1>Dish</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Dish</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblDish">
		  <thead>
		    <tr>
			    <th>Name</th>
			    <th>Description</th>
			    <th>Type</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($dishes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($dishes as $dish)
			  	<tr>
			      <td>{{$dish->dishName}}</td>
			      <td>{{$dish->dishDesc}}</td>
			      <td>{{$dish->dishType->dishTypeName}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$dish->dishCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($dish->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$dish->dishCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$dish->dishCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($dishes) > 0)
@foreach($dishes as $dish)
	<div class="ui modal" id="update{{$dish->dishCode}}">
	  <div class="header">Update Dish</div>
	  <div class="content">
	     {!! Form::open(['url' => '/dish/dish_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		
	    		{{ Form::hidden('dish_code', $dish->dishCode) }}
	    		<div class="required field">
	    			{{ Form::label('dish_name', 'Name') }}
         			{{ Form::text('dish_name', $dish->dishName, ['maxlength'=>'25', 'placeholder' => 'Type Dish Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('dish_description', 'Description') }}
          			{{ Form::textarea('dish_description', $dish->dishDesc, ['maxlength'=>'200', 'placeholder' => 'Type Dish Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('dish_type', 'Type') }}
         			{{ Form::select('dish_type', $dishTypes, $dish->dishTypeCode, ['placeholder' => 'Choose Dish Type', 'class' => 'ui search dropdown']) }}
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

	<div class="ui modal" id="delete{{$dish->dishCode}}">
	  <div class="header">Deactivate Dish</div>
	  <div class="content">
	    <p>Do you want to deactivate this dish?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dish/' . $dish->dishCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$dish->dishCode}}">
	  <div class="header">Restore Dish</div>
	  <div class="content">
	    <p>Do you want to Restore this dish?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dish/dish_restore']) !!}
	  		{{ Form::hidden('dish_code', $dish->dishCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Dish</div>
	  <div class="content">
	     {!! Form::open(['url' => '/dish', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		

	    		<div class="disabled field">
	    			
         			{{ Form::hidden('dish_code', $newID, ['placeholder' => 'Type Dish Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('dish_name', 'Name') }}
         			{{ Form::text('dish_name', '', ['maxlength'=>'25', 'placeholder' => 'Type Dish Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('dish_description', 'Description') }}
          			{{ Form::textarea('dish_description', '', ['maxlength'=>'200', 'placeholder' => 'Type Dish Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('dish_type', 'Type') }}
         			{{ Form::select('dish_type', $dishTypes, null, ['placeholder' => 'Choose Dish Type', 'class' => 'ui search dropdown']) }}
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
		dish_name: {
		  identifier : 'dish_name',
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
		dish_type: {
        identifier: 'dish_type',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select a dish type'
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



    $('#dish').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tblDish').DataTable();
  });
</script>
@endsection