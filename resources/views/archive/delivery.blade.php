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
        <a href="{{ url('/delivery') }}" class="ui brown button"><i class="arrow circle left icon"></i>Back to Delivery</a>
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
                  <td>Php {{$delivery->deliveryFee}}</td>
                  <td class="center aligned">
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
    <div class="ui modal" id="restore{{$delivery->deliveryCode}}">
      <div class="header">Restore Delivery</div>
      <div class="content">
        <p>Do you want to Restore this delivery?</p>
      </div>
      <div class="actions">
        {!! Form::open(['url' => '/delivery/delivery_restore']) !!}
            {{ Form::hidden('delivery_code', $delivery->deliveryCode) }}
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
    delivery_fee: {
        identifier : 'delivery_fee',
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
    $('.money').mask("##0.00", {reverse: true});
  });
</script>
@endsection
