@extends('layouts.admin')

@section('title')
	Item
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Item</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Item</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblitem">
		  <thead>
		    <tr>
			    <th>Name</th>
			    <th>Description</th>
			    <th>Type</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($items) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($items as $item)
			  	<tr>
			      <td>{{$item->itemName}}</td>
			      <td>{{$item->itemDesc}}</td>
			      @if($item->itemType == '1')
			      		<td>Dinnerware</td>;
			      	@elseif($item->itemType == '2')
			      		<td>Equipment</td>
			      	@endif
			      <td class="center aligned">
					<button class="ui blue button" onclick="show('{{$item->itemType}}'); $('#update{{$item->itemCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($item->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$item->itemCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$item->itemCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($items) > 0)
@foreach($items as $item)
	<div class="ui modal" id="update{{$item->itemCode}}">
	  <div class="header">Update Item</div>
	  <div class="content">
	    {!! Form::open(['url' => '/item/item_update']) !!}
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
	    		{{ Form::hidden('item_code', $item->itemCode) }}
	    		<div class="required field">
	    			{{ Form::label('item_name', 'Item Name') }}
         			{{ Form::text('item_name', $item->itemName, ['placeholder' => 'Type Item Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('item_description', 'Item Description') }}
          			{{ Form::textarea('item_description', $item->itemDesc, ['placeholder' => 'Type Item Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('uom_code', 'Unit of Measurement') }}
         			{{ Form::select('uom_code', $uoms, $item->uomCode, ['placeholder' => 'Choose Unit of Measurement', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_type', 'Item Type') }}
         			{{ Form::select('item_type', $itemTypes, $item->itemType, ['id' => 'itemType', 'placeholder' => 'Choose Item Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" id="divEquiType" style="display: none;">
	    			{{ Form::label('equipment_type', 'Equipment Type') }}
	    		@if($item->item_type == '1')
         			{{ Form::select('equipment_type', $equiTypes, $item->itemEquipment->equipmentTypeCode, ['placeholder' => 'Choose Equipment Type', 'class' => 'ui search dropdown']) }}
         		@else
         			{{ Form::select('equipment_type', $equiTypes, null, ['placeholder' => 'Choose Equipment Type', 'class' => 'ui search dropdown']) }}	
	    		@endif
	    		</div>
	    		<div class="required field" id="divDinnType" style="display: none;">
	    			{{ Form::label('dinnerware_type', 'Dinnerware Type') }}
	    		@if($item->item_type == '2')
         			{{ Form::select('dinnerware_type', $dinnTypes, $item->itemDinnerware->dinnerwareTypeCode, ['placeholder' => 'Choose Dinnerware Type', 'class' => 'ui search dropdown']) }}
	    		@else
	    			{{ Form::select('dinnerware_type', $dinnTypes, null, ['placeholder' => 'Choose Dinnerware Type', 'class' => 'ui search dropdown']) }}
	    		@endif 
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$item->itemCode}}">
	  <div class="header">Deactivate Item</div>
	  <div class="content">
	    <p>Do you want to delete this Item?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/item/' . $item->itemCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$item->itemCode}}">
	  <div class="header">Restore Item</div>
	  <div class="content">
	    <p>Do you want to Restore this Item?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/item/item_restore']) !!}
	  		{{ Form::hidden('item_code', $item->itemCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Item</div>
	  <div class="content">
	    {!! Form::open(['url' => '/item']) !!}
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
	    			{{ Form::label('item_code', 'Code') }}
         			{{ Form::text('item_code', $newID, ['placeholder' => 'Type Item Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_name', 'Name') }}
         			{{ Form::text('item_name', '', ['placeholder' => 'Type Item Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('item_description', 'Description') }}
          			{{ Form::textarea('item_description', '', ['placeholder' => 'Type Item Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('uom_code', 'Unit of Measurement') }}
         			{{ Form::select('uom_code', $uoms, null, ['placeholder' => 'Choose Unit of Measurement', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_type', 'Item Type') }}
         			{{ Form::select('item_type', $itemTypes, null, ['id' => 'itemTypes', 'placeholder' => 'Choose Item Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" id="divEquiTypes" style="display: none;">
	    			{{ Form::label('equipment_type', 'Equipment Type') }}
         			{{ Form::select('equipment_type', $equiTypes, null, ['placeholder' => 'Choose Equipment Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field" id="divDinnTypes" style="display: none;">
	    			{{ Form::label('dinnerware_type', 'Dinnerware Type') }}
         			{{ Form::select('dinnerware_type', $dinnTypes, null, ['placeholder' => 'Choose Dinnerware Type', 'class' => 'ui search dropdown']) }}
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
    $('#item').addClass("active grey");
    $('#Item_content').addClass("active");
    $('#Item').addClass("active");

    var table = $('#tblitem').DataTable();

    $('#itemTypes').on("change", function(){
    	var val = $( "select#itemTypes" ).val();

    	if(val == '1'){
    		document.getElementById('divDinnTypes').style.display = "block";
    		document.getElementById('divEquiTypes').style.display = "none";
    	}else if(val == '2'){
    		document.getElementById('divDinnTypes').style.display = "none";
    		document.getElementById('divEquiTypes').style.display = "block";
    	}else{
    		document.getElementById('divDinnTypes').style.display = "none";
    		document.getElementById('divEquiTypes').style.display = "none";
    	}
    });
  });

  function show(itemType){
  	if(itemType == '1'){
		document.getElementById('divDinnType').style.display = "block";
		document.getElementById('divEquiType').style.display = "none";
	}else if(itemType == '2'){
		document.getElementById('divDinnType').style.display = "none";
		document.getElementById('divEquiType').style.display = "block";
	}else{
		document.getElementById('divDinnType').style.display = "none";
		document.getElementById('divEquiType').style.display = "none";
	}
  }
</script>
@endsection
