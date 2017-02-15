@extends('layouts.admin')

@section('title')
	Food Category
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Food Category</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>Add Food Category</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblFoodCategory">
		  <thead>
		    <tr>
			    <th>Food Category</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($foodCategories) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($foodCategories as $foodCategory)
			  	<tr>
			      <td>{{$foodCategory->strFoodCateName}}</td>
			      <td>{{$foodCategory->txtFoodCateDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$foodCategory->strFoodCateCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($foodCategory->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$foodCategory->strFoodCateCode}}').modal('show');"><i class="delete icon"></i> Delete</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$foodCategory->strFoodCateCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif	
		  </tbody>
		</table>
	</div>

@if(count($foodCategories) > 0)
@foreach($foodCategories as $foodCategory)
	<div class="ui modal" id="update{{$foodCategory->strFoodCateCode}}">
	  <div class="header">Update Food Category</div>
	  <div class="content">
	    {!! Form::open(['url' => '/foodCategory/foodCategory_update']) !!}
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
	    		{{ Form::hidden('category_code', $foodCategory->strFoodCateCode) }}
	    		<div class="required field">
	    			{{ Form::label('category_name', 'Food Category Name') }}
         			{{ Form::text('category_name', $foodCategory->strFoodCateName, ['placeholder' => 'Type Food Category Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('category_description', 'Food Category Description') }}
          			{{ Form::textarea('category_description', $foodCategory->txtFoodCateDesc, ['placeholder' => 'Type Food Category Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$foodCategory->strFoodCateCode}}">
	  <div class="header">Delete Food Category</div>
	  <div class="content">
	    <p>Do you want to delete this food type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/foodCategory/' . $foodCategory->strFoodCateCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$foodCategory->strFoodCateCode}}">
	  <div class="header">Restore Food Category</div>
	  <div class="content">
	    <p>Do you want to Restore this food type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/foodCategory/foodCategory_restore']) !!}
	  		{{ Form::hidden('category_code', $foodCategory->strFoodCateCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">Add Food Category</div>
	  <div class="content">
	    {!! Form::open(['url' => '/foodCategory']) !!}
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
	    			{{ Form::label('category_code', 'Food Category Code') }}
         			{{ Form::text('category_code', $newID, ['placeholder' => 'Type Food Category Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('category_name', 'Food Category Name') }}
         			{{ Form::text('category_name', '', ['placeholder' => 'Type Food Category Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('category_description', 'Food Category Description') }}
          			{{ Form::textarea('category_description', '', ['placeholder' => 'Type Food Category Description', 'rows' => '2']) }}
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
    $('#foodCategory').addClass("active grey");
    $('#menu_content').addClass("active");
    $('#menu').addClass("active");

    var table = $('#tblFoodCategory').DataTable();
  });
</script>
@endsection