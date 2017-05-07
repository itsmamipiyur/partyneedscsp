@extends('layouts.admin')

@section('title')
  Create Event Detail
@endsection

@section('content')
<h1>Create Event Detail</h1>
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
<form class="ui form" action="/eventBooking/process/quotation" method="post">
  {{ csrf_field() }}

  <div class="ui raised segment">
    <h4 class="ui dividing header">Event Information</h4>
    <div class="required field">
      <label>Event Title</label>
      <input type="text" placeholder="Type Event Title" name="event_title">
    </div>
    <div class="two fields">
      <div class="required field">
        <label>Event Start</label>
        <input type="datetime-local" name="event_start">
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
    <input type="submit" value="Make Quotation" class="ui green button">
  </div>
</form> 
@endsection

@section('js')
<script type="text/javascript">
  $('select.dropdown').dropdown();
</script>
@endsection