@extends('layouts.admin')

@section('title')
    Delivery
@endsection

@section('content')
    @if ($alert = Session::get('alert-success'))
    <div class="ui success message">
        <div class="header">Success!</div>
        <p>{{ $alert }}</p>
    </div>
    @endif

    <div class="row">
        <h1>Delivery</h1>
        <hr>
    </div>

    <div class="row">
        <button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>Add Delivery</button>
    </div>
    <div class="row">
        <table class="ui inverted table" id="tblDelivery">
          <thead>
            <tr>
                <th>Delivery</th>
                <th>Description</th>
                <th>Fee</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Deleted At</th>
                <th class="right aligned">Action</th>
            </tr>
          </thead>
          <tbody>
            @if(count($deliveries) < 0)
            <tr>
                <td colspan="3"><strong>Nothing to show.</strong></td>
            </tr>
            @else
                @foreach($deliveries as $delivery)
                <tr>
                  <td>{{$delivery->strDeliName}}</td>h
                  <td>{{$delivery->txtDeliDesc}}</td>
                  <td>{{$delivery->dblDeliFee}}</td>
                  <td>{{$delivery->created_at}}</td>
                  <td>{{$delivery->updated_at}}</td>
                  <td>{{$delivery->deleted_at}}</td>
                  <td class="right aligned">
                    <button class="ui inverted blue button" onclick="$('#update{{$delivery->strDeliCode}}').modal('show');"><i class="edit icon"></i> Update</button>
                    @if($delivery->deleted_at == null)
                    <button class="ui inverted red button" onclick="$('#delete{{$delivery->strDeliCode}}').modal('show');"><i class="delete icon"></i> Delete</button>
                    @else
                    <button class="ui inverted orange button" onclick="$('#restore{{$delivery->strDeliCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
                    @endif
                  </td>
                </tr>
                @endforeach
            @endif  
          </tbody>
        </table>
    </div>

@if(count($deliveries) > 0)
@foreach($deliveries as $delivery)
    <div class="ui modal" id="update{{$delivery->strDeliCode}}">
      <div class="header">Update Delivery</div>
      <div class="content">
        {!! Form::open(['url' => '/delivery/delivery_update']) !!}
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
                {{ Form::hidden('delivery_code', $delivery->strDeliCode) }}
                <div class="required field">
                    {{ Form::label('delivery_name', 'Delivery Name') }}
                    {{ Form::text('delivery_name', $delivery->strDeliName, ['placeholder' => 'Type Delivery Name']) }}
                </div>
                <div class="required field">
                    {{ Form::label('delivery_description', 'Delivery Description') }}
                    {{ Form::text('delivery_description', $delivery->txtDeliDesc, ['placeholder' => 'Type Delivery Description']) }}
                </div>
                <div class="required field">
                    {{ Form::label('delivery_fee', 'Delivery Fee') }}
                    <div class="ui right labeled input">
                    <div class="ui label">P</div>
                    {{ Form::text('delivery_fee', $delivery->dblDeliFee, ['placeholder' => 'Fee']) }}
                    </div>
                </div>
            </div>
        </div>
      <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
      </div>
    </div>

    <div class="ui modal" id="delete{{$delivery->strDeliCode}}">
      <div class="header">Delete Delivery</div>
      <div class="content">
        <p>Do you want to delete this delivery?</p>
      </div>
      <div class="actions">
        {!! Form::open(['url' => '/delivery/' . $delivery->strDeliCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
      </div>
    </div>

    <div class="ui modal" id="restore{{$delivery->strDeliCode}}">
      <div class="header">Restore Delivery</div>
      <div class="content">
        <p>Do you want to Restore this delivery?</p>
      </div>
      <div class="actions">
        {!! Form::open(['url' => '/delivery/delivery_restore']) !!}
            {{ Form::hidden('delivery_code', $delivery->strDeliCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
      </div>
    </div>
@endforeach
@endif

    <div class="ui modal" id="create">
      <div class="header">Add Delivery</div>
      <div class="content">
        {!! Form::open(['url' => '/delivery']) !!}
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

                <div class="required field">
                    {{ Form::label('delivery_code', 'Delivery Code') }}
                    {{ Form::text('delivery_code', $newID, ['placeholder' => 'Type Delivery Code']) }}
                </div>
                <div class="required field">
                    {{ Form::label('delivery_name', 'Delivery Name') }}
                    {{ Form::text('delivery_name', null, ['placeholder' => 'Type Delivery Name']) }}
                </div>
                <div class="sfield">
                    {{ Form::label('delivery_description', 'Delivery Description') }}
                    {{ Form::textarea('delivery_description', null, ['placeholder' => 'Type Delivery Description', 'rows' => '2']) }}
                </div>
                <div class="required field">
                    {{ Form::label('delivery_fee', 'Delivery Fee') }}
                    <div class="ui right labeled input">
                    <div class="ui label">P</div>
                    {{ Form::text('delivery_fee', null, ['placeholder' => 'Fee']) }}
                    </div>
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
    $('#delivery').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tblDelivery').DataTable({
        "columnDefs": [
            {
                "targets": [ 3, 4, 5 ],
                "visible": false,
            }
        ]
    });
  });
</script>
@endsection