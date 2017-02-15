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
			      <td>{{$menu->strMenuName}}</td>
			      <td>{{$menu->menuType->strMenuTypeName}}</td>
			      <td>{{$menu->txtMenuDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$menu->strMenuCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($menu->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$menu->strMenuCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$menu->strMenuCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
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
	<div class="ui modal" id="update{{$menu->strMenuCode}}">
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
	    		{{ Form::hidden('menu_code', $menu->strMenuCode) }}
	    		<div class="required field">
	    			{{ Form::label('menu_name', 'Menu Name') }}
         			{{ Form::text('menu_name', $menu->strMenuName, ['placeholder' => 'Type Menu Name']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('menu_type', 'Menu Type') }}
         			{{ Form::select('menu_type', $menuTypes, $menu->strMenuMenuTypeCode, ['placeholder' => 'Choose Menu Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('menu_description', 'Menu Description') }}
          			{{ Form::textarea('menu_description', $menu->txtMenuDesc, ['placeholder' => 'Type Menu Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$menu->strMenuCode}}">
	  <div class="header">Deactivate Menu</div>
	  <div class="content">
	    <p>Do you want to delete this menu?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menu/' . $menu->strMenuCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$menu->strMenuCode}}">
	  <div class="header">Restore Menu</div>
	  <div class="content">
	    <p>Do you want to Restore this menu?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menu/menu_restore']) !!}
	  		{{ Form::hidden('menu_code', $menu->strMenuCode) }}
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
	    			{{ Form::label('menu_code', 'Menu Code') }}
         			{{ Form::text('menu_code', $newID, ['placeholder' => 'Type Menu Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('menu_name', 'Menu Name') }}
         			{{ Form::text('menu_name', '', ['placeholder' => 'Type Menu Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('menu_description', 'Menu Description') }}
          			{{ Form::textarea('menu_description', '', ['placeholder' => 'Type Menu Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('menu_type', 'Menu Type') }}
         			{{ Form::select('menu_type', $menuTypes, null, ['placeholder' => 'Choose Menu Type', 'class' => 'ui search dropdown']) }}
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
  });
</script>
@endsection