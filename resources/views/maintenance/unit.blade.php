@extends('layouts.admin')

@section('title')
	Unit
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Unit</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Unit</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblUnit">
		  <thead>
		    <tr>
			    <th>Unit</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($units) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($units as $unit)
			  	<tr>
			      <td>{{$unit->strUnitName}}</td>
			      <td>{{$unit->txtUnitDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$unit->strUnitCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($unit->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$unit->strUnitCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$unit->strUnitCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($units) > 0)
@foreach($units as $unit)
	<div class="ui modal" id="update{{$unit->strUnitCode}}">
	  <div class="header">Update Unit</div>
	  <div class="content">
	    {!! Form::open(['url' => '/unit/unit_update']) !!}
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
	    		{{ Form::hidden('unit_code', $unit->strUnitCode) }}
	    		<div class="required field">
	    			{{ Form::label('unit_name', 'Unit Name') }}
         			{{ Form::text('unit_name', $unit->strUnitName, ['placeholder' => 'Type Unit Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('unit_description', 'Unit Description') }}
          			{{ Form::textarea('unit_description', $unit->txtUnitDesc, ['placeholder' => 'Type Unit Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$unit->strUnitCode}}">
	  <div class="header">Deactivate Unit</div>
	  <div class="content">
	    <p>Do you want to delete this food type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/unit/' . $unit->strUnitCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$unit->strUnitCode}}">
	  <div class="header">Restore Unit</div>
	  <div class="content">
	    <p>Do you want to Restore this food type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/unit/unit_restore']) !!}
	  		{{ Form::hidden('unit_code', $unit->strUnitCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Unit</div>
	  <div class="content">
	    {!! Form::open(['url' => '/unit']) !!}
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
	    			{{ Form::label('unit_code', 'Unit Code') }}
         			{{ Form::text('unit_code', $newID, ['placeholder' => 'Type Unit Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('unit_name', 'Unit Name') }}
         			{{ Form::text('unit_name', '', ['placeholder' => 'Type Unit Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('unit_description', 'Unit Description') }}
          			{{ Form::textarea('unit_description', '', ['placeholder' => 'Type Unit Description', 'rows' => '2']) }}
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
    $('#unit').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tblUnit').DataTable();
  });
</script>
@endsection