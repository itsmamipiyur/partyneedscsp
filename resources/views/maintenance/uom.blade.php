@extends('layouts.admin')

@section('title')
	Unit of Measurement
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Unit of Measurement</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Unit of Measurement</button>
	</div>
	<div class="row">
		<table class="ui table" id="tbluom">
		  <thead>
		    <tr>
			    <th>Unit of Measurement Name</th>
			    <th>Unit of Measurement Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($uoms) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($uoms as $uom)
			  	<tr>
			      <td>{{$uom->uomName}}</td>
			      <td>{{$uom->uomDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$uom->uomCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($uom->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$uom->uomCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$uom->uomCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($uoms) > 0)
@foreach($uoms as $uom)
	<div class="ui modal" id="update{{$unit->uomCode}}">
	  <div class="header">Update Unit of Measurement</div>
	  <div class="content">
	    {!! Form::open(['url' => '/uom/uom_update']) !!}
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
	    		{{ Form::hidden('uom_code', $unit->uomCode) }}
	    		<div class="required field">
	    			{{ Form::label('uom_name', 'Unit of Measurement Name') }}
         			{{ Form::text('uom_name', $unit->uomName, ['placeholder' => 'Type Unit of Measurement Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('uom_description', 'Unit of Measurement Description') }}
          			{{ Form::textarea('uom_description', $unit->uomDesc, ['placeholder' => 'Type Unit of Measurement Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$uom->uomCode}}">
	  <div class="header">Deactivate Unit of Measurement</div>
	  <div class="content">
	    <p>Do you want to delete this Unit of Measurement?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/uom/' . $uom->uomCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$uom->uomCode}}">
	  <div class="header">Restore Unit of Measurement</div>
	  <div class="content">
	    <p>Do you want to Restore this Unit of Measurement?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/uom/uom_restore']) !!}
	  		{{ Form::hidden('uom_code', $uom->uomCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Unit of Measurement</div>
	  <div class="content">
	    {!! Form::open(['url' => '/uom']) !!}
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
	    			{{ Form::label('uom_code', 'Unit of Measurement Code') }}
         			{{ Form::text('uom_code', $newID, ['placeholder' => 'Type Unit of Measurement Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('uom_name', 'Unit of Measurement Name') }}
         			{{ Form::text('uom_name', '', ['placeholder' => 'Type Unit of Measurement Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('uom_description', 'Unit of Measurement Description') }}
          			{{ Form::textarea('uom_description', '', ['placeholder' => 'Type Unit of Measurement Description', 'rows' => '2']) }}
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
    $('#$uom').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tbluom').DataTable();
  });
</script>
@endsection
