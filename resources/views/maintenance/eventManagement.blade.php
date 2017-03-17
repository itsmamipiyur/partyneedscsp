@extends('layouts.admin')

@section('title')
	Event Management
@endsection

@section('content')


	<div class="row">
		<h1>Event Management</h1>
		<hr>
	</div>


	<div class="row">
		<button class="ui green button new" id="create"><i class="add icon"></i>Add Event</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblevent">
		  <thead>
		    <tr>
			    <th>Event Date</th>
			    <th>Event Title</th>
			    <th>Event Type</th>
			    <th>Event Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>

		</table>
	</div>

  <div class="ui modal">
    <div class="content">
      <div class="center">
        <h2 class="center aligned">
          Create an event for:
        </h2>

        <div class="ui fluid buttons">
          <a href="{{url('/eventManagement/createEvent')}}" class="ui blue button">New Customer</a>
          <div class="or"></div>
          <a class="ui button">Existing Customer</a>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('js')
<script>
  $(document).ready( function(){
    $('#eventManagement').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblevent').DataTable();

    $('#create').on('click', function() {
      $('.ui.modal').modal('show');
    });

  });

</script>
@endsection
