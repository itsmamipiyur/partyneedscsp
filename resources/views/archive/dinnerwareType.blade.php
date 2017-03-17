@extends('layouts.admin')

@section('title')
	Dinnerware Type
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
		<h1>Archive: Dinnerware Type</h1>
		<hr>
	</div>

	<div class="row">
		<a href="{{ url('/dinnerwareType') }}" class="ui teal button"><i class="archive icon"></i>Back to Maintenance</a>
	</div>
	<div class="row">
		<table class="ui table" id="tbldinnerwaretype">
		  <thead>
		    <tr>
			    <th>Name</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($dinnerwareTypes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($dinnerwareTypes as $dinnerwareType)
			  	<tr>
			      <td>{{$dinnerwareType->dinnerwareTypeName}}</td>
			      <td>{{$dinnerwareType->dinnerwareTypeDesc}}</td>
			      <td class="center aligned">
					@if($dinnerwareType->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$dinnerwareType->dinnerwareTypeCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$dinnerwareType->dinnerwareTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($dinnerwareTypes) > 0)
@foreach($dinnerwareTypes as $dinnerwareType)

	<div class="ui modal" id="restore{{$dinnerwareType->dinnerwareTypeCode}}">
	  <div class="header">Restore</div>
	  <div class="content">
	    <p>Do you want to Restore this Dinnerware type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dinnerwareType/dinnerwareType_restore']) !!}
	  		{{ Form::hidden('dinnerware_type_code', $dinnerwareType->dinnerwareTypeCode) }}
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
		dinnerware_type_name: {
		  identifier : 'dinnerware_type_name',
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






    $('#dinnerwareType').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tbldinnerwaretype').DataTable();
  });
</script>
@endsection
