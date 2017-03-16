@extends('layouts.admin')

@section('title')
  Create Rental
@endsection

@section('content')

<div class="ui three top attached steps">
  <div class="active step" id="stepEventDetail">
    <i class="calendar outline icon"></i>
    <div class="content">
      <div class="title">Rental Information</div>
      <div class="description">Fill Up Customer and Rental Information</div>
    </div>
  </div>
  <div class="step" id="stepCreateOrder">
    <i class="edit icon"></i>
    <div class="content">
      <div class="title">Create Rental Order</div>
      <div class="description">Choose Rental Equipment</div>
    </div>
  </div>
  <!-- <div class="step" id="stepConfirmOrder">
    <i class="info icon"></i>
    <div class="content">
      <div class="title">Confirm Order</div>
      <div class="description">Verify order details</div>
    </div>
  </div> -->
</div>

<div class="ui attached segment" id="eventDetail">
  <div class="ui form">
    <div class="content">
      <div class="ui horizontal divider">Customer Information</div>
      <div class="three fields">
        <div class="required field">
          {{ Form::label('firstName', 'First Name') }}
          {{ Form::text('firstName', null, ['placeholder' => 'First Name']) }}
        </div>
        <div class="field">
          {{ Form::label('middleName', 'Middle Name') }}
          {{ Form::text('middleName', null, ['placeholder' => 'Middle Name']) }}
        </div>
        <div class="required field">
          {{ Form::label('lastName', 'Last Name') }}
          {{ Form::text('lastName', null, ['placeholder' => 'Last Name']) }}
        </div>
      </div>
      <div class="two fields">
        <div class="required field">
          {{ Form::label('contactNumber', 'Contact Number') }}
          {{ Form::text('contactNumber', null, ['placeholder' => 'Contact Number']) }}
        </div>
        <div class="required field">
          {{ Form::label('billingAddress', 'Billing Address') }}
          {{ Form::textarea('billingAddress', null, ['placeholder' => 'Billing Address', 'rows' => '2']) }}
        </div>
      </div>
      <div class="ui horizontal divider">Rental Details</div>
      <div class="two fields">
        <div class="required field">
          {{ Form::label('rentStart', 'Rent Start') }}
          {{ Form::text('rentStart', null, ['placeholder' => 'Rent Start']) }}
        </div>
        <div class="required field">
          {{ Form::label('rentEnd', 'Rent End') }}
          {{ Form::text('rentEnd', null, ['placeholder' => 'Rent End']) }}
        </div>
      </div>
      <div class="two fields">
        <div class="required field">
          {{ Form::label('rentAddress', 'Rent Address') }}
          {{ Form::textarea('rentAddress', null, ['placeholder' => 'Rent Address', 'rows' => '2']) }}
        </div>
        <div class="required field">
          {{ Form::label('rentDesc', 'Rent Description') }}
          {{ Form::textarea('rentDesc', null, ['placeholder' => 'Rent Description', 'rows' => '2']) }}
        </div>
      </div>
      <div class="required field">
        {{ Form::label('deliveryCode', 'Delivery Area') }}
        {{ Form::select('deliveryCode', $deliveries, null, ['placeholder' => 'Choose Delivery Area', 'class' => 'ui search dropdown']) }}
      </div>
    </div>
  </div>
  <br><br>
  <div class="actions">
    <button id="nextEventDetail" class="ui fluid teal button">Next</button>
  </div>
</div>

<div class="ui attached segment" id="orderMenu">
  <div class="ui horizontal divider">Rental Package</div>
  <div class="ui grid">
    @foreach($rentalPackages as $rentalPackage)
    <div class="four wide column">
      <div class="ui green segment">
        <div class="ui checkbox">
          <input type="checkbox" name="package" class="package" value="{{$rentalPackage->rentalPackageCode}}">
          <input type="hidden" name="price" id="packagePrice[{{$rentalPackage->rentalPackageCode}}]" value="{{$rentalPackage->rentalPackageAmount}}">
          <input type="hidden" name="name" id="packageName[{{$rentalPackage->rentalPackageName}}]" value="{{$rentalPackage->rentalPackageName}}">
          <label><h4>{{$rentalPackage->rentalPackageName}}</h4>PhP {{$rentalPackage->rentalPackageAmount}}</label>
        </div>
      <div class="ui divider"></div>
        <p><b>Item</b></p>
        <ul class="ui list">
          @foreach($rentalPackage->items as $item)
          <li><strong>{{$item->itemName}}</strong> - {{$item->pivot->quantity}}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endforeach
  </div>

  <br><br>
  <div class="actions">
  <div class="two ui buttons">
    <button id="prevOrderMenu" class="ui fluid orange button">Previous</button>
    <button id="nextOrderMenu" class="ui fluid teal button">Next</button>
  </div>
  </div>
</div>

<div class="ui attached segment" id="confirmOrder">
  <table class="ui table" id="tblPackage">
    <thead>
      <th>Rental Package</th>
      <th>Amount</th>
    </thead>
    <tbody>
      
    </tbody>
  </table>
  <div class="two ui buttons">
    <button id="prevConfirmOrder" class="ui fluid orange button">Previous</button>
    <button id="submitall" class="ui fluid teal button">Submit</button>
  </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
  $('document').ready(function(){
    var currentDate = new Date();

    $('.ui.dropdown').dropdown();

    $('#orderMenu').transition();
    $('#confirmOrder').transition();

    $('#rentStart').datetimepicker();
    $('#rentEnd').datetimepicker();

    $('#stepCreateOrder').addClass('disabled');
    $('#stepConfirmOrder').addClass('disabled');

    $('button#nextEventDetail').on('click', function(){
      $('#stepEventDetail').addClass('completed');
      $('#stepEventDetail').removeClass('active');
      $('#stepCreateOrder').addClass('active');
      $('#stepCreateOrder').removeClass('disabled');

      $('#eventDetail').transition('fly right');
      $('#orderMenu').transition('fly right');
    });

    $('button#prevOrderMenu').on('click', function(){
      $('#stepEventDetail').removeClass('completed');
      $('#stepEventDetail').addClass('active');
      $('#stepCreateOrder').removeClass('active');
      $('#stepCreateOrder').addClass('disabled');

      $('#eventDetail').transition('fly left');
      $('#orderMenu').transition('fly left');
    });

    $('button#nextOrderMenu').on('click', function(){
      $('#stepCreateOrder').addClass('completed');
      $('#stepCreateOrder').removeClass('active');
      $('#stepConfirmOrder').addClass('active');
      $('#stepConfirmOrder').removeClass('disabled');

      $('#orderMenu').transition('fly left');
      $('#confirmOrder').transition('fly left');
    });

    $('button#prevConfirmOrder').on('click', function(){
      $('#stepCreateOrder').removeClass('completed');
      $('#stepCreateOrder').addClass('active');
      $('#stepConfirmOrder').removeClass('active');
      $('#stepConfirmOrder').addClass('disabled');

      $('#orderMenu').transition('fly right');
      $('#confirmOrder').transition('fly right');
    });
  });
</script>
@endsection