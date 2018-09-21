@extends('layouts.master')
@section('title') My Order @endsection
@section('style')
@endsection
@section('content')



   	<div class="col"><br/><br/>
    	<div class="row d-flex justify-content-center">

        <div class="col-lg-10 ">
        <div class="card">

       
          <div class="card-body col-md-12 pt-4 pr-4 pl-4 pb-2">
            <div class="card-title">
    <h5 class="text-uppercase">Billing Information</h5>
  </div>
  <hr />
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error : </strong>   {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success : </strong>   {{ session('success') }}
                        </div>
                    @endif
        <form method="post" name="myform" action="{{url('/pay-with-master-card')}}" class="payment-form mb-0 active" onsubmit="return validatecred()" autocomplete="off">
            {{ csrf_field() }}
                  <div class="row">
                    <div class="col-lg-6">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" id="firstName" name="firstName" value="{{$first_name}}" autocomplete="off">
                    <span class="error" id="ferror">{{ $errors->first('firstName') }}</span>
                  </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" id="lastName" name="lastName" value="{{$last_name}}" autocomplete="off">
                    <span class="error" id="lerror">{{ $errors->first('lastName') }}</span>
                  </div>
                  </div>
                  <div class="col-lg-6">
               <div class="form-group">
                    <label>Address</label>

                    <input type="text" class="form-control" placeholder="address" id="address" name="address" value="{{$user->address}}" autocomplete="off">

                    <span class="error" id="perror">{{ $errors->first('address') }}</span>
                  </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="form-group">

                    <label>State</label>
                    <input type="text" class="form-control" placeholder="state" id="state" name="state" value="{{$user->city}}" autocomplete="off">
                    <span class="error" id="serror">{{ $errors->first('state') }}</span>
                  </div>
                  </div>
                  <div class="col-lg-6">
               <div class="form-group">

                    <label>City</label>
         
                    <input type="text" class="form-control" placeholder="city" id="city" name="city" value="{{$user->town}}" autocomplete="off">

                    <span class="error" id="berror">{{ $errors->first('city') }}</span>
                  </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="form-group">
                    <label>Country</label>
                    <select class="form-control"  name="country" id="country">
                     @foreach($countries as $key=>$countr)
                      <option class="dropdown-item" value="{{$countr}}" {{ $user->country === $countr? 'selected' : '' }} >{{$countr}}</option>
                      @endforeach

                  </select>
                    <span class="error" id="cuerror">{{ $errors->first('country') }}</span>
               </div>

               </div>
               <div class="col-lg-4">
               <div class="form-group">
                    <label>Zipcode</label>
                    <input type="text" value="{{$user->zipcode}}" class="form-control" placeholder="Zipcode" name="zip" id="zip" autocomplete="off">
                    <span class="error" id="zerror">{{ $errors->first('zip') }}</span>
                  </div>
                  </div>
                  <div class="col-lg-4">
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" value="{{$user->phone}}"  class="form-control" placeholder="Phone Number" name="phone" id="phone" autocomplete="off">
                    <span class="error" id="pherror">{{ $errors->first('phone') }}</span>
                  </div>
                  </div>
                  <div class="col-lg-4">
               <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Email" name="email" value="{{$email}}" id="email" autocomplete="off">
                    <span class="error" id="Emerror">{{ $errors->first('email') }}</span>
                  </div>
                  </div>

<input type="hidden" name="orderNo" value="{{$order_id}}" >
<input type="hidden" name="coin_amounts" value="{{$usd_amount}}" >
<input type="hidden" name="orderAmount" value="{{$usd_amount}}" >
<input type="hidden" name="orderCurrency" value="USD" >
<input type="hidden" name="orderAmount" value="{{$usd_amount}}" >
 <input type="hidden" name="csid" id='csid'>                  
 <input name="interfaceInfo"     value="transaction" type="hidden">
 <input name="returnUrl"     value="{{url('/master-card-return-url')}}" type="hidden">
 <input name="remark"     value="remark" type="hidden">
<input name="paymentMethod"     value="Credit Card" type="hidden"> 
<input name="card"     value="{{$card_type}}" type="hidden">               
               
          </div>
          </div>
        </div>
        </div>
        <div class="col-lg-10 mt-3 ">
        <div class="card">
          <div class="card-body p-4 col-md-12">
                 <div class="card-title d-flex justify-content-between">
                    <h5 class="text-uppercase ">Credit Card Information</h5>
                          @if($card_type=='visa')
                            <img style="height: 28px;" src="{{url('/')}}/back/images/visa-card.png" />
                          @elseif($card_type=='master')
                            <img src="{{url('/')}}/back/images/card.png" />
                          @endif
                        
                    </div>
                    <hr>
                  
                        <div class="row">
                        <div class="col-md-8">
                        <div class="form-group">
                          <label for="cc-number" class="control-label mb-1">Card number</label>
                           <div class="input-group">
                          <input id="cardNo" name="cardNo" type="number" class="form-control cc-number identified visa" autocomplete="off">
                          <div class="input-group-append">
                            <span class="input-group-text" style="min-width: inherit;">
                              @if($card_type=='visa')
                                <i class="fab fa-cc-visa"></i>
                              @elseif($card_type=='master')
                                <i class="fab fa-cc-mastercard"></i>
                              @endif
                              
                              
                            </span>
                        
                          </div>
                        </div>
                        <span class="error" id="carderror">{{ $errors->first('cardNo') }}</span>
                        <span class="error" id="digiterror"></span>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Expiration</label>
                                    <div class="row">
                                      <div class="col-lg-6"><select class="form-control" id="cardExpireMonth " name="cardExpireMonth">
                                      <!-- <option selected="selected">Select Month</option> -->
                                    @foreach($months as $key=>$month)
                                      <option class="dropdown-item" value="{{$key}}" >{{$month}}</option>
                                     @endforeach
                                      </select></div>
                                      <div class="col-lg-6">
                                        <select class="form-control" id="cardExpireYear " name="cardExpireYear">
                                       <!-- <option selected="selected">Select Year</option> -->
                                    @foreach($Year as $key=>$yr)
                                      <option class="dropdown-item" value="{{$yr}}" >{{$yr}}</option>
                                     @endforeach
                                      </select></div>
                                    </div>
                                    
                                    <span class="error" id="monthderror"> {{ $errors->first('cardExpireMonth') }}</span>
                                    <span class="error" id="yearerror">{{ $errors->first('cardExpireYear') }}</span>
                                </div>
                            </div>
                            </div>

                    <div class="row">
                       <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label mb-1">Security code</label>
                                 <div class="input-group">
                                    <input id="cardSecurityCode" name="cardSecurityCode" type="number" class="form-control cc-number identified visa" autocomplete="off">
                                  <div class="input-group-append">
                            <span class="input-group-text" style="min-width: inherit;"><i class="far fa-credit-card"></i></span>
                          </div>
                           </div>
                          <span class="error" id="scode">{{ $errors->first('cardSecurityCode') }}</span>
                          <span class="error" id="code_digit"></span>
                        </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                          <label class="control-label mb-1">Card Issuing Bank</label>
                           <div class="input-group">
                          <input id="issuingBank" name="issuingBank" type="text" class="form-control cc-number identified visa">
                           </div>
                          <span class="error" id="scode">{{ $errors->first('issuingBank') }}</span>
                          <span class="error" id="issuecode"></span>
                        </div>
                            </div>
                            </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-md btn-primary">
                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Pay <span>${{$usd_amount}} USD</span></span>
                               <!--  <span id="payment-button-sending" style="display:none;">Sending…</span> -->
                            </button>
                        </div>
                    </form>
          </div>
        </div>
        </div>
        </div>


  		</div>
	</div>
</div>
@endsection
<script type="text/javascript" src="{{ url('/') }}/back/js/jquery-3.3.1.min.js"></script>
<!-- <script type='text/javascript' charset='utf-8' src='http://cm.js.dl.saferconnectdirect.com/csid.js'></script> -->

 <!-- <script type='text/javascript' charset='utf-8' src='https://onlinesafest.com/pub/csid.js'></script>  -->

<script type="text/javascript">
  function validatecred(){
   var valid = true;
    if ($('#firstName').val() == '') {
        document.getElementById("ferror").innerHTML = "Please Enter Your FirstName";
        valid = false;
    }
    else
    {
      document.getElementById("ferror").innerHTML = "";
    }

    if ($('#lastName').val() == '') {
        document.getElementById("lerror").innerHTML = "Please Enter Your LastName";
        valid = false;
    }
    else
    {
       document.getElementById("lerror").innerHTML = "";
    }

    if ($('#address').val() == '') {
        document.getElementById("perror").innerHTML = "Please Enter Your Address";
        valid = false;
    }
    else
    {
       document.getElementById("perror").innerHTML = "";
    }

    if ($('#state').val() == '') {
      document.getElementById("serror").innerHTML = "Please Enter Your State";
        errorMessage="Please Enter Your Street";
        valid = false;
    }
    else
    {
       document.getElementById("serror").innerHTML = "";
    }

    if ($('#city').val() == '') {
        document.getElementById("berror").innerHTML = "Please Enter Your City";
        valid = false;
    }
    else
    {
       document.getElementById("berror").innerHTML = "";
    }

    if ($('#country').val() == '') {
        document.getElementById("cuerror").innerHTML = "Please Enter Your Country";
        valid = false;
    }
    else
    {
       document.getElementById("cuerror").innerHTML = "";
    }

     // valid = true;
    if ($('#zip').val() == '') {
        document.getElementById("zerror").innerHTML = "Please Enter Your Zipcode";
        valid = false;
    }
    else
    {
       document.getElementById("zerror").innerHTML = "";
    }
     // valid = true;
    if ($('#phone').val() == '') {
        document.getElementById("pherror").innerHTML = "Please Enter Your Phone";
        valid = false;
    }
    else
    {
       document.getElementById("pherror").innerHTML = "";
    }

     if ($('#issuingBank').val() == '') {
        document.getElementById("issuecode").innerHTML = "Please Enter Issue Card No";
        valid = false;
    }
    else
    {
       document.getElementById("issuecode").innerHTML = "";
    }

    if ($('#email').val() == '') {
        document.getElementById("Emerror").innerHTML = "Please Enter Your Email";
        valid = false;
    }
    else
    {
       document.getElementById("Emerror").innerHTML = "";
    }

    if ($('#cardNo').val() == '') {
        document.getElementById("carderror").innerHTML = "Please Enter Your Card No";
        valid = false;
    }
    else
    {
       document.getElementById("carderror").innerHTML = "";
    }

    if ($('#cardExpireMonth').val() == '') {
        document.getElementById("monthderror").innerHTML = "Please Enter The Month";
        valid = false;
    }
    else
    {
       document.getElementById("monthderror").innerHTML = "";
    }

    if ($('#cardExpireYear').val() == '') {
        document.getElementById("yearerror").innerHTML = "Please Enter The Year";
        valid = false;
    }
    else
    {
       document.getElementById("yearerror").innerHTML = "";
    }

    if ($('#cardSecurityCode').val() == '') {
        document.getElementById("scode").innerHTML = "Please Enter The Security";
        valid = false;
    }
     else
    {
       document.getElementById("scode").innerHTML = "";
    }

    /*Crad Digit Validation validation*/
    var mastercard = new RegExp("^[0-9]{16}$");
    if (!mastercard.test(document.myform.cardNo.value) && $('#cardNo').val() != '') {
        document.getElementById("digiterror").innerHTML = "Please Enter valid Card Numbers";
        valid =  false;
    }
    else
    {
       document.getElementById("digiterror").innerHTML = "";
    }
    /*End Card Digit Validation*/

    /*Security Code Validation*/
    var re3digit = /^\d{3}$/;
    if (!re3digit.test(document.myform.cardSecurityCode.value) && $('#cardSecurityCode').val() != '') {
        document.getElementById("code_digit").innerHTML = "Please Enter 3 Digit Security Code";
        valid =  false;
    }
    else
    {
       document.getElementById("code_digit").innerHTML = "";
    }

    /*End Security Code Validation*/

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