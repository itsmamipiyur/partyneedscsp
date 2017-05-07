@extends('layouts.admin')

@section('title')
  Create Event
@endsection

@section('content')
<h1>Order Food</h1>
@if(Session::has('custCode'))
  <h4>Customer: {{ $customer->customerFirst }} {{ $customer->customerMiddle }} {{ $customer->customerLast }}</h4>
@endif
<div class="ui grid">
  <div class="ten wide column">
    <div class="row">
      <div class="ui raised segment">
        <h4 class="ui dividing header">Order Food Menu</h4>
        <div class="ui three raised cards">
          @foreach($menus as $menu)
          @if( ((count($menu->rates()->buffet()) > 0) || (count($menu->rates()->set()) > 0))) 
          <div class="card">
            <div class="content">
              <div class="header">{{ $menu->menuName }}</div>
              <div class="meta">
                @if(count($menu->rates()->buffet()) > 0) 
                <strong>Buffet</strong> - Php {{ $menu->rates()->latestBuffet()->amount }}/pax <br>
                @endif
                @if(count($menu->rates()->set()) > 0) 
                <strong>Set</strong> - Php {{ $menu->rates()->latestSet()->amount }}/pax
                @endif
              </div>
              <div class="description">
                {{ $menu->menuDesc }}<br><br>
              </div>
            </div>
            <div class="extra content">
              <button class="ui green inverted fluid button" onclick="$('#menu{{ $menu->menuCode }}').modal('show')">Add to Tray</button>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>
    <div class="row">
      <div class="ui raised segment">
        <h4 class="ui dividing header">Avail Catering Package</h4>
        <div class="ui three raised cards">
          @foreach($cateringPackages as $package)
          <div class="card">
            <div class="content">
              <div class="header">{{ $package->cateringPackageName }}</div>
              <div class="meta">
                <strong>Capacity:</strong> {{ $package->cateringPackagePax }} pax <br>
                <strong>Amount:</strong> Php {{ $package->cateringPackageAmount }}
              </div>
              <div class="description">
                {{ $package->cateringPackageDesc }}
              </div>
            </div>
            <div class="extra content">
              <button class="ui green inverted fluid button" onclick="$('#package{{ $package->cateringPackageCode }}').modal('show')">Add to Tray</button>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="six wide column">
    <div class="row">
      <div class="ui segment">
        <h4 class="ui dividing header">Your Food Order</h4>
        <table class="ui table">
          <thead>
            <th>Qty</th>
            <th>Menu Type</th>
            <th>Menu</th>
            <th>Amount</th>
            <th>Subtotal</th>
          </thead>
          <tbody>
            @foreach(Cart::instance('order')->content() as $row)
            <tr>
              <td>{{ $row->qty }}</td>
              <td>{{ ($row->options->servingType == 1) ? 'Buffet' : 'Set' }}</td>
              <td>{{ $row->name }}</td>
              <td>Php {{ $row->price }}</td>
              <td>Php {{ $row->subtotal }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3" class="right aligned"><strong>Total</strong></td>
              <td colspan="2" class="right aligned">Php {{ Cart::instance('order')->subtotal() }}</td>
            </tr>
            <tr>
              <th colspan="3" class="right aligned"><strong>Total No. of Pax</strong></td>
              <td colspan="2" class="right aligned">{{ Cart::instance('order')->count() }} pax</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="ui segment">
        <h4 class="ui dividing header">Your Catering Package Order</h4>
        <table class="ui table">
          <thead>
            <th>Qty</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Subtotal</th>
          </thead>
          <tbody>
            @foreach(Cart::instance('package')->content() as $row)
            <tr>
              <td>{{ $row->qty }}</td>
              <td>{{ $row->name }}</td>
              <td>Php {{ $row->price }}</td>
              <td>Php {{ $row->subtotal }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3" class="right aligned"><strong>Total</strong></td>
              <td colspan="2" class="right aligned">Php {{ Cart::instance('package')->subtotal() }}</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="ui red segment">
        <h3><strong>Total:</strong> Php {{ Cart::subtotal() }}</h3>
      </div>
    </div>
    <a class="ui green button" id="proceed_btn" href="/eventBooking/create/eventDetail">Proceed</a>
  </div>
</div>

<!--modal-->
@foreach($menus as $menu)
@if( (count($menu->rates()->buffet()) > 0) || (count($menu->rates()->set()) > 0) ) 
<div class="ui modal" id="menu{{ $menu->menuCode }}">
  <div class="header">Add to Cart {{ $menu->menuName }}</div>
  <div class="content">
    <div class="ui grid">
    <div class="ten wide column">
        <div class="ui horizontal divider">Dishes</div>
        <ul>
          @foreach($menu->dishes as $dish)
          <li><b>{{ $dish->dishName }}</b> - {{ $dish->dishType->dishTypeName }}</li>
          @endforeach
        </ul>
      </div>
      <div class="six wide column">
        <form class="ui form" action="/eventBooking/create/addToTray" method="post">
          {{ csrf_field() }}
          <div class="two fields">
            <input type="hidden" name="menuCode" value="{{ $menu->menuCode }}">
            <input type="number" min="0" placeholder="No. of Pax" name="no_pax">
            <select class="ui fluid dropdown" name="rate">
              <option value="">Choose Menu Type</option>
              @if(count($menu->rates()->buffet()) > 0) 
              <option value="{{ $menu->rates()->latestBuffet()->menuRateCode }}">Buffet - Php {{ $menu->rates()->latestBuffet()->amount }}/pax</option>
              @endif
              @if(count($menu->rates()->set()) > 0) 
              <option value="{{ $menu->rates()->latestSet()->menuRateCode }}">Set - Php {{ $menu->rates()->latestSet()->amount }}/pax</option>
              @endif
            </select>
          </div>
          <button type="submit" class="ui green button right aligned">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endif
@endforeach

@foreach($cateringPackages as $package)
<div class="ui modal" id="package{{ $package->cateringPackageCode }}">
  <div class="header">Add to Cart {{ $package->cateringPackageName }}</div>
  <div class="content">
    <div class="ui grid">
      <div class="ten wide column">
        <div class="ui horizontal divider">Menu</div>
        <ul>
          @foreach($package->menus as $menu)
          <li>{{$menu->menuName}}</li>
          @endforeach
        </ul>
        <div class="ui horizontal divider">Items</div>
        <ul>
          @foreach($package->items as $item)
          <li>{{$item->itemName}} - {{ $item->pivot->quantity }} - {{$item->pivot->duration}} hr</li>
          @endforeach
        </ul>
      </div>
      <div class="six wide column">
        <form class="ui form" action="/eventBooking/create/addPackageToTray" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="packageCode" value="{{ $package->cateringPackageCode }}">
          <button type="submit" class="ui green button right aligned">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endforeach

@endsection

@section('js')
<script type="text/javascript">
  $('select.dropdown').dropdown();

  $('document').ready(function(){
    // var pax = $('#pax').val();

    // if(pax >= 50){
    //   $('#proceed_btn').removeClass('disabled');
    // }else{
    //   $('#proceed_btn').addClass('disabled');
    // }
  });
</script>
@endsection