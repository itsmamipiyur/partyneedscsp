@extends('layouts.admin')

@section('title')
	Menu Type
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Menu Type</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Menu Type</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblMenuType">
		  <thead>
		    <tr>
			    <th>Menu Type</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($menuTypes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($menuTypes as $menuType)
			  	<tr>
			      <td>{{$menuType->strMenuTypeName}}</td>
			      <td>{{$menuType->txtMenuTypeDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$menuType->strMenuTypeCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($menuType->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$menuType->strMenuTypeCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$menuType->strMenuTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($menuTypes) > 0)
@foreach($menuTypes as $menuType)
	<div class="ui modal" id="update{{$menuType->strMenuTypeCode}}">
	  <div class="header">Update Menu Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/menuType/menuType_update']) !!}
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
	    		{{ Form::hidden('menu_type_code', $menuType->strMenuTypeCode) }}
	    		<div class="required field">
	    			{{ Form::label('menu_type_name', 'Menu Type Name') }}
         			{{ Form::text('menu_type_name', $menuType->strMenuTypeName, ['placeholder' => 'Type Menu Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('menu_type_description', 'Menu Type Description') }}
          			{{ Form::textarea('menu_type_description', $menuType->txtMenuTypeDesc, ['placeholder' => 'Type Menu Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$menuType->strMenuTypeCode}}">
	  <div class="header">Deactivate Menu Type</div>
	  <div class="content">
	    <p>Do you want to delete this menu type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menuType/' . $menuType->strMenuTypeCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$menuType->strMenuTypeCode}}">
	  <div class="header">Restore Menu Type</div>
	  <div class="content">
	    <p>Do you want to Restore this menu type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menuType/menuType_restore']) !!}
	  		{{ Form::hidden('menu_type_code', $menuType->strMenuTypeCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Menu Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/menuType']) !!}
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
	    			{{ Form::label('menu_type_code', 'Menu Type Code') }}
         			{{ Form::text('menu_type_code', $newID, ['placeholder' => 'Type Menu Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('menu_type_name', 'Menu Type Name') }}
         			{{ Form::text('menu_type_name', '', ['placeholder' => 'Type Menu Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('menu_type_description', 'Menu Type Description') }}
          			{{ Form::textarea('menu_type_description', '', ['placeholder' => 'Type Menu Type Description', 'rows' => '2']) }}
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
    $('#menuType').addClass("active grey");
    $('#menu_content').addClass("active");
    $('#menu').addClass("active");

    var table = $('#tblMenuType').DataTable();
  });
</script>
@endsection