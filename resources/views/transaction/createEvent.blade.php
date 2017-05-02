@extends('layouts.admin')

@section('title')
  Create Event
@endsection

@section('content')
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
  <div class="step" id="stepConfirmOrder">
    <i class="info icon"></i>
    <div class="content">
      <div class="title">Confirm Order</div>
      <div class="description">Verify order details</div>
    </div>
  </div>
</div>

<div class="ui attached segment" id="eventDetail">
  {!! Form::open(['url' => '/eventManagement/saveEvent', 'class' => 'ui form']) !!}
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
          {{ Form::select('eventType[]', $eventTypes, null, ['placeholder' => 'Choose Event Type', 'class' => 'ui multiple search dropdown', 'multiple' => '']) }}
        </div>
        <div class="required field">
          {{ Form::label('decor', 'Decor') }}
          {{ Form::select('decor[]', $decors, null, ['placeholder' => 'Choose Decor', 'class' => 'ui multiple search dropdown', 'multiple' => '']) }}
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
    <button id="nextEventDetail" class="ui fluid teal button" type="button">Next</button>
  </div>
</div>

<div class="ui attached segment" id="orderMenu">
  <div class="ui horizontal divider">Catering Package</div>
  <div class="ui grid">
    @foreach($cateringPackages as $cateringPackage)
    <div class="four wide column">
      <div class="ui green segment">
        <div class="ui checkbox">
          <input type="checkbox" name="package" class="package" value="{{$cateringPackage->cateringPackageCode}}" data-name="{{$cateringPackage->cateringPackageName}}" data-amount="{{$cateringPackage->amount}}">
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
          <input type="checkbox" name="menu" class="menu" value="{{$menu->menuCode}}" data-name="{{$menu->menuName}}" data-select="{{$menu->menuCode}}">
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
        <select class="ui dropdown" id="{{$menu->menuCode}}">
          @foreach($menu->rates as $menuRate)
          <option value="{{$menuRate->menuRateCode}}" data-amount="{{$menuRate->amount}}" data-pax="{{$menuRate->pax}}" data-serving="{{$menuRate->servingType == '1' ? 'Buffet' : 'Set'}}">Php {{$menuRate->amount}}/{{$menuRate->pax}} pax/{{$menuRate->servingType == '1' ? 'Buffet' : 'Set'}}</option>
          @endforeach
        </select>
      </div>
    </div>
    @endforeach
  </div>
  <br><br>
  <div class="actions">
  <div class="two ui buttons">
    <button id="prevOrderMenu" class="ui fluid orange button" type="button">Previous</button>
    <button id="nextOrderMenu" class="ui fluid teal button" type="button">Next</button>
  </div>
  </div>
</div>

<div class="ui attached segment" id="confirmOrder">
  <table class="ui table" id="tblMenu">
    <thead>
      <th>Menu</th>
      <th>Number of Pax</th>
      <th>Serving Type</th>
      <th>Amount</th>
    </thead>
    <tbody>
      
    </tbody>
  </table>
  <div class="two ui buttons">
    <button id="prevConfirmOrder" type="button" class="ui fluid orange button">Previous</button>
    <button id="submitall" type="submit" class="ui fluid teal button">Submit</button>
  </div>
</div>

<div class="ui attached segment" id="segmentSubtotal">
  <h2>SUBTOTAL:</h2>
  <h3 id="subtotal"></h3>
</div>
{!! Form::close() !!}
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

    $('#segmentSubtotal').hide();

    $('#stepCreateOrder').addClass('disabled');
    $('#stepConfirmOrder').addClass('disabled');

    $('button#nextEventDetail').on('click', function(){
      $('#stepEventDetail').addClass('completed');
      $('#stepEventDetail').removeClass('active');
      $('#stepCreateOrder').addClass('active');
      $('#stepCreateOrder').removeClass('disabled');
      $('#segmentSubtotal').show();

      $('#eventDetail').transition('fly right');
      $('#orderMenu').transition('fly right');
    });

    $('button#prevOrderMenu').on('click', function(){
      $('#stepEventDetail').removeClass('completed');
      $('#stepEventDetail').addClass('active');
      $('#stepCreateOrder').removeClass('active');
      $('#stepCreateOrder').addClass('disabled');

      $('#segmentSubtotal').hide();
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


    var subtotal = 0;

    $('.menu').on('change', function(){
      var menuName = $(this).data("name");
      var selectId = $(this).data("select");
      var amount = $('#' + selectId.toString()).find(':selected').data('amount');
      var pax = $('#' + selectId.toString()).find(':selected').data('pax');
      var servingType = $('#' + selectId.toString()).find(':selected').data('serving');
      var menuCode = $(this).val();

      console.log(menuName + '-' + amount);

      if ($(this).is(":checked")){
        subtotal += ($.isNumeric(amount)) ? parseFloat(amount) : 0;
        console.log("subtotal: " + subtotal);

        alert($('select#'+selectId.toString()).val());
        $('#' + selectId.toString()).attr('readonly', 'true');

        $("#tblMenu").find('tbody')
          .append($('<tr>')
            .attr('id', menuCode)
            .append($('<td>')
              .append("<p>" + menuName + "</p>")
              ).append($('<td>')
              .append("<p>" + pax + "</p>")
              ).append($('<td>')
              .append("<p>" + servingType + "</p>")
              ).append($('<td>')
              .append("<p>Php " + amount + "</p>")
              ));
      }else{
        subtotal -= ($.isNumeric(amount)) ? parseFloat(amount) : 0;
        console.log("subtotal: " + subtotal);
        $('tr#' + menuCode).remove();
      }

      $('#subtotal').html("Php " + subtotal);
    });

  });
</script>
@endsection