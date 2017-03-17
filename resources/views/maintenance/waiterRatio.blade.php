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
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Waiter Ratio</button>
		<a href="{{ url('/archive/waiterRatio') }}" class="ui teal button"><i class="archive icon"></i>Archive</a>
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
					<button class="ui blue button" onclick="$('#update{{$waiterRatio->waiterRatioCode}}').modal('show');"><i class="edit icon"></i> Update</button>
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
	<div class="ui modal" id="update{{$waiterRatio->waiterRatioCode}}">
	  <div class="header">Update</div>
	  <div class="content">
	    {!! Form::open(['url' => '/waiterRatio/waiterRatio_update', 'id' => 'createForm', 'class' => 'ui form update']) !!}
	    	<div class="ui updateform">
	    		<div class="ui error message"></div>
	    		{{ Form::hidden('waiter_ratio_code', $waiterRatio->waiterRatioCode) }}
					<div class="required field">
	    			{{ Form::label('min_pax', 'Minimum No. of Pax') }}
         			{{ Form::text('min_pax', $waiterRatio->waiterRatioMinPax, ['id' => 'min_pax', 'maxlength'=>'4', 'placeholder' => 'Maxinum Pax']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('max_pax', 'Maxinum No. of Pax') }}
         			{{ Form::text('max_pax', $waiterRatio->waiterRatioMaxPax, ['id' => 'max_pax', 'maxlength'=>'4','placeholder' => 'Maxinum Pax']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('number_of_waiter', 'Number of Waiter') }}
          			{{ Form::text('number_of_waiter', $waiterRatio->waiterRatioWaiterCount, ['maxlength'=>'4','placeholder' => 'Number of Waiter']) }}
	    		</div>
	    	</div>
	    	
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$waiterRatio->waiterRatioCode}}">
	  <div class="header">Deactivate</div>
	  <div class="content">
	    <p>Do you want to delete this waiter ratio?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/waiterRatio/' .$waiterRatio->waiterRatioCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

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

	<div class="ui modal" id="create">
	  <div class="header">New</div>
	  <div class="content">
	    {!! Form::open(['url' => '/waiterRatio', 'id' => 'createForm', 'class' => 'ui form create']) !!}
	    	<div class="ui form">
	    		<div class="ui error message"></div>

	    		<div class="disabled field">
	    			
         			{{ Form::hidden('waiter_ratio_code', $newID, ['placeholder' => 'Type Menu Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('min_pax', 'Minimum No. of Pax') }}
         			{{ Form::text('min_pax', '', ['id' => 'cmin_pax', 'maxlength'=>'4', 'placeholder' => 'Number of Pax', 'autofocus' => 'true']) }}
	    		</div>
					<div class="required field">
	    			{{ Form::label('max_pax', 'Maximum No. of Pax') }}
         			{{ Form::text('max_pax', '', ['id' => 'cmax_pax', 'maxlength'=>'4', 'placeholder' => 'Number of Pax']) }}
	    		</div>
	    		<div class="required field"> 
	    			{{ Form::label('number_of_waiter', 'Number of Waiter') }}
          			{{ Form::text('number_of_waiter', '', ['maxlength'=>'4', 'placeholder' => 'Number of Waiter']) }}
	    		</div>
	    	</div>
	    	
        </div>
	  <div class="actions">
            {{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endsection

@section('js')
<style>


        #cmin_pax, #cmax_pax, #number_of_waiter, #min_pax, #max_pax {
            text-align: right;
        }

</style>
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
