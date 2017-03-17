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
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Rental Package</button>
		<a href="{{ url('/archive/rentalPackage') }}" class="ui teal button"><i class="archive icon"></i>Archive</a>

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
			      <td>Php {{number_format($rentalPackage->rentalPackageAmount, 2, '.', ',')}}</td>
			      <td class="center aligned">
			      	<a href="{{url('/rentalPackage/'. $rentalPackage->rentalPackageCode)}}" class="ui teal button">Package Details</a>
					<button class="ui blue button" onclick="$('#update{{$rentalPackage->rentalPackageCode}}').modal('show');"><i class="edit icon"></i> Update</button>
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
	<div class="ui modal" id="update{{$rentalPackage->rentalPackageCode}}">
	  <div class="header">Update Rental Package</div>
	  <div class="content">
	    {!! Form::open(['url' => '/rentalPackage/rentalPackage_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		
	    		{{ Form::hidden('rentalPackage_code', $rentalPackage->rentalPackageCode) }}
	    		<div class="required field">
	    			{{ Form::label('rentalPackage_name', 'Name') }}
         			{{ Form::text('rentalPackage_name', $rentalPackage->rentalPackageName, ['maxlength' => '25', 'placeholder' => 'Type Package Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('rentalPackage_description', 'Description') }}
          			{{ Form::textarea('rentalPackage_description', $rentalPackage->rentalPackageDesc, ['maxlength' => '200', 'placeholder' => 'Type Package Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="row">
		    		<div class="ui grid">
		    			<div class="eight wide column">
		    				<div class="required field">
				    			{{ Form::label('rentalPackage_duration', 'Duration') }}
			         			{{ Form::text('rentalPackage_duration', $rentalPackage->rentalPackageDuration, ['maxlength'=>'4', 'placeholder' => 'Duration']) }}
				    		</div>
		    			</div>
		    			<div class="eight wide column">
		    				<div class="required field">
				    			{{ Form::label('rentalPackage_unit', 'Unit') }}
			         			{{ Form::select('rentalPackage_unit', $units, $rentalPackage->rentalPackageUnit, ['placeholder' => 'Choose Unit', 'class' => 'ui fluid dropdown']) }}
				    		</div>
		    			</div>
		    		</div>
	    		</div>
	    		<div class="required field">
                    {{ Form::label('amount', 'Amount') }}
                    <div class="ui center labeled input">
                    <div class="ui label">Php</div>
                    {{ Form::text('amount', $rentalPackage->rentalPackageAmount, ['maxlength' => '12', 'class' => 'money', 'placeholder' => 'Amount']) }}
                    </div>
                </div>
	    	</div>
	    	<div class="ui error message"></div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$rentalPackage->rentalPackageCode}}">
	  <div class="header">Deactivate Rental Package</div>
	  <div class="content">
	    <p>Do you want to deactivate this Rental Package?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/rentalPackage/' . $rentalPackage->rentalPackageCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

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

	<div class="ui modal" id="create">
	  <div class="header">New Rental Package</div>
	  <div class="content">
	    {!! Form::open(['url' => '/rentalPackage', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
	    		
	    		<div class="disabled field">

         			{{ Form::hidden('rentalPackage_code', $newID, ['placeholder' => 'Type Package Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('rentalPackage_name', 'Name') }}
         			{{ Form::text('rentalPackage_name', '', ['maxlength' => '25', 'placeholder' => 'Type Package Name', 'autofocus' => 'true']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('rentalPackage_description', 'Description') }}
          			{{ Form::textarea('rentalPackage_description', '', ['maxlength' => '200', 'placeholder' => 'Type Package Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="row">
		    		<div class="ui grid">
		    			<div class="eight wide column">
		    				<div class="required field">
				    			{{ Form::label('rentalPackage_duration', 'Duration') }}
			         			{{ Form::text('rentalPackage_duration', '', ['maxlength'=>'4', 'placeholder' => 'Duration']) }}
				    		</div>
		    			</div>
		    			<div class="eight wide column">
		    				<div class="required field">
				    			{{ Form::label('rentalPackage_unit', 'Unit') }}
			         			{{ Form::select('rentalPackage_unit', $units, null, ['placeholder' => 'Choose Unit', 'class' => 'ui fluid dropdown']) }}
				    		</div>
		    			</div>
		    		</div>
	    		</div>
	    		<div class="required field">
                    {{ Form::label('amount', 'Amount') }}
                    <div class="ui center labeled input">
                    <div class="ui label">Php</div>
                    {{ Form::text('amount', null, ['maxlength' => '12', 'class' => 'money', 'placeholder' => 'Amount']) }}
                    </div>
                </div>
                <div class="ui horizontal divider">Package Details</div>
							
				<div class="required field">
					{{ Form::label('rentalPackage_item', 'Items') }}
					{{ Form::select('rentalPackage_item[]', $items, '', ['id'=>'rentalPackage_item', 'multiple' => 'multiple', 'placeholder' => 'Select Item', 'class' => 'ui fluid dropdown' ]) }}
				</div>
				<div class="required field" id="sit" style="display: none;">
					<table id="tblItemList" class="ui compact celled definition table">
						<thead class="full-width">
							<tr>
								<th>Item</th>
								<th>Quantity</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
						
				<div class="ui error message"></div>
	  <div class="actions">
            {{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
      </div>
@endsection

@section('js')
<style>


        #amount, #rentalPackage_duration {
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

    $('.money').mask("#,##0.00", {reverse: true});
    var table = $('#tblPackage').DataTable();
    var tableItem = $('#tblItem').DataTable();
  });
</script>
@endsection