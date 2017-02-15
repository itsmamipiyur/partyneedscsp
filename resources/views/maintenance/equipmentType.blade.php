@extends('layouts.admin')

@section('title')
	Equipment Type
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Equipment Type</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Equipment Type</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblEquiType">
		  <thead>
		    <tr>
			    <th>Equipment Type</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($equipmentTypes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($equipmentTypes as $equipmentType)
			  	<tr>
			      <td>{{$equipmentType->strEquiTypeName}}</td>
			      <td>{{$equipmentType->txtEquiTypeDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$equipmentType->strEquiTypeCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($equipmentType->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$equipmentType->strEquiTypeCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$equipmentType->strEquiTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($equipmentTypes) > 0)
@foreach($equipmentTypes as $equipmentType)
	<div class="ui modal" id="update{{$equipmentType->strEquiTypeCode}}">
	  <div class="header">Update Equipment Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/equipmentType/equipmentType_update']) !!}
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
	    		{{ Form::hidden('equipment_type_code', $equipmentType->strEquiTypeCode) }}
	    		<div class="required field">
	    			{{ Form::label('equipment_type_name', 'Equipment Type Name') }}
         			{{ Form::text('equipment_type_name', $equipmentType->strEquiTypeName, ['placeholder' => 'Type Equipment Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('equipment_type_description', 'Equipment Type Description') }}
          			{{ Form::textarea('equipment_type_description', $equipmentType->txtEquiTypeDesc, ['placeholder' => 'Type Equipment Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$equipmentType->strEquiTypeCode}}">
	  <div class="header">Deactivate Equipment Type</div>
	  <div class="content">
	    <p>Do you want to delete this Equipment type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/equipmentType/' . $equipmentType->strEquiTypeCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$equipmentType->strEquiTypeCode}}">
	  <div class="header">Restore Equipment Type</div>
	  <div class="content">
	    <p>Do you want to Restore this Equipment type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/equipmentType/equipementType_restore']) !!}
	  		{{ Form::hidden('equipment_type_code', $equipmentType->strEquiTypeCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Equipment Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/equipmentType']) !!}
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
	    			{{ Form::label('equipment_type_code', 'Equipment Type Code') }}
         			{{ Form::text('equipment_type_code', $newID, ['placeholder' => 'Type Equipment Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('equipment_type_name', 'Equipment Type Name') }}
         			{{ Form::text('equipment_type_name', '', ['placeholder' => 'Type Equipment Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('equipment_type_description', 'Equipment Type Description') }}
          			{{ Form::textarea('equipment_type_description', '', ['placeholder' => 'Type Equipment Type Description', 'rows' => '2']) }}
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
    $('#equipmentType').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tblEquiType').DataTable();
  });
</script>
@endsection