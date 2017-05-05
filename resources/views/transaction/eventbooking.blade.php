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
    <th>Event Date</th>
    <th>Status</th>
    <th>Actions</th>
  </thead>
  <tbody>
    <td>EVNT012934</td>
    <td>Ellen deGeneres Day</td>
    <td>Ellen deGeneres</td>
    <td>December 20, 2012 11:59</td>
    <td>Going</td>
    <td><br></td>
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