@extends('layouts.admin')

@section('title')
	Catering Package Detail
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
		<h1><a href="/cateringPackage"><i class="grey chevron circle left icon"></i></a> Catering Package Detail for {{$cateringPackage->cateringPackageName}}</h1>
		<hr>
	</div>

	<div class="row">
		<div class="ui grid">
			<div class="eight wide column">
				<div class="row">
					<button type="button" class="ui green button" onclick="$('#createMenu').modal('show');"><i class="add icon"></i>Add Package Menu</button>
				</div>
				<div class="row">					
					<table class="ui table" id="tblMenu">
					  <thead>
					    <tr>
						    <th>Menu</th>
						    <th style="text-align: right;">Rate</th>
						    <th class="center aligned">Action</th>
					  	</tr>
					  </thead>
					  <tbody>
						@foreach($cateringPackage->menus as $menu)
							<tr>
								<td>{{$menu->menuName}}</td>
								<td style="text-align: right;">{{$menu->pivot->menuRate}}</td>
								<td class="center aligned">
									<div class="ui horizontal buttons">
										<button class="ui blue button" onclick="$('#updateMenu{{$menu->menuCode}}').modal('show');"><i class="edit icon"></i> Update</button>
										<button class="ui red button" onclick="$('#deleteMenu{{$menu->menuCode}}').modal('show');"><i class="delete icon"></i> Remove</button>
									</div>
								</td>
							</tr>
						@endforeach
					  </tbody>
					</table>
				</div>
			</div>
			<div class="eight wide column">
				<div class="row">
					<button type="button" class="ui orange button" onclick="$('#createItem').modal('show');"><i class="add icon"></i>Add Package Item</button>
				</div>
				<div class="row">					
					<table class="ui table" id="tblItem">
					  <thead>
					    <tr>
						    <th>Item</th>
						    <th style="text-align: right;">Quantity</th>
						    <th class="center aligned">Action</th>
					  	</tr>
					  </thead>
					  <tbody>
						@foreach($cateringPackage->items as $item)
							<tr>
								<td>{{$item->itemName}}</td>
								<td style="text-align: right;">{{$item->pivot->quantity}}</td>
								<td class="center aligned">
									<div class="ui horizontal buttons">
										<button class="ui blue button" onclick="$('#updateItem{{$item->itemCode}}').modal('show');"><i class="edit icon"></i> Update</button>
										<button class="ui red button" onclick="$('#deleteItem{{$item->itemCode}}').modal('show');"><i class="delete icon"></i> Remove</button>
									</div>
								</td>
							</tr>
						@endforeach
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@if(count($cateringPackage->menus) > 0)
@foreach($cateringPackage->menus as $menu)
	<div class="ui modal" id="deleteMenu{{$menu->menuCode}}">
	  <div class="header">Remove Menu</div>
	  <div class="content">
	    <p>Do you want to delete this menu?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/cateringPackage/removeMenu']) !!}
	  		{{ Form::hidden('cateringPackage_code', $cateringPackage->cateringPackageCode) }}
	  		{{ Form::hidden('menu_code', $menu->menuCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui small modal" id="updateMenu{{$menu->menuCode}}">
	  <div class="header">Update {{$menu->menuName}}</div>
	  <div class="content">
	    {!! Form::open(['url' => '/cateringPackage/updateMenu', 'id' => 'createForm', 'class' => 'ui form']) !!}
	  		{{ Form::hidden('cateringPackage_code', $cateringPackage->cateringPackageCode) }}
	  		{{ Form::hidden('menu_code', $menu->menuRateCode) }}
	  		<div class="ui form">
		  		<div class="required field">
	    			{{ Form::label('rate', 'Rate') }}
	     			{{ Form::text('rate', $menu->pivot->amount, ['maxlength'=>'9', 'placeholder' => 'Rate', 'autofocus' => 'true']) }}
	    		</div>
	  		</div>
	  		<div class="ui error message"></div>
	  </div>
	  <div class="actions">
            {{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

@if(count($cateringPackage->items) > 0)
@foreach($cateringPackage->items as $item)
	<div class="ui modal" id="deleteItem{{$item->itemCode}}">
	  <div class="header">Remove Item</div>
	  <div class="content">
	    <p>Do you want to delete this item?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/cateringPackage/removeItem']) !!}
	  		{{ Form::hidden('cateringPackage_code', $cateringPackage->cateringPackageCode) }}
	  		{{ Form::hidden('item_code', $item->itemCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui small modal" id="updateItem{{$item->itemCode}}">
	  <div class="header">Update {{$item->itemName}}</div>
	  <div class="content">
	    {!! Form::open(['url' => '/cateringPackage/updateItem', 'id' => 'createForm', 'class' => 'ui form']) !!}
	  		{{ Form::hidden('cateringPackage_code', $cateringPackage->cateringPackageCode) }}
	  		{{ Form::hidden('item_code', $item->itemCode) }}
	  		<div class="ui form">
		  		<div class="required field">
	    			{{ Form::label('quantity', 'Quantity') }}
	     			{{ Form::text('quantity', $item->pivot->quantity, ['maxlength'=>'7', 'placeholder' => 'quantity', 'autofocus' => 'true']) }}
	    		</div>
	  		</div>
	  		<div class="ui error message"></div>
	  </div>
	  <div class="actions">
            {{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif


	<div class="ui modal" id="createMenu">
	  <div class="header">New Package Menu</div>
	  <div class="content">
	    {!! Form::open(['url' => '/cateringPackage/addMenu', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		
          		{{ Form::hidden('cateringPackage_code', $cateringPackage->cateringPackageCode) }}
	    		<div class="required field">
	    			{{ Form::label('menu_code', 'Menu') }}
         			{{ Form::select('menu_code', $menus, null, ['placeholder' => 'Choose Menu', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			<div class="required field">
	    			{{ Form::label('menu_rate_code', 'Rate') }}
         			{{ Form::select('menu_rate_code', $menuRates, null, ['placeholder' => 'Choose Rates', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		</div>
	    	</div>
	    	<div class="ui error message"></div>
        </div>
	  <div class="actions">
            {{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="createItem">
	  <div class="header">New Package Item</div>
	  <div class="content">
	    {!! Form::open(['url' => '/cateringPackage/addItem', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		<div class="ui error message"></div>
          		{{ Form::hidden('cateringPackage_code', $cateringPackage->cateringPackageCode) }}
	    		<div class="required field">
	    			{{ Form::label('item_code', 'Item') }}
         			{{ Form::select('item_code', $items, null, ['placeholder' => 'Choose Item', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('quantity', 'Quantity') }}
         			{{ Form::text('quantity', null, ['maxlength'=>'7', 'placeholder' => 'Specify quantity...']) }}
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
    item_code: {
      identifier : 'item_code',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please select a item'
      }
      ]
    },
    menu_code: {
      identifier : 'menu_code',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please select a menu'
      }
      ]
    },
    menu_rate_code: {
				identifier : 'menu_rate_code',
				rules: [ 
				
				{
				  type   : 'empty',
				  prompt : 'Please select a menu rate'
				}
				]
			},
			quantity: {
				identifier : 'quantity',
				rules: [ 
				
				{
				  type   : "regExp[^[1-9][0-9]*$]",
				  prompt : 'Please enter a valid number of Quantity'
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

    var table = $('#tblMenu').DataTable();
    var tableItem = $('#tblItem').DataTable();
  });
</script>
@endsection