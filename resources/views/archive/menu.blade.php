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
		<h1>Archive - Menu</h1>
		<hr>
	</div>

	<div class="row">
		<a href="{{ url('/menu') }}" class="ui brown button"><i class="archive icon"></i>Back to Menu</a>
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