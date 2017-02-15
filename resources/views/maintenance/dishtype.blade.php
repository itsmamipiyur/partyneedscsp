@extends('layouts.admin')

@section('title')
	Dish Type
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Dish Type</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Dish Type</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblDishType">
		  <thead>
		    <tr>
			    <th>Dish Type</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($dishtypes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($dishtypes as $dishtype)
			  	<tr>
			      <td>{{$dishtype->dishTypeName}}</td>
			      <td>{{$dishtype->dishTypeDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$dishtype->dishTypeCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($dishtype->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$dishtype->dishTypeCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$dishtype->dishTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($dishtypes) > 0)
@foreach($dishtypes as $dishtype)
	<div class="ui modal" id="update{{$dishtype->dishTypeCode}}">
	  <div class="header">Update Dish Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/dishType/dishType_update']) !!}
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
	    		{{ Form::hidden('dishtype_code', $dishtype->dishTypeCode) }}
	    		<div class="required field">
	    			{{ Form::label('dishtype_name', 'Dish Type Name') }}
         			{{ Form::text('dishtype_name', $dishtype->dishTypeName, ['placeholder' => 'Type Dish Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('dishtype_description', 'Dish Type Description') }}
          			{{ Form::textarea('dishtype_description', $dishtype->dishTypeDesc, ['placeholder' => 'Type Dish Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$dishtype->dishTypeCode}}">
	  <div class="header">Deactivate Dish Type</div>
	  <div class="content">
	    <p>Do you want to delete this dish type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dishtype/' . $dishtype->dishTypeCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$dishtype->dishTypeCode}}">
	  <div class="header">Restore Dish Type</div>
	  <div class="content">
	    <p>Do you want to Restore this dish type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dishtype/dishtype_restore']) !!}
	  		{{ Form::hidden('dishtype_code', $dishtype->dishTypeCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Dish Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/dishType']) !!}
	    
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
	    			{{ Form::label('dishtype_code', 'Dish Type Code') }}
         			{{ Form::text('dishtype_code', $newID, ['placeholder' => 'Type Dish Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('dishtype_name', 'Dish Type Name') }}
         			{{ Form::text('dishtype_name', '', ['placeholder' => 'Type Dish Type Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('dishtype_description', 'Dish Type Description') }}
          			{{ Form::textarea('dishtype_description', '', ['placeholder' => 'Type Dish Type Description', 'rows' => '2']) }}
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
    $('#dishtype').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tblDishType').DataTable();
  });
</script>
@endsection