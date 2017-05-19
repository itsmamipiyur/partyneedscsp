@extends('layouts.admin')

@section('title')
  Event Detail
@endsection

@section('content')

<h1>Event Information for {{ $event->eventTitle }}</h1>
<div class="ui divider"></div>
<div class="row"> 
  
</div>
<div class="row"> 
  
</div>

<div class="ui fluid styled accordion">
  <div class="active title">
    <i class="dropdown icon"></i>
    EVENT DETAILS
  </div>
  <div class="active content">
    <table class="ui celled table">
      <tbody>
        <tr>
          <td class="four wide"><strong>Title</strong></td>
          <td>{{ $event->eventTitle }}</td>
        </tr>
        <tr>
          <td class="four wide"><strong>Date Start</strong></td>
          <td>{{ Carbon\Carbon::parse($event->eventStart)->format('d F Y h:m A') }}</td>
        </tr>
        <tr>
          <td class="four wide"><strong>Date End</strong></td>
          <td>{{ Carbon\Carbon::parse($event->eventEnd)->format('d F Y h:m A') }}</td>
        </tr>
        <tr>
          <td class="four wide"><strong>Address</strong></td>
          <td>{{ $event->eventAddress }}</td>
        </tr>
        <tr>
          <td class="four wide"><strong>Delivery Area</strong></td>
          <td>{{ $event->delivery->deliveryLocation }} <em>(Php {{ $event->delivery->deliveryFee }})</em></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="title">
    <i class="dropdown icon"></i>
    CUSTOMER INFORMATION
  </div>
  <div class="content">
    <table class="ui celled table">
      <tbody>
        <tr>
          <td class="four wide"><strong>Name</strong></td>
          <td>{{ $event->customer->customerFirst }} {{ $event->customer->customerMiddle }} {{ $event->customer->customerLast }}</td>
        </tr>
        <tr>
          <td class="four wide"><strong>Address</strong></td>
          <td>{{ $event->customer->customerAddress }}</td>
        </tr>
        <tr>
          <td class="four wide"><strong>Contact Number</strong></td>
          <td>{{ $event->customer->customerContact }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="ui horizontal divider">MENU ORDERS</div>
<a href="/orderFood?evnt={{ $event->eventCode }}" class="ui green button">Add Food Order</a>
<table class="ui celled table">
  <thead>
    <th>Order Number</th>
    <th>Created At</th>
    <th>Menu</th>
    <th class="right aligned">Subtotal</th>
  </thead>
  <tbody>
    @foreach($event->orders as $order)
    <tr>
      <td>{{ $order->eventOrderCode }}</td>
      <td>{{ Carbon\Carbon::parse($order->created_at)->format('d F Y h:m A') }} ({{ $order->created_at->diffForHumans() }})</td>
      <td>
        <ul>
        @foreach($order->menus as $menu)
          <li>{{ $menu->menuName }} - {{ $menu->pivot->pax }} pax - {{ $menu->pivot->servingType == 1 ? 'Buffet' : 'Set' }}</li>
        @endforeach
        </ul>
      </td>
      <td class="right aligned">Php {{ $order->subtotal }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" class="right aligned"><h3>Total Amount:</h3></td>
      <td class="right aligned"><h3>Php {{ $total->amount }}</h3></td>
    </tr>
  </tfoot>
</table>

@endsection

@section('js')
<script type="text/javascript">
  $('ui.acccordion').accordion();
</script>
@endsection