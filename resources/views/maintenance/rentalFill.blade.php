 @extends('layouts.admin')

@section('title')
  Add Rental
@endsection

@section('content')
  <div class="row">
    <h1>Rental Management</h1>
    <hr>
  </div>




  <div id="new" style="display: block;">

    <div class="ui container">

      <div class="ui menued three steps">

				<div class="ui active step" id="infoS">
			     <div class="content">
			       <div class="title"><i class="pencil icon"></i>Fill Rental</div>
			       <div class="description">Fill information</div>
			     </div>
			   </div>
			   <div class="ui step" id="equipS">
			     <div class="content">
			       <div class="title"><i class="food icon"></i>Choose Rental Package</div>
			       <div class="description">Choose rental equipments/packages</div>
			     </div>
			   </div>
				 <div class="ui step" id="billS">
			     <div class="content">
			       <div class="title"><i class="payment icon"></i>Billing</div>
			       <div class="description">View billing summary</div>
			     </div>
			   </div>


      </div>


      <div class="row"></div>

      <div id="info">


        <div class="ui aligned segment container " id="signUpBox" style="background-color: #F1F0FF;bmenu-radius:5px;">


          <div class="ui centered header">
            <h1 class="font" style="color:purple;">Fill information</h1>
          </div>

					<div class="ui left header">
            <h3 class="font" style="color:purple;">Customer Information</h3>
          </div>
					<hr>

          <form class="ui form">
            
                <div class="three fields">
                  <div class="required field">
                    {{ Form::label('first', 'First Name') }}
                    {{ Form::text('first', "", ['placeholder' => 'First Name']) }}
                  </div>
                  <div class="field">
                    {{ Form::label('equip_code', 'Middle Name') }}
                    {{ Form::text('d', "", ['placeholder' => 'Middle Name']) }}
                  </div>
                    <div class="required field">
                      {{ Form::label('equip_code', 'Last Name') }}
                      {{ Form::text('last', "", ['placeholder' => 'Last Name']) }}
                    </div>
                </div>

						<div class="required field">
							{{ Form::label('equip_code', 'Address') }}
								{{ Form::textarea('decor_name', "",['size'=>'3x4', 'placeholder' => 'Type Customer Address']) }}
						</div>

            <div class="two fields">
						<div class="required field" style="width:200px;">
							{{ Form::label('equip_code', 'Contact Number') }}
								{{ Form::text('decor_name', "", ['maxlength' => '11', 'placeholder' => 'Contact Number']) }}
						</div>
             <div class="required field" style="margin-left: 355px;">
              {{ Form::label('equip_code', 'Email Address') }}
                {{ Form::text('email', "", ['placeholder' => 'Email Address']) }}
            </div>
            </div>


						<div class="ui left header">
							<h3 class="font" style="color:purple;">Rental Information</h3>
						</div>
						<hr>
						


						<div class="required field" style="width:400px;">
							{{ Form::label('equip_code', 'Rent DateStart') }}
							{{	Form::date('name', \Carbon\Carbon::now()) }}
						</div>
						

						<div class="required field">
							{{ Form::label('equip_code', 'Rental Address') }}
								{{ Form::textarea('decor_name', "",['size'=>'3x4', 'placeholder' => 'Type Event Address']) }}
						</div>

						<div class="field">
		    			{{ Form::label('penalty_description', 'Rent Description') }}
	          			{{ Form::textarea('penalty_description', '', ['placeholder' => 'Type Event Description', 'rows' => '2']) }}
		    		</div>




            <button type="button" class="ui fluid inverted green button next1">Next</button>

          </form>


        </div>

      </div>


      <div id="equip" style="display: none;">


        <div class="ui aligned  segment container " id="signUpBox" style="background-color: #F1F0FF;bpackage-radius:5px;">


          <div class="ui centered header">
            <h1 class="font" style="color:rgb(50,153,153);">Choose Rental Package</h1>
          </div>

          <form class="ui form">
            

                    <div id="packs" style="display: block;">
                      <div class="field">
                        Package
                        <hr>
                        <div class="row"> </div>

                        <div class="ui checkbox">
                          <input type="checkbox">
                          {{ Form::text('decor_name', "", ['placeholder' => 'Quantity']) }}
                          <div class="row"></div>
                          <label>Photoboothpackge1</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Photoboothpackge2</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Photoboothpackge3</label>
                        </div>
                        <div class="row"></div>
                       <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Photoboothpackge4</label>
                        </div>
                         <div class="row"></div>
                       <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Videoke Set</label>
                        </div>
                        <div class="row"></div>

                       <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Catering set</label>
                        </div>
                         <div class="row"></div>

                      </div>
                    </div>


            <div class="two ui buttons">
              <button class="ui  inverted red  medium button prev1">Previous</button>
              <button class="ui  inverted green  medium button next2">Next</button>
            </div>

          </form>


        </div>

      </div>







      <div id="bill" style="display: none;">


        <div class="ui center aligned  segment container " id="signUpBox" style="background-color: #F1F0FF;bpackage-radius:5px;">


          <div class="ui centered header">
            <h1 class="font" style="color:orange;">Billing Summary</h1>
          </div>

          <form class="ui form">
            <div class="field">


              <label>03/04/2017</label>
              <div class="row"></div>
              <div class="row"></div>
              <div class="row"></div>
              <label>Customer:</label>
              <label>03/04/2017</label>
              <div class="row"></div>
              <label>Ms. Erika Pure</label>
              <div class="row"></div>
              <div class="row"></div>
              <div class="row"></div>
              <label>equip:</label>
              <hr>
              <div class="row"></div>
              <div class="row"></div>
              <label>Main Course:</label>
              <div class="row"></div>
              <label>Chicken Curry</label>
              <label>Lechon Kawali</label>
              <label>Bicol Express</label>
              <div class="row"></div>
              <div class="row"></div>
              <label>Appetizer:</label>
              <div class="row"></div>
              <label>Tuna Salad</label>
              <label>Baked mac</label>
              <div class="row"></div>
              <div class="row"></div>
              <label>Dessert:</label>
              <div class="row"></div>
              <label>Puto</label>
              <label>Cheesecake</label>
              <div class="row"></div>
              <div class="row"></div>
              <div class="row"></div>
              <div class="row"></div>
              <hr>
              <label>Additional equip</label>
              <hr>
              <div class="row"></div>
              <div class="row"></div>
              <div class="row"></div>
              <label>Additional Equipment</label>
              <hr>
              <label>Videoke Set</label>
              <label>Photoboothpackage1</label>













            <div class="two ui buttons" class="actions">
              <button class="ui  inverted red  medium button prev2">Previous</button>
              <button class="ui  inverted green medium button submit">Submit</button>
            </div>

          </form>


        </div>

      </div>


    </div>
  </div>










