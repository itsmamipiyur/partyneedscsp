@extends('layouts.admin')

@section('title')
	Rental Management
@endsection

@section('content')


	<div class="row">
		<h1>Rental Management</h1>
		<hr>
	</div>


	<div class="row">
		<a type="button" href="{{URL::to('/rentalManagement/createRental')}}" class="ui green button new"><i class="add icon"></i>Add Equipment Rental</a>
	</div>
	<div class="row">
		<table class="ui table" id="tblevent">
		  <thead>
		    <tr>
			    <th>Customer Name</th>
          <th>Customer Address</th>
			    <th>Rent Start Date</th>
			    <th>Rent Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>

      <tbody>
        <tr>
          <td>Cyriel Neil Basilio</td>
          <td>1-A Daisy St. Olandes Caloocan City</td>
          <td>2017-04-16</td>
          <td>Catering Equipment</td>
          <td class="center aligned"><button class="ui icon circular blue button""><i class="minus icon"></i></button>
          <button class="ui icon circular orange button""><i class="reply mail icon"></i></button></td>
        </tr>

        <tr>
          <td>Jose Jasper de Padua</td>
          <td>#22 Maligaya JP Rizal St. Caloocan City</td>
          <td>2017-03-27</td>
          <td>Videoke Set</td>
          <td class="center aligned"><button class="ui icon circular blue button""><i class="minus icon"></i></button>
          <button class="ui icon circular orange button""><i class="reply mail icon"></i></button></td>
        </tr>
      </tbody>

		</table>
	</div>




@endsection

@section('js')
<script>


  $(document).ready( function(){
    $('#eventManagement').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblevent').DataTable();


  });


	$(document).ready(function() {

  var ct = 0;

	$('#billS').addClass('disabled');
	$('#orderS').addClass('disabled');

  $('.next1').one('click', function(e) {

    e.preventDefault();

    $('#info').animate('slow', function() {

      if (ct > 0) {

        $('#info').removeClass('transition visible');
        $('#info').addClass('transition hidden');

      }

      $('#info').css('display', 'none');
			$('#infoS').removeClass('active');
      $('#infoS').addClass('completed');
      $('#orderS').removeClass('disabled');
			$('#orderS').addClass('active');
      $("#order").transition('fly right');
      $('body').css('background-color', '#06000a');
      $('#order button').removeClass('inverted violet');
      $('#order button').addClass('inverted blue');
      ct++;

    });

  });





  $('.prev1').one('click', function(e) {

		  e.preventDefault();


    $('#infoS').removeClass('completed');
		$('#infoS').addClass('active');
    $('#orderS').addClass('disabled');
		$('#orderS').removeClass('active');

    $('#order').animate('slow', function() {

      $('body').css('background-color', '#300032');
      $('#order').transition('hide');
      $("#info").transition('fly right');

    });
  });





  $('.next2').one('click', function(m) {

    m.preventDefault();

    $('#orderS').addClass('completed');
		$('#orderS').removeClass('active');
    $('#billS').removeClass('disabled');
		$('#billS').addClass('active');

    $('#order').animate('slow', function() {

      $('#bill button').removeClass("inverted violet");
      $('#bill button').addClass("inverted orange");
      $('body').css('background-color', '#251605');
      $('#order').transition('hide');

      $('#bill').transition('fly right');
    });

  });






  $('.prev2').one('click', function(m) {

    m.preventDefault();
    $('#billS').addClass('disabled');
    $('#orderS').removeClass('disabled');
		$('#orderS').addClass('active');
		$('#orderS').removeClass('completed');
		$('#billS').removeClass('completed');

    $('#bill').animate('slow', function() {

      $('body').css('background-color', '#06000a');
      $('#bill').transition('hide');

      $('#order').transition('fly right');
    });

  });







  $('.submit').one('click', function(p) {

    p.preventDefault();
		$('#billS').removeClass('active');
		$('#infoS').addClass('completed');
		$('#orderS').addClass('completed');
    $('#billS').addClass('completed');
  });

});


</script>
@endsection
