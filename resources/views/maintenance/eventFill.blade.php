@extends('layouts.admin')

@section('title')
	Add Event
@endsection

@section('content')
  <div class="row">
    <h1>Event Management</h1>
    <hr>
  </div>

  <div id="new">

    <div class="ui container">


      <div class="ui packaged five steps">


				<div class="ui active step" id="infoS">
			     <div class="content">
			       <div class="title"><i class="pencil icon"></i>Fill Information</div>
			       <div class="description">Fill personal & event information</div>
			     </div>
			   </div>
			   <div class="ui step" id="packageS">
			     <div class="content">
			       <div class="title"><i class="cube icon"></i>Choose Packages</div>
			       <div class="description">Choose packages</div>
			     </div>
			   </div>
         <div class="ui step" id="menuS">
           <div class="content">
             <div class="title"><i class="food icon"></i>Choose Menu</div>
             <div class="description">Choose menu</div>
           </div>
         </div>
         <div class="ui step" id="equipS">
           <div class="content">
             <div class="title"><i class="setting icon"></i>Choose Equipment</div>
             <div class="description">Choose inclusions</div>
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


        <div class="ui aligned segment container " id="signUpBox" style="background-color: #F1F0FF;bpackage-radius:5px;">


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
                    {{ Form::label('menu_code', 'Middle Name') }}
        						{{ Form::text('d', "", ['placeholder' => 'Middle Name']) }}
      						</div>
      							<div class="required field">
                      {{ Form::label('menu_code', 'Last Name') }}
        							{{ Form::text('last', "", ['placeholder' => 'Last Name']) }}
      							</div>
    						</div>

						<div class="required field">
							{{ Form::label('menu_code', 'Address') }}
								{{ Form::textarea('address', "",['size'=>'3x4', 'placeholder' => 'Type Customer Address']) }}
						</div>


            <div class="two fields">
						<div class="required field" style="width:200px;">
							{{ Form::label('menu_code', 'Contact Number') }}
								{{ Form::text('contact', "", ['maxlength' => '11', 'placeholder' => 'Contact Number']) }}
						</div>
            <div class="required field" style="margin-left: 355px;">
              {{ Form::label('menu_code', 'Email Address') }}
                {{ Form::text('email', "", ['placeholder' => 'Email Address']) }}
            </div>
            </div>



						<div class="ui left header">
							<h3 class="font" style="color:purple;">Event Information</h3>
						</div>
						<hr>
						<div class="two fields">
							<div class="required field">
								{{ Form::label('menu_code', 'Event Title') }}
									{{ Form::text('decor_name', "", ['placeholder' => 'Event Title']) }}
							</div>

							<div class="required field">
			    			{{ Form::label('eventTypes', 'Event Type') }}
		         			{{ Form::select('eventTypes', $eventTypes, null, ['placeholder' => 'Choose Event Type', 'class' => 'ui search dropdown']) }}
			    		</div>
						</div>

						<div class="two fields">
						<div class="required field" style="width:200px;">
							{{ Form::label('menu_code', 'Event Date') }}
							{{	Form::date('name', \Carbon\Carbon::now()) }}
						</div>
						
                <div class="field" style="margin-left :355px;">
                  {{ Form::label('decors', 'Event Motif') }}
                    {{ Form::select('decors', $decors, '', ['multiple' => 'multiple', 'placeholder' => 'Select Motif', 'class' => 'ui fluid dropdown' ]) }}
                </div>
            
					</div>
						<div class="required field">
							{{ Form::label('menu_code', 'Event Address') }}
								{{ Form::textarea('decor_name', "",['size'=>'3x4', 'placeholder' => 'Type Event Address']) }}
						</div>

						<div class="field">
		    			{{ Form::label('penalty_description', 'Event Description') }}
	          			{{ Form::textarea('penalty_description', '', ['placeholder' => 'Type Event Description', 'rows' => '2']) }}
		    		</div>


            <div class="ui fluid green button next1">Next</div>
              <div class="ui error message"></div>
          </form>


        </div>

      </div>



      <div id="package" style="display: none;">


        <div class="ui aligned  segment container " id="signUpBox" style="background-color: #F1F0FF;bpackage-radius:5px;">


          <div class="ui centered header">
            <h1 class="font" style="color:rgb(50,153,153);">Choose Package</h1>
          </div>

          <form class="ui form">
						<div class="required field">
							{{ Form::label('cateringTypes', 'Catering Type') }}
								{{ Form::select('cateringTypes', $cateringTypes, null, ['placeholder' => 'Choose Catering Type', 'class' => 'ui search dropdown']) }}
						</div>
						<hr>

						        <div id="packs" style="display: block;">
											<div class="field" style="width: 355px;">
                        Package
												<div class="row"> </div>

												<div class="ui checkbox">
                          <input type="checkbox">
                          {{ Form::text('decor_name', "", ['placeholder' => 'Quantity']) }}
                          <div class="row"> </div>
                          <label>Package1 </label>

                        </div>
                        <div class="row"></div>
												<div class="ui checkbox">
                          <input type="checkbox">
                          <label>Package2</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Package3</label>
                        </div>
                        <div class="row"></div>
                       <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Package4</label>
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




       <div id="menu" style="display: none;">


        <div class="ui aligned  segment container " id="signUpBox" style="background-color: #F1F0FF;bpackage-radius:5px;">


          <div class="ui centered header">
            <h1 class="font" style="color:rgb(50,153,153);">Choose Menu</h1>
          </div>

          <form class="ui form">
            <div class="required field">
              {{ Form::label('cateringTypes', 'Catering Type') }}
                {{ Form::select('cateringTypes', $cateringTypes, null, ['placeholder' => 'Choose Catering Type', 'class' => 'ui search dropdown']) }}
            </div>
            



              <div id="others" style="display: block;">
                <div class="row">
                  Menu
                  <hr>


                  <div class="field" style="width: 200px;">
                  {{ Form::text('decor_name', "", ['placeholder' => 'Quantity']) }}
                  </div>
                          <div class="row"> </div>

                                    
                    Main Course<br />
                    <div class="inline two fields">
                      <div class="field">
                        <div class="row"> </div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Menudo</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Caldereta</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Chicken Curry</label>
                        </div>
                        <div class="row"></div>
                      </div>

                      <div class="field">
                        <div class="row"> </div>
                        <div class="field">
                        <div class="row"> </div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Lechon Kawali</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Dinuguan</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Bicol Express</label>
                        </div>
                        <div class="row"></div>
                      </div>
                      </div>
                    </div>

                    Appetizer<br />
                    <div class="inline two fields">
                      <div class="field">
                        <div class="row"> </div>
                        <div class="field">
                        <div class="row"> </div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Churrros</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Tuna Salad</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Baked mac</label>
                        </div>
                        <div class="row"></div>
                      </div>
                      </div>

                      <div class="field">
                        <div class="row"> </div>
                        <div class="field">
                        <div class="row"> </div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Siomai</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Waffle</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Spaghetti</label>
                        </div>
                        <div class="row"></div>
                      </div>
                      </div>
                    </div>

                    Dessert<br />
                    <div class="inline two fields">
                      <div class="field">
                        <div class="row"> </div>
                        <div class="field">
                        <div class="row"> </div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Cheesecake</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Tiramisu</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Cupcake</label>
                        </div>
                        <div class="row"></div>
                      </div>
                      </div>

                      <div class="field">
                        <div class="row"> </div>
                        <div class="field">
                        <div class="row"> </div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Puto</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Pudding</label>
                        </div>
                        <div class="row"></div>
                        <div class="ui checkbox">
                          <input type="checkbox">
                          <label>Ube halaya</label>
                        </div>
                        <div class="row"></div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>




              


            <div class="two ui buttons">
              <button class="ui  inverted red  medium button prev2">Previous</button>
              <button class="ui  inverted green medium button next3">Next</button>
            </div>

          </form>


        </div>

      </div>







      <div id="equip" style="display: none;">


        <div class="ui aligned  segment container " id="signUpBox" style="background-color: #F1F0FF;bpackage-radius:5px;">


          <div class="ui centered header">
            <h1 class="font" style="color:rgb(50,153,153);">Choose Equipment</h1>
          </div>

          <form class="ui form">
            

                    <div id="packs" style="display: block;">
                      <div class="field" style="width: 355px;">
                        Package
                        <div class="row"> </div>

                        <div class="ui checkbox">
                          <input type="checkbox">
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
              <button class="ui  inverted red  medium button prev3">Previous</button>
              <button class="ui  inverted green  medium button next4">Next</button>
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
              <label>Menu:</label>
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
              <label>Additional Menu</label>
              <hr>
              <div class="row"></div>
              <div class="row"></div>
              <div class="row"></div>
              <label>Additional Equipment</label>
              <hr>
              <label>Videoke Set</label>
              <label>Photoboothpackage1</label>













            <div class="two ui buttons" class="actions">
              <button class="ui  inverted red  medium button prev4">Previous</button>
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

