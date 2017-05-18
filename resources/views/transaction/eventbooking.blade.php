@extends('layouts.admin')

@section('title')
  Event Booking
@endsection

@section('content')

<h1>Event Management</h1>
<div class="ui divider"></div>
<div class="row">
  <a class="ui green button" id="btnBookEvent"><i class="add icon"></i> Book Event</a>
</div>

<table class="ui striped celled table">
  <thead>
    <th>Event Code</th>
    <th>Event Title</th>
    <th>Customer Name</th>
    <th>Event Start</th>
    <th>Event End</th>
    <th>Status</th>
    <th>Actions</th>
  </thead>
  <tbody>
    @foreach($events as $event)
    <tr>
      <td>{{ $event->eventCode }}</td>
      <td>{{ $event->eventTitle }}</td>
      <td>{{ $event->customer->customerFirst }} {{ $event->customer->customerMiddle }} {{ $event->customer->customerLast }}</td>
      <td>{{ Carbon\Carbon::parse($event->eventStart)->format('d F Y h:m A') }}</td>
      <td>{{ Carbon\Carbon::parse($event->eventEnd)->format('d F Y h:m A') }}</td>
      <td>Going</td>
      <td><a href="/eventBooking/{{$event->eventCode}}" class="ui small blue button">View</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="ui basic modal">
  <div class="header" style="text-align: center;"><h1>Book Event</h1></div>
  <div class="content">
    <div class="ui center aligned clearing segment">
      <div class="ui large buttons">
        <a class="ui green button" href="/eventBooking/create/newCustomer">New Customer</a>
        <div class="or"></div>
        <a class="ui blue button">Existing Customer</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $('#btnBookEvent').on('click', function(){
    $('.ui.basic.modal').modal('show').modal({
      blurring: true
    });
  });
</script>
@endsection