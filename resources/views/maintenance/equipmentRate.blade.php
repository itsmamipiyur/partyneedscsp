@extends('layouts.admin')

@section('title')
	Equipment Rate
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Equipment Rate</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>Add Equipment Rate</button>
	</div>
	<div class="row">
		<table class="ui inverted table" id="tblEquipmentRate">
		  <thead>
		    <tr>
			    <th>Equipment</th>
			    <th>Amount</th>
			    <th>Unit</th>
			    <th>Created At</th>
			    <th>Updated At</th>
			    <th>Deleted At</th>
			    <th class="right aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($equipmentRates) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($equipmentRates as $equipmentRate)
			  	<tr>
			      <td>{{$equipmentRate->equipment->strEquiName}}</td>
			      <td>{{$equipmentRate->dblEquiRateAmount}}</td>
			      <td>{{$equipmentRate->unit->strUnitName}}</td>
			      <td>{{$equipmentRate->created_at}}</td>
			      <td>{{$equipmentRate->updated_at}}</td>
			      <td>{{$equipmentRate->deleted_at}}</td>
			      <td class="right aligned">
					<button class="ui inverted blue button" onclick="$('#update{{$equipmentRate->strEquiRateCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($equipmentRate->deleted_at == null)
			      	<button class="ui inverted red button" onclick="$('#delete{{$equipmentRate->strEquiRateCode}}').modal('show');"><i class="delete icon"></i> Delete</button>
			      	@else
			      	<button class="ui inverted orange button" onclick="$('#restore{{$equipmentRate->strEquiRateCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($equipmentRates) > 0)
@foreach($equipmentRates as $equipmentRate)
	<div class="ui modal" id="update{{$equipmentRate->strEquiCode}}">
	  <div class="header">Update Equipment Rate</div>
	  <div class="content">
	    {!! Form::open(['url' => '/equipmentRate/equipmentRate_update']) !!}
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
	    		{{ Form::hidden('equipment_rate_code', $equipmentRate->strEquiRateCode) }}
	    		<div class="required field">
	    			{{ Form::label('equipment', 'Equipment') }}
         			{{ Form::select('equipment', $equipments, $equipmentRate->strEquiRateEquiCode, ['placeholder' => 'Choose Equipment', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('equipment_rate_amount', 'Equipment Rate Description') }}
	    			<div class="ui right labeled input">
	    			<div class="ui label">P</div>
          			{{ Form::text('equipment_rate_amount', $equipmentRate->dblEquiRateAmount, ['placeholder' => 'Amount']) }}
          			</div>
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('equipment_rate_unit', 'Equipment Rate Unit') }}
         			{{ Form::select('equipment_rate_unit', $units, $equipmentRate->strEquiRateUnitCode, ['placeholder' => 'Choose Unit', 'class' => 'ui search dropdown']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$equipmentRate->strEquiRateCode}}">
	  <div class="header">Delete Equipment Rate</div>
	  <div class="content">
	    <p>Do you want to delete this equipment?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/equipmentRate/' . $equipmentRate->strEquiRateCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$equipmentRate->strEquiRateCode}}">
	  <div class="header">Restore Equipment Rate</div>
	  <div class="content">
	    <p>Do you want to Restore this equipment?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/equipmentRate/equipment_restore']) !!}
	  		{{ Form::hidden('equipment_rate_code', $equipmentRate->strEquiRateCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">Add Equipment Rate</div>
	  <div class="content">
	    {!! Form::open(['url' => '/equipmentRate']) !!}
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
	    			{{ Form::label('equipment_rate_code', 'Equipment Rate Code') }}
         			{{ Form::text('equipment_rate_code', $newID, ['placeholder' => 'Type Equipment Rate Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('equipment', 'Equipment') }}
         			{{ Form::select('equipment', $equipments, null, ['placeholder' => 'Choose Equipment', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('equipment_rate_amount', 'Equipment Rate Description') }}
	    			<div class="ui right labeled input">
	    			<div class="ui label">P</div>
          			{{ Form::text('equipment_rate_amount', null, ['placeholder' => 'Amount']) }}
          			</div>
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('equipment_rate_unit', 'Equipment Rate Unit') }}
         			{{ Form::select('equipment_rate_unit', $units, null, ['placeholder' => 'Choose Unit', 'class' => 'ui search dropdown']) }}
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
    $('#equipmentRate').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tblEquipmentRate').DataTable({
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