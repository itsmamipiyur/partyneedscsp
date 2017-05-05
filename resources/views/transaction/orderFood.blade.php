@extends('layouts.admin')

@section('title')
  Create Event
@endsection

@section('content')
<h1>Order Food</h1>
<div class="ui grid">
  <div class="ten wide column">
    <div class="ui raised segment">
      <h4 class="ui dividing header">Order Food Menu</h4>
      <div class="ui three raised cards">
        @foreach($menus as $menu)
        @if( (count($menu->rates()->buffet()) > 0) || (count($menu->rates()->set()) > 0) ) 
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
            <button class="ui green inverted fluid button" onclick="$('#menu{{ $menu->menuCode }}').modal('show')">Add to Cart</button>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
  <div class="six wide column">
    <div class="ui segment">
      <h4 class="ui dividing header">Your Food Order</h4>
      <br>
    </div>
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
        <form class="ui form">
          <div class="two fields">
            <input type="number" min="0" placeholder="No. of Pax">
            <select class="ui fluid dropdown">
              <option value="">Choose Menu Type</option>
              @if(count($menu->rates()->buffet()) > 0) 
              <option value="1">Buffet - Php {{ $menu->rates()->latestBuffet()->amount }}/pax</option>
              @endif
              @if(count($menu->rates()->set()) > 0) 
              <option value="2">Set - Php {{ $menu->rates()->latestSet()->amount }}/pax</option>
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

@endsection

@section('js')
<script type="text/javascript">
  $('select.dropdown').dropdown();
</script>
@endsection