@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="row">
    <h1>Dashboard</h1>
    <hr>
</div>

<div class="row">
    <h3 class="title">OVERVIEW</h3>
    <div class="ui four statistics">
      <div class="statistic">
        <div class="value">
          22
        </div>
        <div class="label">
          Event Bookings
        </div>
      </div>
      <div class="statistic">
        <div class="text value">
          FORTY-TWO<br>
          Thousand
        </div>
        <div class="label">
          Sales
        </div>
      </div>
      <div class="statistic">
        <div class="value">
          <i class="food icon"></i> 57
        </div>
        <div class="label">
          Food Orders
        </div>
      </div>
      <div class="statistic">
        <div class="value">
          <img src="{{asset('img/joe.jpg')}}" class="ui circular inline image">
          42
        </div>
        <div class="label">
          Customers
        </div>
      </div>
    </div>
    <hr>
</div>

<div class="row">
  <div class="ui grid">
    <div class="column">
      <h4>Incoming Events</h4>
      <table class="ui red hover table">
        <thead>
          <th>Event</th>
          <th>Event Date</th>
          <th>Event Time</th>
        </thead>
        <tbody>
          <tr>
            <td>Jose & Joan Wedding</td>
            <td>2017-03-31</td>
            <td>10:00 AM</td>
          </tr>
          <tr>
            <td>Saitama 7th Birthday</td>
            <td>2017-03-18</td>
            <td>3:00 PM</td>
          </tr>
          <tr>
            <td>Manila High School Prom Night</td>
            <td>2017-04-1</td>
            <td>6:00 PM</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready( function(){
    $('#dashboard').addClass("active grey");
  });
</script>
@endsection
