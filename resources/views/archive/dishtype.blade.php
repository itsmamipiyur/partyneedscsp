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
		<a href="{{ url('/dishType') }}" class="ui brown button"><i class="arrow circle left icon"></i>Back to Dish Type</a>
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
	<div class="ui modal" id="restore{{$dishtype->dishTypeCode}}">
	  <div class="header">Restore Dish Type</div>
	  <div class="content">
	    <p>Do you want to Restore this dish type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dishType/dishType_restore']) !!}
	  		{{ Form::hidden('dishtype_code', $dishtype->dishTypeCode) }}
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