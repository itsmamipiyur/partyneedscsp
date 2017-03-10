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
		<a type="button" href="{{URL::to('/eventFill')}}" class="ui green button new"><i class="add icon"></i>Add Event</a>
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




@endsection

@section('js')
<script>

$('.button').one('click', function(e) {

		  $('.ui.form')
  .form({
    fields: {
      name: {
        identifier: 'name',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter your name'
          }
        ]
      },
      skills: {
        identifier: 'skills',
        rules: [
          {
            type   : 'minCount[2]',
            prompt : 'Please select at least two skills'
          }
        ]
      },
      gender: {
        identifier: 'gender',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select a gender'
          }
        ]
      },
      username: {
        identifier: 'username',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter a username'
          }
        ]
      },
      password: {
        identifier: 'password',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter a password'
          },
          {
            type   : 'minLength[6]',
            prompt : 'Your password must be at least {ruleValue} characters'
          }
        ]
      },
      terms: {
        identifier: 'terms',
        rules: [
          {
            type   : 'checked',
            prompt : 'You must agree to the terms and conditions'
          }
        ]
      }
    }
  })
;
  })
;



	$('.ui.dropdown').dropdown('set selected',['Role1','Role2']);

	$('.new').one('click', function(e) {
		$('#new').animate('slow', function() {

      $('body').css('background-color', '#300032');
      $("#new").transition('fly right');

    });


	});


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
