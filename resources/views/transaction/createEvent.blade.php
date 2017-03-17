@extends('layouts.admin')

@section('title')
  Create Event
@endsection

@section('content')

<div class="ui three top attached steps">
  <div class="active step" id="stepEventDetail">
    <i class="calendar outline icon"></i>
    <div class="content">
      <div class="title">Event Information</div>
      <div class="description">Fill Up Customer and Event Information</div>
    </div>
  </div>
  <div class="step" id="stepCreateOrder">
    <i class="edit icon"></i>
    <div class="content">
      <div class="title">Create Menu Order</div>
      <div class="description">Choose Event Menu</div>
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
      <div class="ui horizontal divider">Event Details</div>
      <div class="required field">
        {{ Form::label('eventTitle', 'Event Title') }}
        {{ Form::text('eventTitle', null, ['placeholder' => 'Event Title']) }}  
      </div>
      <div class="two fields">
        <div class="required field">
          {{ Form::label('eventStart', 'Event Start') }}
          {{ Form::text('eventStart', null, ['placeholder' => 'Event Start']) }}
        </div>
        <div class="required field">
          {{ Form::label('eventEnd', 'Event End') }}
          {{ Form::text('eventEnd', null, ['placeholder' => 'Event End']) }}
        </div>
      </div>
      <div class="two fields">
        <div class="required field">
          {{ Form::label('eventAddress', 'Event Address') }}
          {{ Form::textarea('eventAddress', null, ['placeholder' => 'Event Address', 'rows' => '2']) }}
        </div>
        <div class="required field">
          {{ Form::label('eventDesc', 'Event Description') }}
          {{ Form::textarea('eventDesc', null, ['placeholder' => 'Event Description', 'rows' => '2']) }}
        </div>
      </div>
      <div class="two fields">
        <div class="required field">
          {{ Form::label('eventType', 'Event Type') }}
          {{ Form::select('eventType', $eventTypes, null, ['placeholder' => 'Choose Event Type', 'class' => 'ui multiple search dropdown', 'multiple' => '']) }}
        </div>
        <div class="required field">
          {{ Form::label('decor', 'Decor') }}
          {{ Form::select('decor', $decors, null, ['placeholder' => 'Choose Decor', 'class' => 'ui multiple search dropdown', 'multiple' => '']) }}
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
  <div class="ui horizontal divider">Catering Package</div>
  <div class="ui grid">
    @foreach($cateringPackages as $cateringPackage)
    <div class="four wide column">
      <div class="ui green segment">
        <div class="ui checkbox">
          <input type="checkbox" name="package" class="package" value="{{$cateringPackage->cateringPackageCode}}">
          <input type="hidden" name="price" id="packagePrice[{{$cateringPackage->cateringPackageCode}}]" value="{{$cateringPackage->cateringPackageAmount}}">
          <input type="hidden" name="name" id="packageName[{{$cateringPackage->cateringPackageName}}]" value="{{$cateringPackage->cateringPackageName}}">
          <label><h4>{{$cateringPackage->cateringPackageName}}</h4>PhP {{$cateringPackage->cateringPackageAmount}}</label>
        </div>
        <div class="ui divider"></div>
        <p><b>Menu</b></p>
        <ul class="ui list">
          @foreach($cateringPackage->menus as $menu)
          <li><strong>{{$menu->menuName}}</strong> - {{$menu->pivot->pax}} pax</li>
          @endforeach
        </ul>
        <div class="ui divider"></div>
        <p><b>Item</b></p>
        <ul class="ui list">
          @foreach($cateringPackage->items as $item)
          <li><strong>{{$item->itemName}}</strong> - {{$item->pivot->quantity}}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endforeach
  </div>
  <div class="ui horizontal divider">Menu</div>
  <div class="ui grid">
    @foreach($menus as $menu)
    <div class="four wide column">
      <div class="ui blue segment">
        <div class="ui checkbox">
          <input type="checkbox" name="example" value="{{$menu->menuCode}}">
          <label><h4>{{$menu->menuName}}</h4></label>
        </div>
        <div class="ui divider"></div>
        <p><b>Dishes</b></p>
        <ul class="ui list">
          @foreach($menu->dishes as $menuDish)
          <li><strong>{{$menuDish->dishName}}</strong> - {{$menuDish->dishType->dishTypeName}}</li>
          @endforeach
        </ul>
        <div class="ui divider"></div>
        <p><b>Rates</b></p>
        <select class="ui dropdown">
          @foreach($menu->rates as $menuRate)
          <option value="{{$menuRate->menuRateCode}}">Php {{$menuRate->amount}}/{{$menuRate->pax}} pax/{{$menuRate->servingType == '1' ? 'Buffet' : 'Set'}}</option>
          @endforeach
        </select>
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
      <th>Catering Package</th>
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

    $('#eventStart').datetimepicker();
    $('#eventEnd').datetimepicker();

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