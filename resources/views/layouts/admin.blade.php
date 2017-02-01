<!DOCTYPE html>
<html>
<head>
	<title>@yield('title') - PNMS</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.semanticui.css' )}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
</head>
<body>

	<div class="ui inverted left fixed vertical menu" id="menu">
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
		    <div class="title" id="menu">
		      <i class="dropdown icon"></i>
		      Menu
		    </div>
		    <div class="content" id="menu_content">
		      <a href="{{url('/menuType')}}" class="item" id="menuType">Menu Type</a>
		      <a href="#" class="item">Food Category</a>
		      <a href="{{url('/menu')}}" class="item" id="menu">Menu</a>
		    </div>

		    <div class="title">
		      <i class="dropdown icon"></i>
		      Inventory
		    </div>
		    <div class="content">
		      <a href="#" class="item">Equipment Type</a>
		      <a href="#" class="item">Equipment</a>
		      <a href="#" class="item">Equipment Rate</a>
		      <a href="#" class="item">Unit</a>
		    </div>

		    <div class="title">
		      <i class="dropdown icon"></i>
		      Event
		    </div>
		    <div class="content">
		      <a href="#" class="item">Event Type</a>
		      <a href="#" class="item">Motif</a>
		      <a href="#" class="item">Serving Type</a>
		    </div>

		    <div class="title">
		      <i class="dropdown icon"></i>
		      Fees
		    </div>
		    <div class="content">
		      <a href="#" class="item">Delivery</a>
		      <a href="#" class="item">Penalty Type</a>
		      <a href="#" class="item">Penalty</a>
		    </div>
	  	</div>
	  </div>

	  <div class="item">
	  	<i class="inverted blue file text icon"></i>
	  	TRANSACTION
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
