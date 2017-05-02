@extends('layouts.admin')

@section('title')
	Event Type
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
		<h1>Event Type</h1>
		<hr>
	</div>

	<div class="row">
		<a href="{{ url('/eventType') }}" class="ui brown button"><i class="arrow circle left icon"></i>Back to Event Type</a>
	</div>
	<div class="row">
		<table class="ui table" id="tbleventtype">
		  <thead>
		    <tr>
			    <th>Event Type</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($eventTypes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($eventTypes as $eventType)
			  	<tr>
			      <td>{{$eventType->eventTypeName}}</td>
			      <td>{{$eventType->eventTypeDesc}}</td>
			      <td class="center aligned">
					@if($eventType->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$eventType->eventTypeCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$eventType->eventTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($eventTypes) > 0)
@foreach($eventTypes as $eventType)
	<div class="ui modal" id="restore{{$eventType->eventTypeCode}}">
	  <div class="header">Restore Event Type</div>
	  <div class="content">
	    <p>Do you want to Restore this event type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/eventType/eventType_restore']) !!}
	  		{{ Form::hidden('event_type_code', $eventType->eventTypeCode) }}
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
		event_type_name: {
		  identifier : 'event_type_name',
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



    $('#eventType').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tbleventtype').DataTable();
  });
</script>
@endsection
