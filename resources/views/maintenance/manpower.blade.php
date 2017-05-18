@extends('layouts.admin')

@section('title')
	Manpower
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
		<h1>Manpower</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');" style="background-color: rgb(0,128,0);"><i class="add icon"></i>New Manpower</button>
		<a href="{{ url('/archive/manpower') }}" class="ui teal button" style="background-color: rgb(0,128,128);"><i class="archive icon"></i>Archive</a>
	</div>
	<div class="row">
		<table class="ui table" id="tblmanpower">
		  <thead>
		    <tr>
			    <th>Position</th>
			    <th>Description</th>
			    <th>Rate</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($manpowers) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($manpowers as $manpower)
			  	<tr>
			      <td>{{$manpower->manpowerPosition}}</td>
			      <td>{{$manpower->manpowerDesc}}</td>
			      <td>Php {{$manpower->manpowerRate}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$manpower->manpowerCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($manpower->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$manpower->manpowerCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$manpower->manpowerCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($manpowers) > 0)
@foreach($manpowers as $manpower)
	<div class="ui modal" id="update{{$manpower->manpowerCode}}">
	  <div class="header">Update Manpower</div>
	  <div class="content">
	    {!! Form::open(['url' => '/manpower/manpower_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		<div class="ui error message"></div>
	    		{{ Form::hidden('manpower_code', $manpower->manpowerCode) }}
	    		<div class="required field">
	    			{{ Form::label('manpower_position', 'Manpower Position') }}
         			{{ Form::text('manpower_position', $manpower->manpowerPosition, ['maxlength'=>'25', 'placeholder' => 'Type Manpower Position']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('manpower_description', 'Manpower Description') }}
          			{{ Form::textarea('manpower_description', $manpower->manpowerDesc, ['maxlength'=>'200', 'placeholder' => 'Type Manpower Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('manpower_rate', 'Manpower Rate') }}
          			{{ Form::text('manpower_rate', $manpower->manpowerRate, ['maxlength'=>'25', 'placeholder' => 'Type Manpower Rate']) }}
	    		</div>
	    	</div>
	    	
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$manpower->manpowerCode}}">
	  <div class="header">Deactivate Manpower</div>
	  <div class="content">
	    <p>Do you want to delete this event type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/manpower/' . $manpower->manpowerCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$manpower->manpowerCode}}">
	  <div class="header">Restore Manpower</div>
	  <div class="content">
	    <p>Do you want to Restore this event type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/manpower/manpower_restore']) !!}
	  		{{ Form::hidden('manpower_code', $manpower->manpowerCode) }}
            {{ Form::button('Yes', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Manpower</div>
	  <div class="content">
	    {!! Form::open(['url' => '/manpower', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		<div class="ui error message"></div>
	    		<div class="disabled field">
         			{{ Form::hidden('manpower_code', $newID, ['placeholder' => 'Type Manpower Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('manpower_position', 'Manpower Position') }}
         			{{ Form::text('manpower_position', '', ['maxlength'=>'25','placeholder' => 'Type Manpower Position', 'autofocus'=>'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('manpower_description', 'Manpower Description') }}
          			{{ Form::textarea('manpower_description', '', ['maxlength'=>'200','placeholder' => 'Type Manpower Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('manpower_rate', 'Manpower Rate') }}
          			{{ Form::text('manpower_rate', '', ['maxlength'=>'25', 'placeholder' => 'Type Manpower Rate']) }}
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
		manpower_position: {
		  identifier : 'manpower_position',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter a position'
			},
			{
	        

	           type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

	        	
	           
				prompt: "Position can only consist of alphanumeric, spaces, apostrophe and dashes"
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



    $('#manpower').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblmanpower').DataTable();
  });
</script>
@endsection
