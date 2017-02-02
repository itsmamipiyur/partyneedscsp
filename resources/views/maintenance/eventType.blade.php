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
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>Add Event Type</button>
	</div>
	<div class="row">
		<table class="ui inverted table" id="tblEvenType">
		  <thead>
		    <tr>
			    <th>Event Type</th>
			    <th>Description</th>
			    <th>Created At</th>
			    <th>Updated At</th>
			    <th>Deleted At</th>
			    <th class="right aligned">Action</th>
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
			      <td>{{$eventType->strEvenTypeName}}</td>
			      <td>{{$eventType->txtEvenTypeDesc}}</td>
			      <td>{{$eventType->created_at}}</td>
			      <td>{{$eventType->updated_at}}</td>
			      <td>{{$eventType->deleted_at}}</td>
			      <td class="right aligned">
					<button class="ui inverted blue button" onclick="$('#update{{$eventType->strEvenTypeCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($eventType->deleted_at == null)
			      	<button class="ui inverted red button" onclick="$('#delete{{$eventType->strEvenTypeCode}}').modal('show');"><i class="delete icon"></i> Delete</button>
			      	@else
			      	<button class="ui inverted orange button" onclick="$('#restore{{$eventType->strEvenTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
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
	<div class="ui modal" id="update{{$eventType->strEvenTypeCode}}">
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
	    		{{ Form::hidden('event_type_code', $eventType->strEvenTypeCode) }}
	    		<div class="required field">
	    			{{ Form::label('event_type_name', 'Event Type Name') }}
         			{{ Form::text('event_type_name', $eventType->strEvenTypeName, ['placeholder' => 'Type Event Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('event_type_description', 'Event Type Description') }}
          			{{ Form::textarea('event_type_description', $eventType->txtEvenTypeDesc, ['placeholder' => 'Type Event Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$eventType->strEvenTypeCode}}">
	  <div class="header">Delete Event Type</div>
	  <div class="content">
	    <p>Do you want to delete this event type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/eventType/' . $eventType->strEvenTypeCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$eventType->strEvenTypeCode}}">
	  <div class="header">Restore Event Type</div>
	  <div class="content">
	    <p>Do you want to Restore this event type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/eventType/eventType_restore']) !!}
	  		{{ Form::hidden('event_type_code', $eventType->strEvenTypeCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">Add Event Type</div>
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

	    		<div class="required field">
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
    $('#event_content').addClass("active");
    $('#event').addClass("active");

    var table = $('#tblEvenType').DataTable();
  });
</script>
@endsection