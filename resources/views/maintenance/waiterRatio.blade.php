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

	<div class="row">
		<h1>Waiter Ratio</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Waiter Ratio</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblWaiterRatio">
		  <thead>
		    <tr>
			    <th>Maxinum No. of Pax</th>
			    <th>Number of Waiter</th>
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
			      <td>{{$waiterRatio->intWaitRatiMaxPax}}</td>
			      <td>{{$waiterRatio->intWaitRatiNoOfWaiter}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$waiterRatio->strWaitRatiCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($waiterRatio->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$waiterRatio->strWaitRatiCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$waiterRatio->strWaitRatiCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
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
	<div class="ui modal" id="update{{$waiterRatio->strWaitRatiCode}}">
	  <div class="header">Update Waiter Ratio</div>
	  <div class="content">
	    {!! Form::open(['url' => '/waiterRatio/waiterRatio_update']) !!}
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
	    		{{ Form::hidden('waiter_ratio_code', $waiterRatio->strWaitRatiCode) }}
	    		<div class="required field">
	    			{{ Form::label('max_pax', 'Maxinum No. of Pax') }}
         			{{ Form::text('max_pax', $waiterRatio->intWaitRatiMaxPax, ['placeholder' => 'Maxinum Pax']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('number_of_waiter', 'Number of Waiter') }}
          			{{ Form::text('number_of_waiter', $waiterRatio->intWaitRatiNoOfWaiter, ['placeholder' => 'Number of Waiter']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$waiterRatio->strWaitRatiCode}}">
	  <div class="header">Deactivate Waiter Ratio</div>
	  <div class="content">
	    <p>Do you want to delete this waiter ratio?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/waiterRatio/' .$waiterRatio->strWaitRatiCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$waiterRatio->strWaitRatiCode}}">
	  <div class="header">Restore Waiter Ratio</div>
	  <div class="content">
	    <p>Do you want to Restore this waiter ratio?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/waiterRatio/waiterRatio_restore']) !!}
	  		{{ Form::hidden('waiter_ratio_code', $waiterRatio->strWaitRatiCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Waiter Ratio</div>
	  <div class="content">
	    {!! Form::open(['url' => '/waiterRatio']) !!}
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
	    			{{ Form::label('waiter_ratio_code', 'Waiter Ratio Code') }}
         			{{ Form::text('waiter_ratio_code', $newID, ['placeholder' => 'Type Menu Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('max_pax', 'Maximum No. of Pax') }}
         			{{ Form::text('max_pax', '', ['placeholder' => 'Number of Pax']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('number_of_waiter', 'Number of Waiter') }}
          			{{ Form::text('number_of_waiter', '', ['placeholder' => 'Number of Waiter']) }}
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
<script>
  $(document).ready( function(){
    $('#waiterRatio').addClass("active grey");
    $('#event_content').addClass("active");
    $('#event').addClass("active");

    var table = $('#tblWaiterRatio').DataTable();
  });
</script>
@endsection