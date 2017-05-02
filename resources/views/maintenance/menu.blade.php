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

	<div class="row">
		<h1>Menu</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');" style="background-color: rgb(0,128,0);"><i class="add icon"></i>New Menu</button>
		<a href="{{ url('/archive/menu') }}" class="ui teal button" style="background-color: rgb(0,128,128);"><i class="archive icon"></i>Archive</a>
	</div>
	<div class="row">
		<table class="ui table" id="tblMenu">
		  <thead>
		    <tr>
			    <th>Name</th>
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
			      <td>{{$menu->menuDesc}}</td>
			      <td class="center aligned">
			      	<a href="{{url('/menu/'. $menu->menuCode)}}" style="background-color: rgb(0,128,128);" class="ui teal button">Menu Detail</a>
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
	    {!! Form::open(['url' => '/menu/menu_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		<div class="ui error message"></div>
	    		{{ Form::hidden('menu_code', $menu->menuCode) }}
	    		<div class="required field">
	    			{{ Form::label('menu_name', 'Name') }}
         			{{ Form::text('menu_name', $menu->menuName, ['maxlength' => '25', 'placeholder' => 'Type Menu Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('menu_description', 'Description') }}
          			{{ Form::textarea('menu_description', $menu->menuDesc, ['maxlength' => '200', 'placeholder' => 'Type Menu Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
	    	
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$menu->menuCode}}">
	  <div class="header">Deactivate Menu</div>
	  <div class="content">
	    <p>Do you want to deactivate this menu?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menu/' . $menu->menuCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
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
            {{ Form::button('Yes', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Menu</div>
	  <div class="content">
	    {!! Form::open(['url' => '/menu', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		<div class="ui error message"></div>

	    		<div class="disabled field">

         			{{ Form::hidden('menu_code', $newID, ['placeholder' => 'Type Menu Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('menu_name', 'Name') }}
         			{{ Form::text('menu_name', '', ['maxlength' => '25', 'placeholder' => 'Type Menu Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('menu_description', 'Description') }}
          			{{ Form::textarea('menu_description', '', ['maxlength' => '200', 'placeholder' => 'Type Menu Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="ui horizontal divider">Menu Details</div>
	    		<div class="required field">
	    			{{ Form::label('menu_dish[]', 'Dish') }}
         			{{ Form::select('menu_dish[]', $dishes, '', ['id' => 'menu_dish', 'multiple' => 'multiple', 'placeholder' => 'Select Dish', 'class' => 'ui fluid search dropdown' ]) }}
	    		</div>
	    	</div>
	    	
        </div>
	  <div class="actions">
            {{ Form::button('Submit', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>	
@endsection

@section('js')
<script>
  $(document).ready( function(){

  	$('.ui.modal').modal({
        onApprove : function() {
          //Submits the semantic ui form
          //And pass the handling responsibilities to the form handlers,
          // e.g. on form validation success
          //$('.ui.form').submit();
          console.log('approve');
          //Return false as to not close modal dialog
          return false;
        }
    });


	var formValidationRules =
	{
		menu_name: {
		  identifier : 'menu_name',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter the name'
			},
			{
        

           	type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

	        	
	           
				prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
        	}
			
		  ]
		},
		menu_dish: {
	      identifier : 'menu_dish',
	      rules: [
	      {
	        type   : 'empty',
	        prompt : 'Please select a menu dish'
	      }
	      ]
	    }
	}




	var formSettings =
	{
		onSuccess : function() 
		{
		  $('.modal').modal('hide');
		}
	}

	$('.ui.form').form(formValidationRules, formSettings);
















    $('#menus').addClass("active grey");
    $('#menu_content').addClass("active");
    $('#menu').addClass("active");
    $('.ui.dropdown').dropdown();

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