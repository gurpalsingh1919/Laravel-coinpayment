@extends('layouts.master')
@section('title') My Order @endsection
@section('style')
@endsection
@section('content')



<div class="container-fluid">
   	<div class="col"><br/><br/>
    	<div class="row d-flex justify-content-center">

        <div class="col-lg-9  card mb-5">

      <h2 class="mb-0 pt-3 text-uppercase" align="center"><strong>Billing Information</strong></h2>

          <div class="pt-4 pb-4">
             <form method="post" action="{{$payment_url}}" class="payment-form" onsubmit="return validatecred()">
                  <div class="row">
                  	<div class="col-lg-6">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="billingfirstname" value="{{$first_name}}" id="billingfirstname">
                    <span class="error" id="ferror"></span>
                  </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" name="billinglastname" value="{{$last_name}}" id="billinglastname">
                    <span class="error" id="lerror"></span>
                  </div>
                  </div>
                  <div class="col-lg-6">
               <div class="form-group">
                    <label>Premise</label>
                    <input type="text" class="form-control" placeholder="Premise" name="billingpremise" value="{{$user->address}}" id="billingpremise">
                    <span class="error" id="perror"></span>
                  </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="form-group">
                    <label>Street</label>
                    <input type="text" class="form-control" placeholder="Street" name="billingstreet" value="{{$user->city}}" id="billingstreet">
                    <span class="error" id="serror"></span>
                  </div>
                  </div>
                  <div class="col-lg-6">
               <div class="form-group">
                    <label>Town</label>
                    <input type="text" class="form-control" placeholder="Town" name="billingtown" value="{{$user->town}}" id="billingtown">
                    <span class="error" id="berror"></span>
                  </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="form-group">
                    <label>Country</label>
                    <select class="form-control"  name="billingcountryiso2a" id="billingcountryiso2a">
                     @foreach($countries as $key=>$countr)
                      <option class="dropdown-item" value="{{$key}}" {{ $user->country === $countr? 'selected' : '' }} >{{$countr}}</option>
                      @endforeach

                  </select>
                    <span class="error" id="cuerror"></span>
               </div>

               </div>
               <div class="col-lg-4">
               <div class="form-group">
                    <label>Zipcode</label>
                    <input type="text" value="{{$user->zipcode}}" class="form-control" placeholder="Zipcode" name="billingpostcode" id="billingpostcode">
                    <span class="error" id="zerror"></span>
                  </div>
                  </div>
                  <div class="col-lg-4">
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" value="{{$user->phone}}"  class="form-control" placeholder="Phone Number" name="billingtelephonetype" id="billingtelephonetype">
                    <span class="error" id="pherror"></span>
                  </div>
                  </div>
                  <div class="col-lg-4">
               <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Email" name="billingemail" value="{{$email}}" id="billingemail">
                    <span class="error" id="Emerror"></span>
                  </div>
                  </div>
                  <div class="col-lg-12">
                  <div class="form-group">
<input type="hidden" name="orderreference" value="{{$merchant_id}}-{{$order_id}}" >
<input type="hidden" name="mainamount" value="{{$usd_amount}}" >
<input type="hidden" name="payment_notification_url" value="{{ url('/') }}/AnOtherIpnHandler">
<input type="hidden" name="payment_redirect_url" value="{{url('/')}}/payment-callback-url">
<input type="hidden" name="merchant_id" value="{{$merchant_id}}">
                  </div>
                  </div>
                  <div class="col-lg-12">
                  <div class="d-flex justify-content-center row">
                  <div class="col-lg-6">
               <div class="form-group">
             <input type="submit" name="submit" id="submit" class="btn btn-sm btn-primary btn-block" value="pay">
          </div>
          </div>
          </div>
          </div>
          </div>
             </form>
          </div>
        </div>
  		</div>
	</div>
</div>
@endsection
<script type="text/javascript" src="{{ url('/') }}/back/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
  function validatecred(){
   var valid = true;
    if ($('#billingfirstname').val() == '') {
        document.getElementById("ferror").innerHTML = "Please Enter Your FirstName";
        valid = false;
        //return false;
    }
    else
    {
       document.getElementById("ferror").innerHTML = "";
    }

    if ($('#billinglastname').val() == '') {
        document.getElementById("lerror").innerHTML = "Please Enter Your LastName";
        valid = false;
    }
    else
    {
       document.getElementById("lerror").innerHTML = "";
    }

    if ($('#billingpremise').val() == '') {
        document.getElementById("perror").innerHTML = "Please Enter Your Premise";
        valid = false;
    }
    else
    {
       document.getElementById("perror").innerHTML = "";
    }

    if ($('#billingstreet').val() == '') {
      document.getElementById("serror").innerHTML = "Please Enter Your Street";
        errorMessage="Please Enter Your Street";
        valid = false;
    }
    else
    {
       document.getElementById("serror").innerHTML = "";
    }

    if ($('#billingtown').val() == '') {
        document.getElementById("berror").innerHTML = "Please Enter Your Town";
        valid = false;
    }
    else
    {
       document.getElementById("berror").innerHTML = "";
    }

    if ($('#billingcountryiso2a').val() == '') {
        document.getElementById("cuerror").innerHTML = "Please Enter Your Country";
        valid = false;
    }
    else
    {
       document.getElementById("cuerror").innerHTML = "";
    }

     // valid = true;
    if ($('#billingpostcode').val() == '') {
        document.getElementById("zerror").innerHTML = "Please Enter Your Zipcode";
        valid = false;
    }
    else
    {
       document.getElementById("zerror").innerHTML = "";
    }
     // valid = true;
    if ($('#billingtelephonetype').val() == '') {
        document.getElementById("pherror").innerHTML = "Please Enter Your Phone";
        valid = false;
    }
    else
    {
       document.getElementById("pherror").innerHTML = "";
    }


    // valid = true;

    if ($('#billingemail').val() == '') {
        document.getElementById("Emerror").innerHTML = "Please Enter Your Email";
        valid = false;
    }
    else
    {
       document.getElementById("Emerror").innerHTML = "";
    }

    if (valid == false) {
      return false;
    }
    else
    {
      swal({title: 'Please Wait',allowOutsideClick: false,onOpen: () => {swal.showLoading()}});
      return true;

    }

}
</script>