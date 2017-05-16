@extends('layouts.admin')

@section('title')
  Rent Equipment
@endsection

@section('content')

<h1>Rental Management</h1>
<div class="ui divider"></div>
<div class="row">
  <a class="ui green button" id="btnRentEquipment"><i class="add icon"></i>Rent Equipment</a>
</div>

<table class="ui striped celled table">
  <thead>
    <th>Rental Code</th>
    <th>Rental Title</th>
    <th>Customer Name</th>
    <th>Rent Date</th>
    <th>Status</th>
    <th>Actions</th>
  </thead>
  <tbody>
    <td>RNT0001</td>
    <td>MCatering</td>
    <td>Marlou Arizala</td>
    <td>December 25, 2018 11:59 PM</td>
    <td>Paid</td>
    <td><br></td>
  </tbody>
</table>

<div class="ui basic modal">
  <div class="header" style="text-align: center;"><h1>Rent Equipment</h1></div>
  <div class="content">
    <div class="ui center aligned clearing segment">
      <div class="ui large buttons">
        <a class="ui green button" href="/rentalBooking/create/newCustomer">New Customer</a>
        <div class="or"></div>
        <a class="ui blue button">Existing Customer</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $('#btnRentEquipment').on('click', function(){
    $('.ui.basic.modal').modal('show').modal({
      blurring: true
    });
  });
</script>
@endsection