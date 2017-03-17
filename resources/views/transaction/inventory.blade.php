@extends('layouts.admin')

@section('title')
	Inventory
@endsection

@section('content')
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
		  		<td class="right aligned">123</td>
		  		<td class="right aligned">11</td>
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
@endsection

@section('js')
<script>
  $(document).ready( function(){
  	var table = $('#tblInventory').DataTable();
  });
</script>
@endsection