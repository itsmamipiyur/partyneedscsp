@extends('layouts.admin')

@section('title')
	Inventory
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif
  	@if ($alert = Session::get('alert-failed'))
    <div class="ui error message">
    	<div class="header">Failed!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Inventory</h1>
		<hr>
	</div>

	<div class="row">
		<table class="ui table" id="tblInventory">
		  <thead>
		    <th>Name</th>
		    <th>Description</th>
		    <th class="right aligned">Stock on Hand</th>
		    <th class="right aligned">Stock Released</th>
		    <th class="center aligned">Action</th>
		  </thead>
		  <tbody>
		  @foreach($items as $item)
		  	<tr>
		  		<td>{{ $item->itemName }}</td>
		  		<td>{{ $item->itemDesc }}</td>
		  		<td class="right aligned">{{ $item->onHand }}</td>
		  		<td class="right aligned">{{ $item->quantityReleased }}</td>
	  			<td class="center aligned">
					<button class="ui icon circular green button" onclick="$('#addStock{{$item->itemCode}}').modal('show');"><i class="add icon"></i></button>
					<button class="ui icon circular blue button" onclick="$('#releaseStock{{$item->itemCode}}').modal('show');"><i class="minus icon"></i></button>
					<button class="ui icon circular orange button" onclick="$('#returnStock{{$item->itemCode}}').modal('show');"><i class="reply mail icon"></i></button>
				</td>
		  	</tr>
		  @endforeach
		  </tbody>
		</table>
	</div>

@foreach($items as $item)
	<div class="ui modal" id="addStock{{$item->itemCode}}">
	  <div class="header">Add Stock</div>
	  <div class="content">
	    {!! Form::open(['url' => '/inventory/addStock']) !!}
	    	<div class="ui form">
	    		{{ Form::hidden('item_code', $item->itemCode) }}
	    		<div class="required field">
	    			{{ Form::label('quantity', 'Quantity') }}
         			{{ Form::text('quantity', null, ['placeholder' => 'Type Quantity']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="releaseStock{{$item->itemCode}}">
	  <div class="header">Release Stock</div>
	  <div class="content">
	    {!! Form::open(['url' => '/inventory/releaseStock']) !!}
	    	<div class="ui form">
	    		{{ Form::hidden('item_code', $item->itemCode) }}
	    		<div class="required field">
	    			{{ Form::label('quantity', 'Quantity') }}
         			{{ Form::text('quantity', null, ['placeholder' => 'Type Quantity']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach

@endsection


@section('js')
<script>
  $(document).ready( function(){
  	var table = $('#tblInventory').DataTable();
  });
</script>
@endsection