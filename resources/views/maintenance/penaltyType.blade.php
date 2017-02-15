@extends('layouts.admin')

@section('title')
	Penalty Type
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Penalty Type</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Penalty Type</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblPenaType">
		  <thead>
		    <tr>
			    <th>Penalty Type</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($penaltyTypes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($penaltyTypes as $penaltyType)
			  	<tr>
			      <td>{{$penaltyType->strPenaTypeName}}</td>
			      <td>{{$penaltyType->txtPenaTypeDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$penaltyType->strPenaTypeCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($penaltyType->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$penaltyType->strPenaTypeCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$penaltyType->strPenaTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($penaltyTypes) > 0)
@foreach($penaltyTypes as $penaltyType)
	<div class="ui modal" id="update{{$penaltyType->strPenaTypeCode}}">
	  <div class="header">Update Penalty Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/penaltyType/penaltyType_update']) !!}
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
	    		{{ Form::hidden('penalty_type_code', $penaltyType->strPenaTypeCode) }}
	    		<div class="required field">
	    			{{ Form::label('penalty_type_name', 'Penalty Type Name') }}
         			{{ Form::text('penalty_type_name', $penaltyType->strPenaTypeName, ['placeholder' => 'Type Penalty Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('penalty_type_description', 'Penalty Type Description') }}
          			{{ Form::textarea('penalty_type_description', $penaltyType->txtPenaTypeDesc, ['placeholder' => 'Type Penalty Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$penaltyType->strPenaTypeCode}}">
	  <div class="header">Deactivate Penalty Type</div>
	  <div class="content">
	    <p>Do you want to delete this penalty type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/penaltyType/' . $penaltyType->strPenaTypeCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$penaltyType->strPenaTypeCode}}">
	  <div class="header">Restore Penalty Type</div>
	  <div class="content">
	    <p>Do you want to Restore this penalty type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/penaltyType/penaltyType_restore']) !!}
	  		{{ Form::hidden('penalty_type_code', $penaltyType->strPenaTypeCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Penalty Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/penaltyType']) !!}
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
	    			{{ Form::label('penalty_type_code', 'Penalty Type Code') }}
         			{{ Form::text('penalty_type_code', $newID, ['placeholder' => 'Type Penalty Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('penalty_type_name', 'Penalty Type Name') }}
         			{{ Form::text('penalty_type_name', '', ['placeholder' => 'Type Penalty Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('penalty_type_description', 'Penalty Type Description') }}
          			{{ Form::textarea('penalty_type_description', '', ['placeholder' => 'Type Penalty Type Description', 'rows' => '2']) }}
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
    $('#penaltyType').addClass("active grey");
    $('#fees_content').addClass("active");
    $('#fees').addClass("active");

    var table = $('#tblPenaType').DataTable();
  });
</script>
@endsection