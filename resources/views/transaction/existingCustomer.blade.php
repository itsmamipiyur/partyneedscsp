@extends('layouts.admin')

@section('title')
  Create Event Booking
@endsection

@section('content')
<h1>Create Event Booking</h1>
<form class="ui form" action="/eventBooking/create/existingCustomer" method="post">
  {{ csrf_field() }}
  <div class="ui raised segment">
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
  <div class="ui error message"></div>
    <h4 class="ui dividing header">Customer Information</h4>
    <div class="required field">
      <label>Name</label>
      <div class="required field">
        <select class="ui fluid search dropdown" name="customer_code">
          <option value="">Search Customer...</option>
          @foreach($customers as $customer)
          <option value="{{ $customer->customerCode }}">{{ $customer->customerFirst }} {{ $customer->customerMiddle }} {{ $customer->customerLast }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <input type="hidden" name="event_code" value="{{ $event_code }}">
  <div class="ui raised segment">
    <h4 class="ui dividing header">Event Information</h4>
    <div class="required field">
      <label>Event Title</label>
      <input type="text" placeholder="Type Event Title" name="event_title">
    </div>
    <div class="two fields">
      <div class="required field">
        <label>Event Start</label>
        <input type="datetime-local" name="event_start" min="{{ Carbon\Carbon::today()->format('Y-m-d h:m:s') }}">
      </div>
      <div class="required field">
        <label>Event End</label>
        <input type="datetime-local" name="event_end">
      </div>
    </div>
    <div class="two fields">
      <div class="required field">
        <label>Event Type</label>
        <select class="ui fluid dropdown" multiple="" name="event_types[]">
          <option value="">Select Event Type...</option>
          @foreach($types as $type)
          <option value="{{ $type->eventTypeCode }}">{{ $type->eventTypeName }}</option>
          @endforeach
        </select>
      </div>
      <div class="required field">
        <label>Decor</label>
        <select class="ui fluid dropdown" multiple="" name="event_decors[]">
          <option value="">Select Decor...</option>
          @foreach($decors as $decor)
          <option value="{{ $decor->decorCode }}">{{ $decor->decorName }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="required field">
      <label>Event Address</label>
      <textarea rows="2" placeholder="Type Event Address" name="event_address"></textarea>
    </div>
    <div class="required field">
      <label>Delivery Area</label>
      <select class="ui fluid dropdown" name="event_delivery">
        <option value="">Select Delivery Area</option>
        @foreach($deliveries as $delivery)
        <option value="{{ $delivery->deliveryCode }}">{{ $delivery->deliveryLocation }}</option>
        @endforeach
      </select>
    </div>
    <input type="submit" value="Submit" class="ui green button">
  </div>
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