$(document).ready(function() {

$('.ui.dropdown').dropdown();

$('.ui.dropdown').dropdown('set selected',['Role1','Role2']);




var ct = 0;

  $('#billS').addClass('disabled');
  $('#packageS').addClass('disabled');
  $('#menuS').addClass('disabled');
  $('#equipS').addClass('disabled');


// info

$('.next1').one('click', function(e) {

    e.preventDefault();
    var formValidationRules =
      {
      

      fname: {
        identifier: 'first',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter first name'
          }
        ]
      },
      name: {
        identifier: 'last',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter last name'
          }
        ]
      },

      contact: {
        identifier: 'contact',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter a contact'
          }
        ]
      },
     
      email: {
        identifier: 'email',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter an email'
          }
        ]
      },
      address: {
        identifier: 'address',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter the address'
          }
        ]
      }
   
    }

    $('.ui.form').form(formValidationRules);


    $('#infoS').addClass('completed');
    $('#info').animate('slow', function() {



      $('#info').css('display', 'none');
			$('#infoS').removeClass('active');
      $('#infoS').addClass('completed');
      $('#packageS').removeClass('disabled');
			$('#packageS').addClass('active');
      $("#package").transition('fly right');
      $('body').css('background-color', '#06000a');



    });

  });


