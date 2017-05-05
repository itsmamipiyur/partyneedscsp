@extends('layouts.admin')

@section('title')
  Create Event
@endsection

@section('content')
<h1>Book Event</h1>
<form class="ui form">
  <div class="ui raised segment">
    <h4 class="ui dividing header">Customer Information</h4>
    <div class="field">
      <label>Name</label>
      <div class="three fields">
        <div class="required field">
          <input type="text" placeholder="First Name">
        </div>
        <div class="field">
          <input type="text" placeholder="Middle Name">
        </div>
        <div class="required field">
          <input type="text" placeholder="Last Name">
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="required field">
        <label>Billing Address</label>
        <textarea rows="2" placeholder="Type Billing Address"></textarea>
      </div>
      <div class="required field">
        <label>Contact Number</label>
        <input type="text" placeholder="Type Contact Number">
      </div>
    </div>
  </div>

  <div class="ui raised segment">
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
        @foreach($deliveries as $delivery)
        <option value="{{ $delivery->deliveryCode }}">{{ $delivery->deliveryLocation }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="ui raised segment">
    <h4 class="ui dividing header">Order Food Menu</h4>
    <div class="ui three raised cards">
      @foreach($menus as $menu)
      @if( (count($menu->rates()->buffet()) > 0) || (count($menu->rates()->set()) > 0) ) 
      <div class="card">
        <div class="content">
          <div class="header">{{ $menu->menuName }}</div>
          <div class="meta">
            {{ $menu->menuDesc }}<br>
          </div>
          <div class="description">
            <ui>
              @foreach($menu->dishes as $dish)
              <li><b>{{ $dish->dishName }}</b> - {{ $dish->dishType->dishTypeName }}</li>
              @endforeach
            </ui>
          </div>
        </div>
        <div class="extra content">
          <div class="two fields">
            <input type="number" min="0" placeholder="No. of Pax">
            <select class="ui fluid dropdown">
              <option value="">Choose Menu Type</option>
              @if(count($menu->rates()->buffet()) > 0) 
              <option value="1">Buffet - Php {{ $menu->rates()->latestBuffet()->amount }}/pax</option>
              @endif
              @if(count($menu->rates()->set()) > 0) 
              <option value="2">Set - Php {{ $menu->rates()->latestSet()->amount }}/pax</option>
              @endif
            </select>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
  $('select.dropdown').dropdown();
</script>
@endsection