@endsection

@section('js')
<script>


  $('.new').one('click', function(e) {
    $('#new').animate('slow', function() {

      $('body').css('background-color', '#300032');
      $("#new").transition('fly right');

    });


  });



  $(document).ready( function(){
    $('#rentalManagement').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblevent').DataTable();


  });


	$(document).ready(function() {

  var ct = 0;

	$('#billS').addClass('disabled');
	$('#equipS').addClass('disabled');

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
      $('#equipS').removeClass('disabled');
			$('#equipS').addClass('active');
      $("#equip").transition('fly right');
      $('body').css('background-color', '#06000a');
      
      ct++;

    });

  });





  $('.prev1').one('click', function(e) {

		  e.preventDefault();


    $('#infoS').removeClass('completed');
		$('#infoS').addClass('active');
    $('#equipS').addClass('disabled');
		$('#equipS').removeClass('active');

    $('#equip').animate('slow', function() {

      $('body').css('background-color', '#300032');
      $('#equip').transition('hide');
      $("#info").transition('fly right');

    });
  });





  $('.next2').one('click', function(m) {

    m.preventDefault();

    $('#equipS').addClass('completed');
		$('#equipS').removeClass('active');
    $('#billS').removeClass('disabled');
		$('#billS').addClass('active');

    $('#equip').animate('slow', function() {

      
      $('body').css('background-color', '#251605');
      $('#equip').transition('hide');

      $('#bill').transition('fly right');
    });

  });






  $('.prev2').one('click', function(m) {

    m.preventDefault();
    $('#billS').addClass('disabled');
    $('#equipS').removeClass('disabled');
		$('#equipS').addClass('active');
		$('#equipS').removeClass('completed');
		$('#billS').removeClass('completed');

    $('#bill').animate('slow', function() {

      $('body').css('background-color', '#06000a');
      $('#bill').transition('hide');

      $('#equip').transition('fly right');
    });

  });







  $('.submit').one('click', function(p) {

    p.preventDefault();
		$('#billS').removeClass('active');
		$('#infoS').addClass('completed');
		$('#equipS').addClass('completed');
    $('#billS').addClass('completed');
  });

});


</script>
@endsection