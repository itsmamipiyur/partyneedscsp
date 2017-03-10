@extends('layouts.admin')

@section('title')
	Item Rate
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Item Rate</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Item Rate</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblitemrate">
		  <thead>
		    <tr>
		    	<th>Item</th>
			    <th>Amount</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($itemRates) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($itemRates as $itemRate)
			  	<tr>
			  	  <td>{{$itemRate->item->itemName}}</td>
			      <td>Php {{$itemRate->amount}}</td>

			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$itemRate->itemRateCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($itemRate->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$itemRate->itemRateCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$itemRate->itemRateCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($itemRates) > 0)
@foreach($itemRates as $itemRate)
	<div class="ui modal" id="update{{$itemRate->itemRateCode}}">
	  <div class="header">Update</div>
	  <div class="content">
	    {!! Form::open(['url' => '/itemRate/itemRate_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
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
	    		{{ Form::hidden('item_rate_code', $itemRate->itemRateCode) }}
	    		<div class="required field">
	    			{{ Form::label('item_code', 'Item') }}
         			{{ Form::select('item_code', $items, $itemRate->itemCode, ['placeholder' => 'Choose Item', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('uom_code', 'Unit of Measurement') }}
         			{{ Form::select('uom_code', $uoms, $itemRate->uomCode, ['placeholder' => 'Choose Unit of Measurement', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
                    {{ Form::label('amount', 'Amount') }}
                    <div class="ui center labeled input">
                    <div class="ui label">Php</div>
                    {{ Form::text('amount', $itemRate->amount, ['class' => 'money', 'placeholder' => 'Amount']) }}
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

	<div class="ui modal" id="delete{{$itemRate->itemRateCode}}">
	  <div class="header">Deactivate</div>
	  <div class="content">
	    <p>Do you want to delete this Item Rate?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/itemRate/' . $itemRate->itemRateCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$itemRate->itemRateCode}}">
	  <div class="header">Restore</div>
	  <div class="content">
	    <p>Do you want to Restore this Item Rate?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/itemRate/itemRate_restore']) !!}
	  		{{ Form::hidden('item_rate_code', $itemRate->itemRateCode) }}
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
	    {!! Form::open(['url' => '/itemRate', 'id' => 'createForm', 'class' => 'ui form']) !!}
	    	<div class="ui form">
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

	    		<div class="disabled field">
	    			{{ Form::label('item_rate_code', 'Code') }}
         			{{ Form::text('item_rate_code', $newID, ['placeholder' => 'Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_code', 'Item') }}
         			{{ Form::select('item_code', $items, null, ['placeholder' => 'Choose Item', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('uom_code', 'Unit of Measurement') }}
         			{{ Form::select('uom_code', $uoms, null, ['placeholder' => 'Choose Unit of Measurement', 'class' => 'ui search dropdown']) }}
	    		</div>
	    		<div class="required field">
                    {{ Form::label('amount', 'Amount') }}
                    <div class="ui center labeled input">
                    <div class="ui label">Php</div>
                    {{ Form::text('amount', null, ['class' => 'money', 'placeholder' => 'Amount']) }}
                    </div>
                </div>
	    	</div>
	    	<div class="ui error message"></div>
        </div>
	  <div class="actions">
            {{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	  
	</div>
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
		amount: {
		  identifier : 'amount',
		  rules: [
			{
			  type   : 'empty',
			  prompt : 'Please enter the amount'
			}
		  ]
		},
		item_code: {
        identifier: 'item_code',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select an item'
          }
        ]
      },
      uom_code: {
        identifier: 'uom_code',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select a uom'
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




    $('#itemRate').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblitemrate').DataTable();
    $('.money').mask("##0.00", {reverse: true});
  });
</script>
@endsection
