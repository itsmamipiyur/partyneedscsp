@extends('layouts.admin')

@section('title')
	Menu
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Menu</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Menu</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblMenu">
		  <thead>
		    <tr>
			    <th>Menu</th>
			    <th>Menu Type</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($menus) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($menus as $menu)
			  	<tr>
			      <td>{{$menu->menuName}}</td>
			      
			      	@if($menu->menuType == '1')
			      		<td>Buffet</td>
			      	@elseif($menu->menuType == '2')
			      		<td>Set</td>
			      	@endif
			      
			      <td>{{$menu->menuDesc}}</td>
			      <td class="center aligned">
			      	@if($menu->menuType == '2')
			      	<a href="{{url('/menu/'. $menu->menuCode)}}" class="ui teal button">Add Menu Dish</a>
			      	@endif
					<button class="ui blue button" onclick="$('#update{{$menu->menuCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($menu->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$menu->menuCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$menu->menuCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($menus) > 0)
@foreach($menus as $menu)
	<div class="ui modal" id="update{{$menu->menuCode}}">
	  <div class="header">Update Menu</div>
	  <div class="content">
	    {!! Form::open(['url' => '/menu/menu_update']) !!}
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
	    		{{ Form::hidden('menu_code', $menu->menuCode) }}
	    		<div class="required field">
	    			{{ Form::label('menu_name', 'Name') }}
         			{{ Form::text('menu_name', $menu->menuName, ['placeholder' => 'Type Menu Name']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('menu_type', 'Type') }}
         			{{ Form::select('menu_type', $menuTypes, $menu->menuType, ['placeholder' => 'Choose Menu Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('menu_description', 'Description') }}
          			{{ Form::textarea('menu_description', $menu->menuDesc, ['placeholder' => 'Type Menu Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$menu->menuCode}}">
	  <div class="header">Deactivate Menu</div>
	  <div class="content">
	    <p>Do you want to delete this menu?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menu/' . $menu->menuCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$menu->menuCode}}">
	  <div class="header">Restore Menu</div>
	  <div class="content">
	    <p>Do you want to Restore this menu?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menu/menu_restore']) !!}
	  		{{ Form::hidden('menu_code', $menu->menuCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Menu</div>
	  <div class="content">
	    {!! Form::open(['url' => '/menu']) !!}
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
	    			{{ Form::label('menu_code', 'Code') }}
         			{{ Form::text('menu_code', $newID, ['placeholder' => 'Type Menu Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('menu_name', 'Name') }}
         			{{ Form::text('menu_name', '', ['placeholder' => 'Type Menu Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('menu_description', 'Description') }}
          			{{ Form::textarea('menu_description', '', ['placeholder' => 'Type Menu Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('menu_type', 'Type') }}
         			{{ Form::select('menu_type', $menuTypes, null, ['id' => 'menuType', 'placeholder' => 'Choose Menu Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" style="display: none;" id="typeSelect">
	    			{{ Form::label('dish_code', 'Dish') }}
         			{{ Form::select('dish_code', $dishes, null, ['placeholder' => 'Choose Dish', 'class' => 'ui search dropdown']) }}
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
    $('#menus').addClass("active grey");
    $('#menu_content').addClass("active");
    $('#menu').addClass("active");

    var table = $('#tblMenu').DataTable();

    $('#menuType').on("change", function(){
    	var val = $( "select#menuType" ).val();

    	if(val == '1'){
    		document.getElementById('typeSelect').style.display = "block";
    	}else{
    		document.getElementById('typeSelect').style.display = "none";
    	}
    });
  });
</script>
@endsection