//package

  $('.prev1').one('click', function(e) {



		  e.preventDefault();


    $('#infoS').removeClass('completed');
		$('#infoS').addClass('active');
    $('#packageS').addClass('disabled');
		$('#packageS').removeClass('active');

    $('#package').animate('slow', function() {

      $('body').css('background-color', '#300032');
      $('#package').transition('hide');
      $("#info").transition('fly right');

    });
  });





  $('.next2').one('click', function(m) {

    m.preventDefault();

    $('#packageS').addClass('completed');
		$('#packageS').removeClass('active');
    $('#menuS').removeClass('disabled');
		$('#menuS').addClass('active');

    $('#menu').animate('slow', function() {

      $('#package').transition('hide');
      $('body').css('background-color', '#251605');
      $('#menu').transition('fly right');
    });

  });


//menu




  $('.prev2').one('click', function(e) {



      e.preventDefault();


    $('#packageS').removeClass('completed');
    $('#packageS').addClass('active');
    $('#menuS').addClass('disabled');
    $('#menuS').removeClass('active');

    $('#menu').animate('slow', function() {

      $('body').css('background-color', '#300032');
      $('#menu').transition('hide');
      $("#package").transition('fly right');

    });
  });





  $('.next3').one('click', function(m) {

    m.preventDefault();

    $('#menuS').addClass('completed');
    $('#menuS').removeClass('active');
    $('#equipS').removeClass('disabled');
    $('#equipS').addClass('active');

    $('#equipS').animate('slow', function() {

      
      $('body').css('background-color', '#251605');
      $('#menu').transition('hide');
      $('#equip').transition('fly right');
    });

  });


//equipment

  $('.prev3').one('click', function(e) {



      e.preventDefault();


    $('#menuS').removeClass('completed');
    $('#menuS').addClass('active');
    $('#equipS').addClass('disabled');
    $('#equipS').removeClass('active');

    $('#equip').animate('slow', function() {

      $('body').css('background-color', '#300032');
      $('#equip').transition('hide');
      $("#menu").transition('fly right');

    });
  });





  $('.next4').one('click', function(m) {

    m.preventDefault();

    $('#equipS').addClass('completed');
    $('#equipS').removeClass('active');
    $('#billS').removeClass('disabled');
    $('#billS').addClass('active');

    $('#bill').animate('slow', function() {


      $('body').css('background-color', '#251605');
      $('#equip').transition('hide');
      $('#bill').transition('fly right');
    });

  });





//billing

  $('.prev4').one('click', function(m) {

    m.preventDefault();

    $('#equipS').removeClass('completed');
    $('#equipS').addClass('active');
    $('#billS').addClass('disabled');
    $('#billS').removeClass('active');

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
		$('#packageS').addClass('completed');
    $('#billS').addClass('completed');
  });


  $('#eventManagement').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblevent').DataTable();


});


</script>
@endsection
