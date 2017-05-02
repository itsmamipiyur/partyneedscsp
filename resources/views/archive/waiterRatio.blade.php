@extends('layouts.admin')

@section('title')
	Waiter Ratio
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	@if ($alert = Session::get('alert-failed'))
    <div class="ui failed message">
    	<div class="header">Failed!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

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

	<div class="row">
		<h1>Waiter Ratio</h1>
		<hr>
	</div>

	<div class="row">
		<a href="{{ url('/waiterRatio') }}" class="ui brown button"><i class="arrow circle left icon"></i>Back to Waiter Ratio</a>
	</div>
	<div class="row">
		<table class="ui table" id="tblwaiterratio">
		  <thead>
		    <tr>
				<th class="right aligned">Mininum No. of Pax</th>
			    <th class="right aligned">Maxinum No. of Pax</th>
			    <th class="right aligned">Number of Waiter</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($waiterRatios) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($waiterRatios as $waiterRatio)
			  	<tr>
				  <td class="right aligned">{{$waiterRatio->waiterRatioMinPax}}</td>
			      <td class="right aligned">{{$waiterRatio->waiterRatioMaxPax}}</td>
			      <td class="right aligned">{{$waiterRatio->waiterRatioWaiterCount}}</td>
			      <td class="center aligned">
					@if($waiterRatio->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$waiterRatio->waiterRatioCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$waiterRatio->waiterRatioCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($waiterRatios) > 0)
@foreach($waiterRatios as $waiterRatio)
	<div class="ui modal" id="restore{{$waiterRatio->waiterRatioCode}}">
	  <div class="header">Restore</div>
	  <div class="content">
	    <p>Do you want to Restore this waiter ratio?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/waiterRatio/waiterRatio_restore']) !!}
	  		{{ Form::hidden('waiter_ratio_code', $waiterRatio->waiterRatioCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif
@endsection

@section('js')
<script>
  $(document).ready( function(){




  	$('.ui.modal').modal({
        onApprove : function() {
          //Submits the semantic ui form
          //And pass the handling responsibilities to the form handlers,
          // e.g. on form validation success
          //$('.ui.form').submit();
          console.log('approve');
          //Return false as to not close modal dialog
          return false;
        }
    });

  	$.fn.form.settings.rules.validMaxPax = function(maxpax) {
	    var minpax = $('#cmin_pax').val();
	    console.log("mx_minpax: " + minpax);
	    console.log("mx_maxpax: " + maxpax);
	    return (minpax < maxpax)? true : false;
	}

	$.fn.form.settings.rules.validMinPax = function(maxpax) {
	    var minpax = $('#cmax_pax').val();
	    console.log("umxp_mn_minpax: " + minpax);
	    console.log("mn_maxpax: " + maxpax);
	    return (minpax > maxpax)? true : false;
	}

	$.fn.form.settings.rules.validUpdateMaxPax = function(maxpax) {
	    var minpax = $('#umin_pax').val();
	    console.log("umxp_umx_minpax: " + minpax);
	    console.log("umx_maxpax: " + maxpax);
	    console.log(minpax < maxpax);
	    return (minpax < maxpax)? true : false;
	}

	$.fn.form.settings.rules.validUpdateMinPax = function(maxpax) {
	    var minpax = $('#umax_pax').val();
	    console.log("umn_minpax: " + minpax);
	    console.log("umn_maxpax: " + maxpax);
	    console.log(minpax > maxpax);
	    return (minpax > maxpax)? true : false;
	}



	var formValidationRules =
	{
		min_pax: {
		  identifier : 'cmin_pax',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter the Minimum pax'

			},
			{
			  type   : "regExp[^[1-9][0-9]*$]",
			  prompt : 'Please enter a valid number for Minimum pax'
			},
			{
				type : 'validMinPax[cmin_pax]',
				prompt : 'Minimum pax should be less than Maximum pax'
			}
		  ]
		},
		max_pax: {
		  identifier : 'cmax_pax',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter the Maximum pax'

			},
			{
			  type   : "regExp[^[1-9][0-9]*$]",
			  prompt : 'Please enter a valid number of Maximum pax'
			},
			{
				type : 'validMaxPax[cmax_pax]',
				prompt : 'Maximum pax should be greater than Minimum pax'
			}
		  ]
		},
		number_of_waiter: {
		  identifier : 'number_of_waiter',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter the No. of Waiter'

			},
			{
			  type   : "regExp[^[1-9][0-9]*$]",

			  prompt : 'Please enter a valid number for No. of waiter'
			}
		  ]
		}
	}

	var formSettings =
	{
		onSuccess : function() 
		{
		  $('.modal').modal('hide');
		}
	}

	$('.ui.create').form(formValidationRules, formSettings);


	var updateformValidationRules =
	{
		min_pax: {
		  identifier : 'min_pax',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter the Minimum pax'

			},
			{
			  type   : "regExp[^[1-9][0-9]*$]",
			  prompt : 'Please enter a valid number for Minimum pax'
			}
		  ]
		},
		max_pax: {
		  identifier : 'max_pax',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter the Maximum pax'

			},
			{
			  type   : "regExp[^[1-9][0-9]*$]",
			  prompt : 'Please enter a valid number of Maximum pax'
			}
		  ]
		},
		number_of_waiter: {
		  identifier : 'number_of_waiter',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter the No. of Waiter'

			},
			{
			  type   : "regExp[^[1-9][0-9]*$]",

			  prompt : 'Please enter a valid number for No. of waiter'
			}
		  ]
		}
	}

	var updateformSettings =
	{
		onSuccess : function() 
		{
		  $('.modal').modal('hide');
		}
	}

	$('.ui.update').form(updateformValidationRules, updateformSettings);



    $('#waiterRatio').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblwaiterratio').DataTable();
  });
</script>
@endsection
