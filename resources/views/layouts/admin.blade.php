<!DOCTYPE html>
<html>
<head>

	<title>@yield('title') - PNMS</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.semanticui.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
</head>
<body>
	<div class="ui top attached menu">
	  <a id="toggle" class="item">
	    <i class="sidebar icon"></i>
	    Menu
	  </a>
	</div>
	<div class="ui bottom attached segment">
	  <div class="ui wide visible inverted left inline vertical sidebar menu">
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
				    <a href="#" class="item">Dish</a>
				    <a href="#" class="item">Menu</a>
				  </div>

				  <div class="title">
				    <i class="dropdown icon"></i>
				    Rates
				  </div>
				  <div class="content">
				    <a href="#" class="item">Item Rate</a>
				    <a href="#" class="item">Menu Rate</a>
				    <a href="#" class="item">Quantity Ratio</a>
				  </div>

				<div class="title">
				    <i class="dropdown icon"></i>
				    Event
				</div>
				  <div class="content">
				    <a href="#" class="item">Event Type</a>
				    <a href="#" class="item">Decor</a>
				    <a href="#" class="item">Waiter Ratio</a>
				  </div>

				<div class="title">
				    <i class="dropdown icon"></i>
				    Fees
				  </div>
				  <div class="content">
				    <a href="#" class="item">Delivery</a>
				    <a href="#" class="item">Penalty</a>
				  </div>
			</div>
		   </div>
		</div>
		<div class="item">
			<strong>TRANSACTION</strong><br><br>
			<a href="#" class="item">Inventory</a>
			<a href="#" class="item">Event Management</a>
			<a href="#" class="item">Rental Management</a>
			<a href="#" class="item">Billing and Collection</a>
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
	      @yield('content')
	    </div>
	  </div>

	<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/semantic.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery.dataTables.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/dataTables.semanticui.js')}}"></script>

	<script type="text/javascript">
		$('.ui.sidebar').sidebar({
		    context: $('.bottom.segment')
		  })
		  .sidebar('attach events', '#toggle');
		$('.ui.accordion').accordion();
	</script>

	@yield('js')
</body>
</html>
