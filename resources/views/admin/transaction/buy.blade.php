@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | Admin Buy
@endsection


@section('content')

    <div class="container-fluid">
            <div class="col">
                 <br/>
                <br/>
               <!-- <h2>Buy Kwatt History</h2>
                <br/> -->

                <div class="row">
                   
                    <div class="col-md-12">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">Transactions History</h5>
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>
                                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                                <thead>
                                                     <td>Sr.</td>
                                                     <td>Name</td>
                                                     <td>Email</td>
                                                     <th>KWATTs</th>
                                                     <th>Status</th>
                                                     <th>Coin Type</th>
                                                     <th>Coin Amount</th>
                                                     <th>Txn Type</th>   
                                                     <th>Date</th>
                                                    <!--  <th>Option</th> -->
                                                     <th>Transaction id</th>
                                                     <!-- <th>Remark</th>
                                                     <th>Approved By</th> -->

                                                    </thead>

                          <tbody>
                              <?php $i=1; ?>
                              @foreach($buy_data as $key)
                              <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{  $key->get_user_info->fullname }}</td>
                                <td>{{  $key->get_user_info->email }}</td>
                                <td>{{  $key->no_of_kwatt }}</td>
                                
                                <td>
                       @if($key->status ==100)
                        <span class="badge badge-success">Paid</span>
                        @elseif($key->status == -1)


                        <span class="badge badge-danger">expired </span>

                        @else
                         <span class="badge badge-warning">Pending </span>
                        @endif
                      </td>


                                <td>{{  $key->type }}</td>
                                <td>{{  $key->coin_amount }}</td>
                                <td> @if($key->txn_type==1)
                                      {{  'Added' }}
                                      @elseif($key->txn_type==2)
                                      {{  'Buy' }}
                                      @elseif($key->txn_type==3)
                                      {{  'Withdraw' }}
                                      @elseif($key->txn_type==4)
                                      {{  'Bonus' }}
                                      @elseif($key->txn_type==5)
                                      {{  'Removed' }}
                                      @endif</td>

                                <td>{{  date_format($key->updated_at,"Y-m-d") }}</td>
                                
                            <!-- <td>
                              @if($key->status == 0)
                             
                              @if($key->txn_type == 2 || $key->txn_type == 3)
                              <button class="btn-sm btn btn-primary" onclick="acceptpayment({{$key->id}})">Paid</button>
                              @endif
                              
                              @elseif($key->status == -1)
                                Cancel
                              @elseif($key->status == 100)
                                Success
                              @else
                              @endif
                            </td> -->
                         <td>{{  $key->tx_id }}</td>
                        <!--  <td>{{  $key->remark }}</td>
                         <td>
                          @if(isset($key->get_approved_info->fullname))
                          {{  $key->get_approved_info->fullname }}
                        @endif</td> -->
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


@endsection  
<script type="text/javascript">
  function acceptpayment(id)
  {
    //alert(id);
    var trans_id=id;
    if(trans_id !='')
    {
      swal({
              title: 'Important! you are making the transaction as paid. Are you Sure?',
              input: 'text',   
                  inputPlaceholder:"Remarks",
                  inputClass:"form-control",
                  //html: message,
                   
                  showCancelButton: true,
                 // onfirmButtonText: 'Mark as Paid',
                  confirmButtonText: 'Mark as Paid',
                  confirmButtonClass: 'btn btn-primary',
                  confirmButtonColor: '#7dc242',
                  }). then(function(result){
                    //console.log(result);
                    if(result.value)
                    {
                      var remarks=result.value;
                        approveuserrpayment(trans_id,remarks)
                    }
                    
                     });
      }

  }

function approveuserrpayment(trans_id,remarks)
{
  var url='accept-payment';
  var csrftoken= $('input[name=_token]').val();
  $.ajax({
              type: 'POST',
              url: url,
              data: { transaction_id:trans_id,admin_remark:remarks,_token:csrftoken },
              success:  function(data)
              {
                //console.log(data);
                if(data.status==1)
                {
                   var msg=data.message;
                  //swal(msg);
                    swal({
                            title: data.message,
                            showConfirmButton: 'OK'
                        }). then(function(result){
                 window.location.href = "admin-buy";

                   });
        
                  
                }
                else
                {
                  var msg=data.message;
                  swal(msg);
                  return false;
                }
              }
          });
}
</script>