@extends('layouts.admin')

@section('title')
	Unit of Measurement
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
		<h1>Archive - Unit of Measurement</h1>
		<hr>
	</div>
	<div class="row">
		<a href="{{ url('/uom') }}" class="ui brown button"><i class="arrow circle left icon"></i>Back to Unit of Measurement</a>
	</div>
	<div class="row">
		<table class="ui table" id="tbluom">
		  <thead>
		    <tr>
			    <th>Symbol</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($uoms) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($uoms as $uom)
			  	<tr>
			      <td>{{$uom->uomSymbol}}</td>
			      <td>{{$uom->uomDesc}}</td>
			      <td class="center aligned">
					@if($uom->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$uom->uomCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$uom->uomCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($uoms) > 0)
@foreach($uoms as $uom)
	<div class="ui modal" id="restore{{$uom->uomCode}}">
	  <div class="header">Restore</div>
	  <div class="content">
	    <p>Do you want to Restore this Unit of Measurement?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/uom/uom_restore']) !!}
	  		{{ Form::hidden('uom_code', $uom->uomCode) }}
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
		uom_symbol: {
		  identifier : 'uom_symbol',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter the Symbol'
			},
			{
        

           	type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

	        	
	           
				prompt: "Symbol can only consist of alphanumeric, spaces, apostrophe and dashes"
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






    $('#uom').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tbluom').DataTable();
  });
</script>
@endsection