@extends('layouts.admin')

@section('title')
  Query
@endsection

@section('content')


  <div class="row">
    <h1>Query</h1>
    <hr>
  </div>


  
  <div class="required field">
           
           <h4>   {{ Form::select('uom_code', $query, null, ['placeholder' => 'Choose Query', 'class' => 'ui search dropdown']) }} </h4>
          </div>
          <div class="row"></div>
  <div class="row">
    <table class="ui table" id="tblquery">
      <thead>
        <tr>
          <th>Catering Package Name</th>
          <th>Rental Package Name</th>
          <th>Menu Name</th>
          <th>Item Name</th>
          
        </tr>
      </thead>
      <tbody>
         <tr>
          <td>PKG0001</td>
          <td>RNTPKG-001</td>
          <td>MEN001</td>
          <td>ITM0001</td>
        </tr>

        <tr>
          <td>PKG0002</td>
          <td>RNTPKG-002</td>
          <td>MEN002</td>
          <td>ITM0002</td>
        </tr>

        <tr>
          <td>PKG0003</td>
          <td>RNTPKG-003</td>
          <td>MEN003</td>
          <td>ITM0003</td>
        </tr>

        <tr>
          <td>PKG0004</td>
          <td>RNTPKG-004</td>
          <td>MEN004</td>
          <td>ITM0004</td>
        </tr>        

        <tr>
          <td>PKG0005</td>
          <td>RNTPKG-005</td>
          <td>MEN005</td>
          <td>ITM0005</td>
        </tr>

        <tr>
          <td>PKG0006</td>
          <td>RNTPKG-006</td>
          <td>MEN006</td>
          <td>ITM0006</td>
        </tr>

        <tr>
          <td>PKG0007</td>
          <td>RNTPKG-007</td>
          <td>MEN007</td>
          <td>ITM0007</td>
        </tr>

        <tr>
          <td>PKG0008</td>
          <td>RNTPKG-008</td>
          <td>MEN008</td>
          <td>ITM0008</td>
        </tr>

        <tr>
          <td>PKG0009</td>
          <td>RNTPKG-009</td>
          <td>MEN009</td>
          <td>ITM0009</td>
        </tr>

        <tr>
          <td>PKG0010</td>
          <td>RNTPKG-010</td>
          <td>MEN010</td>
          <td>ITM0010</td>
        </tr>
      </tbody>

    </table>
  </div>




@endsection

@section('js')
<script>


  $(document).ready( function(){
    $('#query').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    


  });



</script>
@endsection
