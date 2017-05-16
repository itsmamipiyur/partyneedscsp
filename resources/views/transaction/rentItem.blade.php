@extends('layouts.admin')

@section('title')
  Create Rental
@endsection

@section('content')
<h1>Rent Item</h1>
@if(Session::has('custCode'))
  <h4>Customer: {{ $customer->customerFirst }} {{ $customer->customerMiddle }} {{ $customer->customerLast }}</h4>
@endif
<div class="ui grid">
  <div class="ten wide column">
    <div class="row">
      <div class="ui raised segment">
        <h4 class="ui dividing header">Rent Item Lists</h4>
        <div class="ui three raised cards">
          @foreach($items as $item)
          @if( ((count($item->rates()->day()) > 0) || (count($item->rates()->hour()) > 0))) 
          <div class="card">
            <div class="content">
              <div class="header">{{ $item->itemName }}</div>
              <div class="meta">
                @if(count($item->rates()->day()) > 0) 
                <strong>Day</strong> - Php {{ $item->rates()->latestDay()->amount }}/duration <br>
                @endif
                @if(count($item->rates()->hour()) > 0) 
                <strong>Hour</strong> - Php {{ $item->rates()->latestHour()->amount }}/duration
                @endif
              </div>
              <div class="description">
                {{ $item->itemDesc }}<br><br>
              </div>
            </div>
            <div class="extra content">
              <button class="ui green inverted fluid button" onclick="$('#item{{ $item->itemCode }}').modal('show')">Add to Tray</button>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>


    
    <div class="row">
      <div class="ui raised segment">
        <h4 class="ui dividing header">Avail Rental Package</h4>
        <div class="ui three raised cards">
          @foreach($rentalPackages as $package)
          <div class="card">
            <div class="content">
              <div class="header">{{ $package->rentalPackageName }}</div>
              <div class="meta">
                <strong>Duration:</strong> {{ $package->rentalPackageDuration }}<br>
                <strong>Amount:</strong> Php {{ $package->rentalPackageAmount }}
              </div>
              <div class="description">
                {{ $package->rentalPackageDesc }}
              </div>
            </div>
            <div class="extra content">
              <button class="ui green inverted fluid button" onclick="$('#package{{ $package->rentalPackageCode }}').modal('show')">Add to Tray</button>
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
        <h4 class="ui dividing header">Your Items</h4>
        <table class="ui table">
          <thead>
            <th>Qty</th>
            <th>Unit Type</th>
            <th>Duration</th>
            <th>Item</th>
            <th>Amount</th>
            <th>Subtotal</th>
          </thead>
          <tbody>
            @foreach(Cart::instance('order')->content() as $row)
            <tr>
              <td>{{ $row->qty }}</td>
              <td>{{ ($row->options->unitType == 1) ? 'Day' : 'Hour' }}</td>
              <td>{{ $row->duration }}</td>
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
    <a class="ui green button" id="proceed_btn" href="/rentalBooking/create/rentalDetail">Proceed</a>
  </div>
</div>

<!--modal-->
@foreach($items as $item)
@if( (count($item->rates()->day()) > 0) || (count($item->rates()->hour()) > 0) ) 
<div class="ui modal" id="item{{ $item->itemCode }}">
  <div class="header">Add to Cart {{ $item->itemName }}</div>
  <div class="content">
    <div class="ui grid">
      <div class="six wide column">
        <form class="ui form" action="/rentalBooking/create/addToTray" method="post">
          {{ csrf_field() }}
          <div class="two fields">
            <input type="hidden" name="itemCode" value="{{ $item->itemCode }}">
            <input type="number" min="0" placeholder="Qty" name="qty">
            <select class="ui fluid dropdown" name="rate">
              <option value="">Choose Unit Type</option>
              @if(count($item->rates()->day()) > 0) 
              <option value="{{ $item->rates()->latestDay()->itemRateCode }}">Day - Php {{ $item->rates()->latestDay()->amount }}/duration</option>
              @endif
              @if(count($item->rates()->hour()) > 0) 
              <option value="{{ $item->rates()->latestHour()->itemRateCode }}">Hour - Php {{ $item->rates()->latestHour()->amount }}/duration</option>
              @endif
            </select>
            <input type="number" min="0" placeholder="Duration" name="duration">
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

@foreach($rentalPackages as $package)
<div class="ui modal" id="package{{ $package->rentalPackageCode }}">
  <div class="header">Add to Cart {{ $package->rentalPackageName }}</div>
  <div class="content">
    <div class="ui grid">
      <div class="ten wide column">
        <div class="ui horizontal divider">Items</div>
        <ul>
          @foreach($package->items as $item)
          <li>{{$item->itemName}} - {{ $item->pivot->quantity }} pcs</li>
          @endforeach
        </ul>
      </div>
      <div class="six wide column">
        <form class="ui form" action="/rentalBooking/create/addPackageToTray" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="packageCode" value="{{ $package->rentalPackageCode }}">
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