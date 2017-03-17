<!DOCTYPE html>
<html>
<head>

	<title>@yield('title') - PNMS</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.semanticui.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.datetimepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
</head>
<body>
	<div class="ui top attached menu">
	  <a id="toggle" class="item">
	    <i class="sidebar icon"></i>
	    Menu
	  </a>
	  <div class="item">
	  	<strong>PARTY NEEDS MANAGEMENT SYSTEM</strong>
	  </div>
	  <div class="right menu">
	  	<div class="item" id="clock">
	  		
	  	</div>
	  	<div class="ui dropdown link item">
		    <span class="text">{{ Auth::user()->name }}</span>
		    <i class="dropdown icon"></i>
		    <div class="menu">
		      <a href="{{ url('/logout') }}"
		            onclick="event.preventDefault();
		                     document.getElementById('logout-form').submit();"
		            class="item">
		            <i class="sign out icon"></i>
		            LOGOUT
		        </a>
		    </div>
	  	</div>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
	  </div>
	</div>

	<div class="ui bottom attached segment" id="menu">
	  <div class="ui wide inverted left inline vertical sidebar menu">
	  	<div class="item">
	  		<strong>PARTY NEEDS MANAGEMENT SYSTEM</strong>
	  	</div>
		<a href="#" class="item"><strong>DASHBOARD</strong></a>
		<div class="item">
			<strong>MAINTENANCE</strong><br><br>
			<div class="row">
				<div class="ui inverted accordion">

				  <div class="title">
				    <i class="dropdown icon"></i>
				    Item
				  </div>
				  <div class="content">
				    <a href="{{ url('/uom') }}" class="item">Unit of Measurement</a>
				    <a href="{{ url('/equipmentType') }}" class="item">Equipment Type</a>
				    <a href="{{ url('/dinnerwareType') }}" class="item">Dinnerware Type</a>
				    <a href="{{ url('/item') }}" class="item">Item</a>
				  </div>

				  <div class="title">
				    <i class="dropdown icon"></i>
				    Menu
				  </div>
				  <div class="content">
				    <a href="{{url('/dishType')}}" class="item">Dish Type</a>
				    <a href="{{url('/dish')}}" class="item">Dish</a>
				    <a href="{{url('/menu')}}" class="item">Menu</a>
				  </div>
				  <div class="title">
				    <i class="dropdown icon"></i>
				    Package
				  </div>
				  <div class="content">
				    <a href="{{url('/cateringPackage')}}" class="item">Catering Package</a>
				    <a href="{{url('/rentalPackage')}}" class="item">Rental Package</a>
				  </div>

				<div class="title">
				    <i class="dropdown icon"></i>
				    Event
				</div>
				  <div class="content">
				    <a href="{{url('/eventType')}}" class="item">Event Type</a>
				    <a href="{{url('/decor')}}" class="item">Decor</a>
				    <a href="{{url('/waiterRatio')}}" class="item">Waiter Ratio</a>
				  </div>

				<div class="title">
				    <i class="dropdown icon"></i>
				    Fees
				  </div>
				  <div class="content">
				    <a href="{{url('/delivery')}}" class="item">Delivery</a>
				    <a href="{{url('/penalty')}}" class="item">Penalty</a>
				  </div>
			</div>
		   </div>
		</div>
		<div class="item">
			<strong>TRANSACTION</strong><br><br>
			<a href="{{url('/eventManagement')}}" class="item">Event Management</a>
			<a href="{{url('/rentalManagement')}}" class="item">Rental Management</a>
			<a href="{{url('/inventory')}}" class="item">Inventory</a>
			<a href="{{url('/billingCollection')}}" class="item">Billing and Collection</a>
		</div>
		<div class="item">
			<strong>QUERIES</strong>
		</div>
		<div class="item">
			<strong>REPORTS</strong><br><br>
			<a href="#" class="item">Sales Report</a>
			<a href="#" class="item">Rental Report</a>
			<a href="#" class="item">Event Booking Report</a>
		</div>
		<div class="item">
			<strong>UTILITIES</strong>
		</div>
	  </div>
	  <div class="pusher">
	    <div class="ui basic segment">
	    	<div class="ui container">
	      		@yield('content')
	    	</div>
	    </div>
	  </div>

	<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/semantic.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery.dataTables.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/dataTables.semanticui.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/mask.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery.datetimepicker.full.js')}}"></script>

	<script type="text/javascript">
		$('.ui.sidebar').sidebar({
		    // context: $('.bottom.segment')
			   context: $('#menu')
		  })
		  .sidebar('attach events', '#toggle');
		$('.ui.accordion').accordion();

		function startTime() {
		    var today = new Date();
		    var utc = today.toJSON().slice(0,10).replace(/-/g,'/');
		    var h = today.getHours();
		    var m = today.getMinutes();
		    var s = today.getSeconds();
		    var ampm = h >= 12 ? 'PM' : 'AM';
		    h = h % 12;
  			h = h ? h : 12; // the hour '0' should be '12'
		    m = checkTime(m);
		    s = checkTime(s);
		    document.getElementById('clock').innerHTML =
		    utc + " " + h + ":" + m + ":" + s + ' ' + ampm;
		    var t = setTimeout(startTime, 500);
		}
		function checkTime(i) {
		    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		    return i;
		}

		$(document).ready(function()
		{
		   setInterval('startTime()', 1000);
		});
	</script>

	@yield('js')
</body>
</html>
