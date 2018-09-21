@extends('layouts.master')
@section('title') Withdraw Kwatts @endsection
@section('style')
@endsection
@section('content')

<div class="container-fluid">
    <div class="col"><br/><br/>
      <div class="row">
         <div id="withdrawl" class="card mb-5">

  <div class="card-header">
    <h5 class="text-uppercase text-center">Withdraw KWATTS</h5>
  </div><br/>
  <div class="card-body col-md-12">
  <div class="row justify-content-md-center">
  <div class="col-md-11">
  <div class='small-text-info md-text-info p-3'>

         <ul class="pl-3">
                <li> KWATTs will be eligible for withdrawal to your myetherwallet address provided below at the end of the ICO.</li>
                <li>Any bonus KWATTs earned will also be released to your myetherwallet address at the end of
the ICO.</li>
              </ul>
            </div>
          </div>
<div class="col-md-11">

     <div class="row">
     <div class="col-md-6">

          <h5 class="mt-3">Myetherwallet Address</h5>
          <div class="input-group">

            <input type="text" class="form-control" id="withaddress" name="withaddress" value="" placeholder="Please Enter MyEtherwallet Address"><span class="input-group-btn">
            <button class="btn btn-sm btn-primary" id="withdrawlkwatt" type="submit">Submit</button></span>
          </div>

    </div>
    </div>
</div>
</div>


    </div>

<br/>
</div>
      </div>
  </div>
</div>
       


@endsection





 