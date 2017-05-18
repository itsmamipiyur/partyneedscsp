@extends('layouts.admin')

@section('title')
  Create Event Booking
@endsection

@section('content')
<h1>Create Event Booking</h1>
<form class="ui form" action="/eventBooking/create/newCustomer" method="post">
  {{ csrf_field() }}
  <div class="ui raised segment">
    <h4 class="ui dividing header">Customer Information</h4>
    <div class="required field">
      <label>Name</label>
      <div class="three fields">
        <div class="required field">
          <input type="text" placeholder="First Name" name="first_name">
        </div>
        <div class="field">
          <input type="text" placeholder="Middle Name" name="middle_name">
        </div>
        <div class="required field">
          <input type="text" placeholder="Last Name" name="last_name">
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="required field">
        <label>Billing Address</label>
        <textarea rows="2" placeholder="Type Billing Address" name="billing_address"></textarea>
      </div>
      <div class="required field">
        <label>Contact Number</label>
        <input type="text" placeholder="Type Contact Number" name="contact_no">
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
  $('select.dropdown').dropdown();
</script>
@endsection