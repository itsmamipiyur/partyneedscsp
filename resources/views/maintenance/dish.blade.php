@extends('layouts.admin')

@section('title')
	Dish
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Dish</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Dish</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblDish">
		  <thead>
		    <tr>
			    <th>Dish</th>
			    <th>Description</th>
			    <th>Dish Type</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($dishes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($dishes as $dish)
			  	<tr>
			      <td>{{$dish->dishName}}</td>
			      <td>{{$dish->dishDesc}}</td>
			      <td>{{$dish->dishTypeCode->dishTypeName}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$dish->dishCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($dish->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$dish->dishCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$dish->dishCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($dishes) > 0)
@foreach($dishes as $dish)
	<div class="ui modal" id="update{{$dish->dishCode}}">
	  <div class="header">Update Dish</div>
	  <div class="content">
	    {!! Form::open(['url' => '/dish/dish_update']) !!}
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
	    		{{ Form::hidden('dish_code', $dish->dishCode) }}
	    		<div class="required field">
	    			{{ Form::label('dish_name', 'Dish Name') }}
         			{{ Form::text('dish_name', $dish->dishName, ['placeholder' => 'Type Dish Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('dish_description', 'Dish Description') }}
          			{{ Form::textarea('dish_description', $dish->dishDesc, ['placeholder' => 'Type Dish Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('dish_type', 'Dish Type') }}
         			{{ Form::select('dish_type', $dishTypes, $dish->dishTypeCode, ['placeholder' => 'Choose Dish Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$dish->dishCode}}">
	  <div class="header">Deactivate Dish</div>
	  <div class="content">
	    <p>Do you want to delete this dish?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dish/' . $dish->dishCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$dish->dishCode}}">
	  <div class="header">Restore Dish</div>
	  <div class="content">
	    <p>Do you want to Restore this dish?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dish/dish_restore']) !!}
	  		{{ Form::hidden('dish_code', $dish->dishCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Dish</div>
	  <div class="content">
	    {!! Form::open(['url' => '/dish']) !!}
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
	    			{{ Form::label('dish_code', 'Dish Code') }}
         			{{ Form::text('dish_code', $newID, ['placeholder' => 'Type Dish Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('dish_name', 'Dish Name') }}
         			{{ Form::text('dish_name', '', ['placeholder' => 'Type Dish Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('dish_description', 'Dish Description') }}
          			{{ Form::textarea('dish_description', '', ['placeholder' => 'Type Dish Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('dish_type', 'Dish Type') }}
         			{{ Form::select('dish_type', $dishTypes, null, ['placeholder' => 'Choose Dish Type', 'class' => 'ui search dropdown']) }}
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
    $('#dish').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tblDish').DataTable();
  });
</script>
@endsection