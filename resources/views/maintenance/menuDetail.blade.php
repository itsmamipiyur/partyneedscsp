@extends('layouts.admin')

@section('title')
	Menu Detail
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1><a href="/menu"><i class="grey chevron circle left icon"></i></a> Menu Detail for {{$menu->menuName}}</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Menu Dish</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblMenu">
		  <thead>
		    <tr>
			    <th>Menu Dish</th>
			    <th>Dish Type</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>

			@foreach($menu->dishes as $menuDish)
				<tr>
					<td>{{$menuDish->dishName}}</td>
					<td>{{$menuDish->dishType->dishTypeName}}</td>
					<td class="center aligned">
						<button class="ui red button" onclick="$('#delete{{$menuDish->dishCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
					</td>
				</tr>
			@endforeach
		  </tbody>
		</table>
	</div>

@if(count($menu->dishes) > 0)
@foreach($menu->dishes as $menuDish)
	<div class="ui modal" id="delete{{$menuDish->dishCode}}">
	  <div class="header">Remove Menu Dish</div>
	  <div class="content">
	    <p>Do you want to delete this menu dish?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menu/removeMenuDish']) !!}
	  		{{ Form::hidden('menu_code', $menu->menuCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Menu Dish</div>
	  <div class="content">
	    {!! Form::open(['url' => '/menu/addMenuDish']) !!}
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
  });
</script>
@endsection