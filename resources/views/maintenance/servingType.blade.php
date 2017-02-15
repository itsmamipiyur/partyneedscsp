@extends('layouts.admin')

@section('title')
	Serving Type
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Serving Type</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Serving Type</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblServType">
		  <thead>
		    <tr>
			    <th>Serving Type</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($servingTypes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($servingTypes as $servingType)
			  	<tr>
			      <td>{{$servingType->strServTypeName}}</td>
			      <td>{{$servingType->txtServTypeDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$servingType->strServTypeCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($servingType->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$servingType->strServTypeCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$servingType->strServTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($servingTypes) > 0)
@foreach($servingTypes as $servingType)
	<div class="ui modal" id="update{{$servingType->strServTypeCode}}">
	  <div class="header">Update Serving Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/servingType/servingType_update']) !!}
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
	    		{{ Form::hidden('serving_type_code', $servingType->strServTypeCode) }}
	    		<div class="required field">
	    			{{ Form::label('serving_type_name', 'Serving Type Name') }}
         			{{ Form::text('serving_type_name', $servingType->strServTypeName, ['placeholder' => 'Type Serving Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('serving_type_description', 'Serving Type Description') }}
          			{{ Form::textarea('serving_type_description', $servingType->txtServTypeDesc, ['placeholder' => 'Type Serving Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$servingType->strServTypeCode}}">
	  <div class="header">Deactivate Serving Type</div>
	  <div class="content">
	    <p>Do you want to delete this serving type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/servingType/' . $servingType->strServTypeCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$servingType->strServTypeCode}}">
	  <div class="header">Restore Serving Type</div>
	  <div class="content">
	    <p>Do you want to Restore this serving type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/servingType/servingType_restore']) !!}
	  		{{ Form::hidden('serving_type_code', $servingType->strServTypeCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Serving Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/servingType']) !!}
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
	    			{{ Form::label('serving_type_code', 'Serving Type Code') }}
         			{{ Form::text('serving_type_code', $newID, ['placeholder' => 'Type Serving Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('serving_type_name', 'Serving Type Name') }}
         			{{ Form::text('serving_type_name', '', ['placeholder' => 'Type Serving Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('serving_type_description', 'Serving Type Description') }}
          			{{ Form::textarea('serving_type_description', '', ['placeholder' => 'Type Serving Type Description', 'rows' => '2']) }}
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
    $('#servingType').addClass("active grey");
    $('#serving_content').addClass("active");
    $('#serving').addClass("active");

    var table = $('#tblServType').DataTable();
  });
</script>
@endsection