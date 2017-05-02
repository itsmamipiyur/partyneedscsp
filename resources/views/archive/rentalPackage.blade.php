@extends('layouts.admin')

@section('title')
	Rental Package
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
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
		<h1>Rental Package</h1>
		<hr>
	</div>
	<div class="row">
		<a href="{{ url('/rentalPackage') }}" class="ui brown button"><i class="arrow circle left icon"></i>Back to Rental Package</a>
	</div>
	<div class="row">
		<table class="ui table" id="tblPackage">
		  <thead>
		    <tr>
			    <th>Name</th>
			    <th>Description</th>
			    <th>Amount</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($rentalPackages) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($rentalPackages as $rentalPackage)
			  	<tr>
			      <td>{{$rentalPackage->rentalPackageName}}</td>		      
			      <td>{{$rentalPackage->rentalPackageDesc}}</td>
			      <td>Php {{$rentalPackage->rentalPackageAmount}}</td>
			      <td class="center aligned">
					@if($rentalPackage->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$rentalPackage->rentalPackageCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$rentalPackage->rentalPackageCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($rentalPackages) > 0)
@foreach($rentalPackages as $rentalPackage)
	<div class="ui modal" id="restore{{$rentalPackage->rentalPackageCode}}">
	  <div class="header">Restore Rental Package</div>
	  <div class="content">
	    <p>Do you want to Restore this Rental Package?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/rentalPackage/rentalPackage_restore']) !!}
	  		{{ Form::hidden('rentalPackage_code', $rentalPackage->rentalPackageCode) }}
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




	var formValidationRules =
	{
		rentalPackage_name: {
		  identifier : 'rentalPackage_name',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter a name'
			},
			{
	        

	            type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

	        	
	           
				prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
	        	}
		  ]
		},
		rentalPackage_duration: {
      identifier : 'rentalPackage_duration',
      rules: [
      {
		  type   : "regExp[^[1-9][0-9]*$]",
		  prompt : 'Please enter a valid number of Duration'
		},
      {
        type   : 'empty',
        prompt : 'Please enter the Duration'
      }

      ]
    },
		rentalPackage_unit: {
      identifier : 'rentalPackage_unit',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please select a package menu'
      }
      ]
    },
    amount: {
				identifier : 'amount',
				rules: [
				{
					type   : 'empty',
					prompt : 'Please enter the valid amount'
				}
				]
			},
    rentalPackage_item: {
      identifier : 'rentalPackage_item',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please select a rental item'
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

	$('.ui.form').form(formValidationRules, formSettings);


    $('#rentalPackages').addClass("active grey");
    $('#rentalPackage_content').addClass("active");
    $('#rentalPackage').addClass("active");
    $('#rentalPackage_item').dropdown({
		onAdd: function(value,text,$addedChoice){

			document.getElementById('sit').style.display = "block";
			$("#tblItemList").find('tbody')
			.append($('<tr>')
				.attr('id', value)
				.append($('<td>')
					.append("<p>" + text + "</p>")
					).append($('<td>')
					.append($('<input>')
						.attr('name', 'quantity[' + value + ']')
						.attr('data-validate', 'quantity')
						.attr('required', 'true')
						.attr('type', 'number')
						)
					));
    	},
    	onRemove: function(value,text,$addedChoice){
    		$('#' + value).remove();
    		if($('tr', $('table#tblItemList').find('tbody')).length < 1){
    			document.getElementById('sit').style.display = "none";
    		}
    	}
    });

    $('.money').mask("##0.00", {reverse: true});
    var table = $('#tblPackage').DataTable();
    var tableItem = $('#tblItem').DataTable();
  });
</script>
@endsection