<!DOCTYPE html>
<html>
<head>
	<title>@yield('title') - PNMS</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.semanticui.css' )}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
</head>
<body>

	<div class="ui inverted left fixed vertical menu" id="sidebar">
	  <div class="item">
	  	PARTY NEEDS MANAGEMENT SYSTEM
	  </div>
	  <a href="{{url('/home')}}" class="item" id="dashboard">
	  	<i class="inverted blue dashboard icon"></i> DASHBOARD
	  </a>
	  <div class="item">
	  	<i class="inverted blue folder open icon"></i>
	  	MAINTENANCE
	  	<div class="ui inverted accordion">
		    <div class="title" id="inventory">
		      <i class="dropdown icon"></i>
		      Inventory
		    </div>
		    <div class="content" id="inventory_content">
		      <a href="{{url('/equipmentType')}}" class="item" id="equipmentType">Equipment Type</a>
		      <a href="{{url('/equipment')}}" class="item" id="equipment">Equipment</a>
		      <a href="{{url('/unit')}}" class="item" id="unit">Unit</a>
		      <a href="{{url('/equipmentRate')}}" class="item" id="equipmentRate">Equipment Rate</a>
		    </div>

		    <div class="title" id="menu">
		      <i class="dropdown icon"></i>
		      Menu
		    </div>
		    <div class="content" id="menu_content">
		      <a href="{{url('/menuType')}}" class="item" id="menuType">Menu Type</a>
		      <a href="{{url('/menu')}}" class="item" id="menus">Menu</a>
		    </div>


		    <div class="title" id="event">
		      <i class="dropdown icon"></i>
		      Event
		    </div>
		    <div class="content" id="event_content">
		      <a href="{{url('/eventType')}}" class="item" id="eventType">Event Type</a>
		      <a href="{{url('/motif')}}" class="item" id="motif">Motif</a>
		      <a href="{{url('/waiterRatio')}}" class="item" id="waiterRatio">Waiter Ratio</a>
		      <a href="{{url('/servingType')}}" class="item" id="servingType">Serving Type</a>
		    </div>

		    <div class="title" id="fees">
		      <i class="dropdown icon"></i>
		      Fees
		    </div>
		    <div class="content" id="fees_content">
		      <a href="{{url('/delivery')}}" class="item" id="delivery">Delivery</a>
		      <a href="{{url('/penaltyType')}}" class="item" id="penaltyType">Penalty Type</a>
		      <a href="{{url('/penalty')}}" class="item" id="penalty">Penalty</a>
		    </div>
	  	</div>
	  </div>

	  <div class="item">
	  	<i class="inverted blue file text icon"></i>
	  	TRANSACTION
	  	<div class="ui inverted accordion">
		    <div class="title" id="eventtrans">
		      <i class="dropdown icon"></i>
		      Event
		    </div>
		    <div class="content" id="eventtrans_content">
		      <a href="#" class="item" id="eventBook">Create Event</a>
		      <a href="#" class="item" id="foodCategory">Cancel Event</a>
		    </div>

		    <div class="title" id="inventorytrans">
		      <i class="dropdown icon"></i>
		      Inventory
		    </div>
		    <div class="content" id="inventorytrans_content">
		      <a href="#" class="item" id="equipmentType">Create Invetory Transaction</a>
		      <a href="#" class="item" id="equipment">Release Equipment</a>
		      <a href="#" class="item" id="unit">Audit Equipment</a>
		    </div>

		    <div class="title" id="rental">
		      <i class="dropdown icon"></i>
		      Rental
		    </div>
		    <div class="content" id="rental_content">
		      <a href="#" class="item" id="eventType">Create Rental Transaction</a>
		      <a href="#" class="item" id="motif">Extend Rent</a>
		    </div>
	  	</div>
	  </div>
	  <div class="item">
	  	<i class="inverted blue search icon"></i>
	  	QUERIES
	  </div>
	  <div class="item">
	  	<i class="inverted blue pie chart icon"></i>
	  	REPORTS
	  </div>
	  <div class="item">
	  	<i class="inverted blue settings icon"></i>
	  	UTILITY
	  </div>

	  <a class="item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
	  	<i class="inverted blue sign out icon"></i>
	  	SIGN OUT
	  </a>

	  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
	  </form>
	</div>

	<div id="content" class="ui container">
		@yield('content')
	</div>

	<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
  	<script type="text/javascript" src="{{asset('js/semantic.js')}}"></script>
  	<script src="{{ asset('js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.semanticui.js') }}" type="text/javascript"></script>
  	<script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
  	@yield('js')
</body>
</html>
