@extends('layouts.admin')

@section('title')
	Equipment
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Equipment</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>Add Equipment</button>
	</div>
	<div class="row">
		<table class="ui inverted table" id="tblEquipment">
		  <thead>
		    <tr>
			    <th>Equipment</th>
			    <th>Description</th>
			    <th>Equipment Type</th>
			    <th>Created At</th>
			    <th>Updated At</th>
			    <th>Deleted At</th>
			    <th class="right aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($equipments) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($equipments as $equipment)
			  	<tr>
			      <td>{{$equipment->strEquiName}}</td>
			      <td>{{$equipment->txtEquiDesc}}</td>
			      <td>{{$equipment->equipmentType->strEquiTypeName}}</td>
			      <td>{{$equipment->created_at}}</td>
			      <td>{{$equipment->updated_at}}</td>
			      <td>{{$equipment->deleted_at}}</td>
			      <td class="right aligned">
					<button class="ui inverted blue button" onclick="$('#update{{$equipment->strEquiCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($equipment->deleted_at == null)
			      	<button class="ui inverted red button" onclick="$('#delete{{$equipment->strEquiCode}}').modal('show');"><i class="delete icon"></i> Delete</button>
			      	@else
			      	<button class="ui inverted orange button" onclick="$('#restore{{$equipment->strEquiCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($equipments) > 0)
@foreach($equipments as $equipment)
	<div class="ui modal" id="update{{$equipment->strEquiCode}}">
	  <div class="header">Update Equipment</div>
	  <div class="content">
	    {!! Form::open(['url' => '/equipment/equipment_update']) !!}
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
	    		{{ Form::hidden('equipment_code', $equipment->strEquiCode) }}
	    		<div class="required field">
	    			{{ Form::label('equipment_name', 'Equipment Name') }}
         			{{ Form::text('equipment_name', $equipment->strEquiName, ['placeholder' => 'Type Equipment Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('equipment_description', 'Equipment Description') }}
          			{{ Form::textarea('equipment_description', $equipment->txtEquiDesc, ['placeholder' => 'Type Equipment Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('equipment_type', 'Equipment Type') }}
         			{{ Form::select('equipment_type', $equiTypes, $equipment->strEquiEquiTypeCode, ['placeholder' => 'Choose Equipment Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$equipment->strEquiCode}}">
	  <div class="header">Delete Equipment</div>
	  <div class="content">
	    <p>Do you want to delete this equipment?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/equipment/' . $equipment->strEquiCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$equipment->strEquiCode}}">
	  <div class="header">Restore Equipment</div>
	  <div class="content">
	    <p>Do you want to Restore this equipment?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/equipment/equipment_restore']) !!}
	  		{{ Form::hidden('equipment_code', $equipment->strEquiCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">Add Equipment</div>
	  <div class="content">
	    {!! Form::open(['url' => '/equipment']) !!}
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
	    			{{ Form::label('equipment_code', 'Equipment Code') }}
         			{{ Form::text('equipment_code', $newID, ['placeholder' => 'Type Equipment Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('equipment_name', 'Equipment Name') }}
         			{{ Form::text('equipment_name', '', ['placeholder' => 'Type Equipment Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('equipment_description', 'Equipment Description') }}
          			{{ Form::textarea('equipment_description', '', ['placeholder' => 'Type Equipment Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('equipment_type', 'Equipment Type') }}
         			{{ Form::select('equipment_type', $equiTypes, null, ['placeholder' => 'Choose Equipment Type', 'class' => 'ui search dropdown']) }}
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
    $('#equipment').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tblEquipment').DataTable({
        "columnDefs": [
            {
                "targets": [ 3, 4, 5 ],
                "visible": false,
            }
        ]
    });
  });
</script>
@endsection