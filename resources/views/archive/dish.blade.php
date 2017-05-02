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
		<a href="{{ url('/dish') }}" class="ui brown button"><i class="arrow cicle left icon"></i>Back to Dish</a>
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