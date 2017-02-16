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

	<div class="row">
		<h1>Event Type</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Event Type</button>
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
					<button class="ui blue button" onclick="$('#update{{$eventType->eventTypeCode}}').modal('show');"><i class="edit icon"></i> Update</button>
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
	<div class="ui modal" id="update{{$eventType->eventTypeCode}}">
	  <div class="header">Update Event Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/eventType/eventType_update']) !!}
	    	<div class="ui form">
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
	    		{{ Form::hidden('event_type_code', $eventType->eventTypeCode) }}
	    		<div class="required field">
	    			{{ Form::label('event_type_name', 'Event Type Name') }}
         			{{ Form::text('event_type_name', $eventType->eventTypeName, ['placeholder' => 'Type Event Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('event_type_description', 'Event Type Description') }}
          			{{ Form::textarea('event_type_description', $eventType->eventTypeDesc, ['placeholder' => 'Type Event Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$eventType->eventTypeCode}}">
	  <div class="header">Deactivate Event Type</div>
	  <div class="content">
	    <p>Do you want to delete this event type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/eventType/' . $eventType->eventTypeCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

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

	<div class="ui modal" id="create">
	  <div class="header">New Event Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/eventType']) !!}
	    	<div class="ui form">
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

	    		<div class="disabled field">
	    			{{ Form::label('event_type_code', 'Event Type Code') }}
         			{{ Form::text('event_type_code', $newID, ['placeholder' => 'Type Event Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('event_type_name', 'Event Type Name') }}
         			{{ Form::text('event_type_name', '', ['placeholder' => 'Type Event Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('event_type_description', 'Event Type Description') }}
          			{{ Form::textarea('event_type_description', '', ['placeholder' => 'Type Event Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
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
    $('#eventType').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tbleventtype').DataTable();
  });
</script>
@endsection
