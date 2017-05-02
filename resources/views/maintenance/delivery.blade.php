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
        <h1>Delivery</h1>
        <hr>
    </div>

    <div class="row">
        <button type="button" class="ui green button" onclick="$('#create').modal('show');" style="background-color: rgb(0,128,0);"><i class="add icon"></i>New Delivery</button>
        <a href="{{ url('/archive/delivery') }}" class="ui teal button" style="background-color: rgb(0,128,128);"><i class="archive icon"></i>Archive</a>
    </div>
    <div class="row">
        <table class="ui table" id="tbldelivery">
          <thead>
            <tr>
                <th>Location</th>
                <th>Fee</th>
                <th class="center aligned">Action</th>
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
                  <td>{{$delivery->deliveryLocation}}</td>
                  <td>Php {{number_format($delivery->deliveryFee, 2, '.', ',')}}</td>
                  <td class="center aligned">
                    <button class="ui blue button" onclick="$('#update{{$delivery->deliveryCode}}').modal('show');"><i class="edit icon"></i> Update</button>
                    @if($delivery->deleted_at == null)
                    <button class="ui red button" onclick="$('#delete{{$delivery->deliveryCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
                    @else
                    <button class="ui orange button" onclick="$('#restore{{$delivery->deliveryCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
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
    <div class="ui modal" id="update{{$delivery->deliveryCode}}">
      <div class="header">Update Delivery</div>
      <div class="content">
        {!! Form::open(['url' => '/delivery/delivery_update', 'id' => 'createForm', 'class' => 'ui form']) !!}
            <div class="ui form">
                <div class="ui error message"></div>
                {{ Form::hidden('delivery_code', $delivery->deliveryCode) }}
                <div class="required field">
                    {{ Form::label('delivery_location', 'Delivery Location') }}
                    {{ Form::text('delivery_location', $delivery->deliveryLocation, ['maxlength'=>'30','placeholder' => 'Type Delivery Location']) }}
                </div>
                <div class="required field">
                    {{ Form::label('amount', 'Delivery Fee') }}
                    <div class="ui center labeled input">
                    <div class="ui label">Php</div>
                    {{ Form::text('amount', $delivery->deliveryFee, ['maxlength'=>'8','class' => 'money', 'placeholder' => 'Fee']) }}
                    </div>
                </div>
            </div>
            
        </div>
      <div class="actions">
            {{ Form::button('Save', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
      </div>
    </div>

    <div class="ui modal" id="delete{{$delivery->deliveryCode}}">
      <div class="header">Deactivate Delivery</div>
      <div class="content">
        <p>Do you want to deactivate this delivery?</p>
      </div>
      <div class="actions">
        {!! Form::open(['url' => '/delivery/' . $delivery->deliveryCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
      </div>
    </div>

    <div class="ui modal" id="restore{{$delivery->deliveryCode}}">
      <div class="header">Restore Delivery</div>
      <div class="content">
        <p>Do you want to Restore this delivery?</p>
      </div>
      <div class="actions">
        {!! Form::open(['url' => '/delivery/delivery_restore']) !!}
            {{ Form::hidden('delivery_code', $delivery->deliveryCode) }}
            {{ Form::button('Yes', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
      </div>
    </div>
@endforeach
@endif

    <div class="ui modal" id="create">
      <div class="header">New Delivery</div>
      <div class="content">
        {!! Form::open(['url' => '/delivery', 'id' => 'createForm', 'class' => 'ui form']) !!}
            <div class="ui form">
                <div class="ui error message"></div>

                <div class="disabled field">
                    
                    {{ Form::hidden('delivery_code', $newID, ['placeholder' => 'Type Delivery Code']) }}
                </div>
                <div class="required field">
                    {{ Form::label('delivery_location', 'Delivery Location') }}
                    {{ Form::text('delivery_location', null, ['maxlength'=>'30', 'placeholder' => 'Type Delivery Location', 'autofocus' => 'true']) }}
                </div>
                <div class="required field">
                    {{ Form::label('amount', 'Delivery Fee') }}
                    <div class="ui center labeled input">
                    <div class="ui label">Php</div>
                    {{ Form::text('amount', null, ['maxlength'=>'8', 'class' => 'money', 'placeholder' => 'Fee']) }}
                    </div>
                </div>
            </div>
            
        </div>
        <div class="actions">
              {{ Form::button('Submit', ['type' => 'submit', 'class'=> 'ui positive button', 'style' => 'background-color: rgb(0,128,0)']) }}
              {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
<style>


        #amount{
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
    delivery_location: {
      identifier : 'delivery_location',
      rules: [
      {
        type   : 'empty',
        prompt : 'Please enter a location'
      },
      {
          

        type   : "regExp[^(?![0-9 '-]*$)[a-zA-Z0-9 '-]+$]",

            
             
        prompt: "Name can only consist of alphanumeric, spaces, apostrophe and dashes"
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




    $('#delivery').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tbldelivery').DataTable();
    $('.money').mask("#,##0.00", {reverse: true});
  });
</script>
@endsection
