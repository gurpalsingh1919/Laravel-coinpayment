@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | Add Money
@endsection


@section('content')

    <div class="container-fluid">
            <div class="col">
                <br/>
                <br/>
                <h2>Add USD Amount</h2>
                <br/>
                <?php $user = Sentinel::getUser(); ?>

                <div class="row">
                    <div class="col-md-12">

                            <div class="card mb-5 col-md-12">
                              
                              <div class="card-header">
                                <?php $temp_bal = 'usd_balance'; ?>
                                 <h5 class="text-uppercase">USD Balance : <?php echo number_format($user->$temp_bal,8); ?></h5>
                                 <div class="alert alert-info alert-dismissable small">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Alert: </strong>Use PayPal to add USD to your account, insert amount to be deposited and hit Add Money, this will redirect you to PayPal to complete the transaction.<br/> Once your transaction is complete, you will be redirected back to your account where you can see the positive balance in your wallet.</div>

                                  @if ($message = Session::get('success'))
                                    <div class="alert alert-success"> {!! $message !!}</div>
                                    <?php Session::forget('success');?>
                                  @endif
                                   @if ($message = Session::get('error'))
                                     <div class="alert alert-danger"> {!! $message !!}</div>
                                    <?php Session::forget('error');?>
                                    @endif
                                     <div class="card-body no-padding" id="address_div">
                            </div>
                            </div>

                           

                            <div class="card-body no-padding" id="clear">
                           <br/>
                           
                            <form class="form-horizontal" onsubmit="get_deposit()" method="POST" id="payment-form" role="form" action="{{ route('postpaypal') }}" >
                                {{ csrf_field() }}
                             <div class="form-group col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Enter USD  </label>
                                        <input type="number" id="usd_value" placeholder="USD Amount" name="usd_amount" class="form-control" >
                                         @if ($errors->has('amount'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('usd_amount') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                            </div>

                            

                              <div class="form-group col-lg-12" id="deposit_div">
                                   <button  class="btn btn-primary btn-sm">Add Money</button>
                              </div>   

                                 <div class="form-group col-lg-12" id="loader_div" style="display: none;">
                                   <button class="btn btn-default btn-sm"><img src="{{ url('/') }}/upload/green.gif" style="width: 30px;height: 30px;">&nbsp; Loading....</button>

                              </div>   
                            </form>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-12">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">Deposits USD History</h5>
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>
                                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                                <thead>
                                                     <th>Sr.</th>

                        <th>Coin</th> 
                        <th>Amount</th> 
                        <th>Status</th> 
                        <th>Transaction ID</th> 
                        <th>Address</th>              
                                                    </thead>

                                                    <tbody>
                                                    <?php $i=1; ?>
                                                      @foreach($deposit_data as $key)
                                                      <tr>
                                                          <td>{{ $i++ }}</td>
                           <td>{{ $key->coin }}</td>
                           <td><?php echo number_format($key->amount,8); ?> </td>
                            <td>
                              @if($key->status ==0)
                              <span class="badge badge-primary">Pending </span>
                              @elseif($key->status ==100)
                              <span class="badge badge-success">Success</span>
                              @else
                              <span class="badge badge-warning">Cancelled / Timed Out</span>
                              @endif
                            </td>
                           <td>{{ $key->tx_id }}</td>
                           <td>{{ $key->address }}</td>
                                                    </tr>
                                                      @endforeach
                                                           
                                                       
                                                         
                                                    </tbody>
                                            </table>
                                    </div>
                                </div>
                    </div>
                 
                </div>

            </div>
        </div>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="paypalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <p>Now you are redireting to paypal please wait.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id='Yes' class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div> -->
        <script type="text/javascript">

 
          
      $("#payment-form").submit(function(e) {
   var $form = $(this).closest('form');
    var usd_val = $('#usd_value').val();
              if(usd_val == '')
              {
                  $('#address_div').empty();
                  $('#address_div').html("<div class='alert alert-danger'>Enter USD Amount First.</div>");
                    e.preventDefault();
              }
              else
              {
               // $('#paypalModal').modal('show').one('click', '#Yes', function(e) {
                 // $form.trigger('submit');
               // });
                $('#deposit_div').hide();
                 $('#loader_div').show();
              }
});
        </script>

@endsection  



