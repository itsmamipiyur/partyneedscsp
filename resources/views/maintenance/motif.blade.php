@extends('layouts.admin')

@section('title')
	Motif
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Motif</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Motif</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblMotif">
		  <thead>
		    <tr>
			    <th>Motif</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($motifs) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($motifs as $motif)
			  	<tr>
			      <td>{{$motif->strMotiName}}</td>
			      <td>{{$motif->txtMotiDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$motif->strMotiCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($motif->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$motif->strMotiCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$motif->strMotiCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($motifs) > 0)
@foreach($motifs as $motif)
	<div class="ui modal" id="update{{$motif->strMotiCode}}">
	  <div class="header">Update Motif</div>
	  <div class="content">
	    {!! Form::open(['url' => '/motif/motif_update']) !!}
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
	    		{{ Form::hidden('motif_code', $motif->strMotiCode) }}
	    		<div class="required field">
	    			{{ Form::label('motif_name', 'Motif Name') }}
         			{{ Form::text('motif_name', $motif->strMotiName, ['placeholder' => 'Type Motif Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('motif_description', 'Motif Description') }}
          			{{ Form::textarea('motif_description', $motif->txtMotiDesc, ['placeholder' => 'Type Motif Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$motif->strMotiCode}}">
	  <div class="header">Deactivate Motif</div>
	  <div class="content">
	    <p>Do you want to delete this motif?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/motif/' . $motif->strMotiCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$motif->strMotiCode}}">
	  <div class="header">Restore Motif</div>
	  <div class="content">
	    <p>Do you want to Restore this motif?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/motif/motif_restore']) !!}
	  		{{ Form::hidden('motif_code', $motif->strMotiCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Motif</div>
	  <div class="content">
	    {!! Form::open(['url' => '/motif']) !!}
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
	    			{{ Form::label('motif_code', 'Motif Code') }}
         			{{ Form::text('motif_code', $newID, ['placeholder' => 'Type Motif Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('motif_name', 'Motif Name') }}
         			{{ Form::text('motif_name', '', ['placeholder' => 'Type Motif Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('motif_description', 'Motif Description') }}
          			{{ Form::textarea('motif_description', '', ['placeholder' => 'Type Motif Description', 'rows' => '2']) }}
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
    $('#motif').addClass("active grey");
    $('#event_content').addClass("active");
    $('#event').addClass("active");

    var table = $('#tblMotif').DataTable();
  });
</script>
@endsection