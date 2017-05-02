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

      <tbody>
        <tr>
          <td>2017-03-18</td>
          <td>Saitama 7th Birthday</td>
          <td>Birthday</td>
          <td>Pa b-day ni bunso</td>
          <td class="center aligned"><button class="ui icon circular blue button""><i class="minus icon"></i></button>
          <button class="ui icon circular orange button""><i class="reply mail icon"></i></button></td>
        </tr>
        <tr>
          <td>2017-03-31</td>
          <td>Jose & Joan Wedding</td>
          <td>Wedding</td>
          <td>Wedding of the Century</td>
          <td class="center aligned"><button class="ui icon circular blue button""><i class="minus icon"></i></button>
          <button class="ui icon circular orange button""><i class="reply mail icon"></i></button></td>
        </tr>

        <tr>
          <td>2017-04-1</td>
          <td>Manila High School Prom Night</td>
          <td>Promenade</td>
          <td>JS Prom</td>
          <td class="center aligned"><button class="ui icon circular blue button""><i class="minus icon"></i></button>
          <button class="ui icon circular orange button""><i class="reply mail icon"></i></button></td>
        </tr>
      </tbody>

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
