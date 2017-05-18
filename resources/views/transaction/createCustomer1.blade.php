@extends('layouts.admin')

@section('title')
  Create Customer
@endsection

@section('content')
<h1>Create Customer</h1>
<form class="ui form" action="/rentalBooking/create/newCustomer" method="post">
  {{ csrf_field() }}
  <div class="ui raised segment">
    <h4 class="ui dividing header">Customer Information</h4>
    <div class="field">
      <label>Name</label>
      <div class="three fields">
        <div class="required field">
          <input type="text" placeholder="First Name" name="first_name" id="fname">
        </div>
        <div class="field">
          <input type="text" placeholder="Middle Name" name="middle_name">
        </div>
        <div class="required field">
          <input type="text" placeholder="Last Name" name="last_name" id="fname">
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="required field">
        <label>Billing Address</label>
        <textarea rows="2" placeholder="Type Billing Address" name="billing_address" id="add"></textarea>
      </div>
      <div class="required field">
        <label>Contact Number</label>
        <input type="text" placeholder="Type Contact Number" name="contact_no" id="contact">
      </div>
    </div>
    <div class="ui center aligned buttons">
      <input type="submit" value="Submit" class="ui green button">
    </div>
  </div>

  <!-- <div class="ui raised segment">
    <h4 class="ui dividing header">Event Information</h4>
    <div class="required field">
      <label>Event Title</label>
      <input type="text" placeholder="Type Event Title">
    </div>
    <div class="two fields">
      <div class="required field">
        <label>Event Start</label>
        <input type="datetime-local">
      </div>
      <div class="required field">
        <label>Event End</label>
        <input type="datetime-local">
      </div>
    </div>
    <div class="required field">
      <label>Event Address</label>
      <textarea rows="2" placeholder="Type Event Address"></textarea>
    </div>
    <div class="required field">
      <label>Delivery Area</label>
      <select class="ui fluid dropdown">
        <option value="">Select Delivery Area</option>
      </select>
    </div>
  </div> -->
</form> 
@endsection

@section('js')
<script type="text/javascript">

  var formValidationRules =
  {
    fname: {
      identifier : 'fname',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please enter a name'
      },
      {
          

              type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

            
             
        prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
            }
      ]
    },

    lname: {
      identifier : 'lname',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please enter a Last Name'
      },
      {
          

              type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

            
             
        prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
            }
      ]
    },
    contact: {
      identifier : 'contact',
      rules: [
      {
      type   : "regExp[^[1-9][0-9]*$]",
      prompt : 'Please enter a valid Contact no.'
    },
      {
        type   : 'empty',
        prompt : 'Please enter a Contact no.'
      }

      ]
    },
    add: {
      identifier : 'add',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please enter an Address'
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


  $('select.dropdown').dropdown();
</script>
@endsection