@extends('layouts.admin')

@section('title')
	Decor
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
		<h1>Decor</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Decor</button>
		<a href="{{ url('/archive/decor') }}" class="ui teal button"><i class="archive icon"></i>Archive</a>
	</div>
	<div class="row">
		<table class="ui table" id="tbldecor">
		  <thead>
		    <tr>
			    <th>Name</th>
			    <th>Description</th>
			    <th>Type</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($decors) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($decors as $decor)
			  	<tr>
			      <td>{{$decor->decorName}}</td>
			      <td>{{$decor->decorDesc}}</td>
			      @if($decor->decorType == '1')
			      <td>Color Motif</td>
			      @elseif($decor->decorType == '2')
			      <td>Theme</td>
			      @endif
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$decor->decorCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($decor->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$decor->decorCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$decor->decorCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($decors) > 0)
@foreach($decors as $decor)
	<div class="ui modal" id="update{{$decor->decorCode}}">
	  <div class="header">Update Decor</div>
	  <div class="content">
	     {!! Form::open(['url' => '/decor/decor_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		<div class="ui error message"></div>
	    		{{ Form::hidden('decor_code', $decor->decorCode) }}
	    		<div class="required field">
	    			{{ Form::label('decor_name', 'Decor Name') }}
         			{{ Form::text('decor_name', $decor->decorName, ['maxlength'=>'25','placeholder' => 'Type Decor Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('decor_description', 'Decor Description') }}
          			{{ Form::textarea('decor_description', $decor->decorDesc, ['maxlength'=>'200', 'placeholder' => 'Type Decor Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('decor_type', 'Decor Type') }}
         			{{ Form::select('decor_type', $decorTypes, $decor->decorType, ['placeholder' => 'Choose Decor Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    	</div>
	    	
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$decor->decorCode}}">
	  <div class="header">Deactivate Decor</div>
	  <div class="content">
	    <p>Do you want to deactivate this decor?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/decor/' . $decor->decorCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$decor->decorCode}}">
	  <div class="header">Restore Decor</div>
	  <div class="content">
	    <p>Do you want to Restore this decor?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/decor/decor_restore']) !!}
	  		{{ Form::hidden('decor_code', $decor->decorCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Decor</div>
	  <div class="content">
	    {!! Form::open(['url' => '/decor', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		<div class="ui error message"></div>

	    		<div class="disabled field">
	    			
         			{{ Form::hidden('decor_code', $newID, ['placeholder' => 'Type Decor Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('decor_name', 'Name') }}
         			{{ Form::text('decor_name', '', ['maxlength'=>'25', 'placeholder' => 'Type Decor Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('decor_description', 'Description') }}
          			{{ Form::textarea('decor_description', '', ['maxlength'=>'25', 'placeholder' => 'Type Decor Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('decor_type', 'Type') }}
         			{{ Form::select('decor_type', $decorTypes, null, ['placeholder' => 'Choose Decor Type', 'class' => 'ui search dropdown']) }}
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
		decor_name: {
		  identifier : 'decor_name',
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
		decor_type: {
        identifier: 'decor_type',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select motif type'
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




    $('#decor').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tbldecor').DataTable();
  });
</script>
@endsection
