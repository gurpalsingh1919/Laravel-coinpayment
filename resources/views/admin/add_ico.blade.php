@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt
@endsection


@section('content')
@section('style')
<style type="text/css">
.loaderclass{
        margin-left: -163px;
    display: flex;
    padding-right: 16px;
    overflow: hidden;
    background: #5aa01d;
    color: #fff;
}
.loadertoken{
        margin-left: -110px;
         overflow: hidden;
    background: #5aa01d;
    color: #fff;
}
</style>
@endsection


<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills nav-fill theme-tab">
                <li class="nav-item">
                    <a class="nav-link @if(!session('validator')) active @endif" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">ICO setting</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade @if(!session('validator'))  show active @endif" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="col-md-12">
                       <!--  <form class="form-horizontal theme-form mt-5 row" id="addcoin-form" action="{{url('ico-update')}}" method="post" >     -->
                            @if(session('success'))
                                <div class="alert alert-success">
                                    <strong>Success : </strong>{{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <strong>Error : </strong> {{ session('error') }}
                                </div>
                            @endif 

                           <!--  <input type="hidden" name="_token" value="{{csrf_token()}}"> -->
                           <span id="showerror" class="col-sm-6"></span> 
                       
                             
                            <div class="row">       
                                <div class="form-group col-md-6">
                                     
                                    <label for="kwatt_amount">Add/Remove KWATT</label>
                                    
                                    <input type="number"  class="form-control" name="kwatt_amount" id="kwatt_amount" autocomplete="off">
                                    @if ($errors->has('kwatt_amount'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('kwatt_amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              
                                    <div class="form-group col-md-2 deposit_div"> <button type="submit" onclick="addcoinamount('add')" class="btn-sm btn btn-primary mt-4">Add</button>
                                    </div>
                                     <div class="form-group col-md-2 deposit_div"><button type="submit" class="btn-sm btn btn-primary mt-4" onclick="addcoinamount('remove')">Remove</button>
                                     </div>
                                 
                                <div class="form-group col-lg-2" id="loader_div" style="display: none;">
                                   <button class="btn btn-default btn-sm loaderclass"><img src="{{ url('/') }}/upload/green.gif" style="width: 60px;height: 55px;">&nbsp; Loading....</button>

                              </div>  
                                 </div>
                            
                      <!--   </form> -->
                    </div>



                    <div class="col-md-12">
                         @if(session('successtoken'))
                                <div class="alert alert-success">
                                    <strong>Success : </strong>{{ session('successtoken') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <strong>Error : </strong> {{ session('error') }}
                                </div>
                            @endif 
                            <div id="showerrorontoken"></div>
                                        <div class="row">       
                                <div class="form-group col-md-3">
                                     
                                    <label for="token_amount">Token Price</label>
                                    
                                    <input type="number"  class="form-control" name="token_amount" id="token_amount"  autocomplete="off" 
                                    value="{{$setting->usd_rate}}">
                                    @if ($errors->has('token_amount'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('token_amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              <div class="form-group col-md-3">
                                     
                                    <label for="referal_bonus">Referal Bonus</label>
                                    
                                    <input type="number"  class="form-control" name="referal_bonus" id="referal_bonus" value="{{$setting->referal_bonus}}" autocomplete="off">
                                    @if ($errors->has('referal_bonus'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('referal_bonus') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              
                                    <div class="form-group col-md-2" id="deposit_tokendiv"> <button type="submit" onclick="updatetokenamount()" class="btn-sm btn btn-primary mt-4">Save</button>
                                    </div>
                                     <div class="form-group col-lg-2 loader_tokendiv" style="display: none" >
                                   <button class="btn btn-default btn-sm loadertoken"><img src="{{ url('/') }}/upload/green.gif" style="width: 60px;height: 55px;">&nbsp; Loading....</button>

                              </div>  
                                 
                              
                                 </div>
                             </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
   



<script type="text/javascript">
  function addcoinamount(type){
    
        var kwatt_val = $('#kwatt_amount').val();
       // alert(kwatt_val);
        if(kwatt_val=='')
        {
            $('#showerror').empty();
            $message="<div class='alert alert-danger'>Enter Kwatt Amount</div>";
            //$('#showerror').addClass('alert alert-danger').html($message);
            $('#showerror').html($message);
           event.preventDefault();
                return false;  
        }
        else
        {
            $('#loader_div').show();
            $('.deposit_div').hide();
        }

        $.ajax({
              type: 'POST',
              url: "{{url('posticoadd')}}",
              data: {kwatt_amount:kwatt_val,icotype:type,_token:"{{csrf_token()}}" },
              success:  function(data)
              {
                  console.log(data);
                   $('#loader_div').hide();
                    $('.deposit_div').show();
                    if(type=='add')
                    {
                         $message="<div class='alert alert-success'>KWATT Added Successfully</div>";
                    }
                    else if(type=='remove')
                    {
                         $message="<div class='alert alert-success'>KWATT Removed Successfully</div>";
                    }
                    
                        //$('#showerror').addClass('alert alert-danger').html($message);
                    $('#showerror').html($message);
              }
            });


    }

    function updatetokenamount()
    {
       //alert("456");
        var kwatt_val = $('#token_amount').val();
        var referalBonus = $('#referal_bonus').val();
        if(kwatt_val=='' || referalBonus=='')
        {
            $('#showerrorontoken').empty();
            $message="<div class='alert alert-danger'>Enter Token Amount</div>";
            //$('#showerror').addClass('alert alert-danger').html($message);
            $('#showerrorontoken').html($message);
           event.preventDefault();
                return false;  
        }
        else
        {
           $('.loader_tokendiv').show();
            $('#deposit_tokendiv').hide();
        }

        $.ajax({
              type: 'POST',
              url: "{{url('posttokenamount')}}",
              data: {token_amount:kwatt_val,referal_bonus:referalBonus,_token:"{{csrf_token()}}" },
              success:  function(data)
              {
                $('.loader_tokendiv').hide();
                $('#deposit_tokendiv').show();
                 $message="<div class='alert alert-success'>Token/referral Amount Updated Successfully</div>";
                    //$('#showerror').addClass('alert alert-danger').html($message);
                    $('#showerrorontoken').html($message); 
              }
            });

    }
</script>
