@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | Deposits
@endsection


@section('content')

    <div class="container-fluid">
            <div class="col">
                <br/>
                <br/>
                <h2>Deposits {{ $coin }}</h2>
                <br/>
                <?php $user = Sentinel::getUser(); ?>

                <div class="row">
                    <div class="col-md-4">

                            <div class="card mb-5 col-md-12">
                              
                              <div class="card-header">
                                <?php $temp_bal = strtolower($coin).'_balance'; ?>
                                 <h5 class="text-uppercase">{{ $coin }} Balance : <?php echo number_format($user->$temp_bal,8); ?></h5>
                            </div>

                            <div class="card-body no-padding" id="address_div">
                            </div>

                            <div class="card-body no-padding" id="clear">
                           <br/>
                             <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Enter USD </label>
                                        <input type="text" id="usd_value" placeholder="USD Amount" onkeyup="get_live()" class="form-control" >
                                    </div>
                            </div>

                             <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label  class="col-form-label">  {{ $coin }} Amount </label>
                                        <input type="text" class="form-control"  id="btc_value" onkeyup="get_live1()" placeholder=" {{ $coin }} Amount">
                                    </div>
                             </div>

                              <div class="form-group col-lg-12" id="deposit_div">
                                   <button onclick="get_deposit()" class="btn btn-primary btn-sm">Deposit {{ $coin }}</button>
                              </div>   

                                 <div class="form-group col-lg-12" id="loader_div" style="display: none;">
                                   <button class="btn btn-default btn-sm"><img src="{{ url('/') }}/upload/green.gif" style="width: 30px;height: 30px;">&nbsp; Loading....</button>

                              </div>   

                            </div>
                        </div>
                        
                    </div>

                    <div class="col-md-8">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">Deposits {{ $coin }} History</h5>
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
                                                   <td><?php echo number_format($key->amount,8); ?></td>
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

        <script type="text/javascript">

 
          function  get_deposit() 
            {

             
              
                var usd_val = $('#usd_value').val();
                var btc_val =  $('#btc_value').val();

                if(btc_val == '')
                {
                    $('#address_div').empty();
                    $('#address_div').html("<div class='alert alert-danger'><strong>Not Enough! </strong> Enter USD Amount First.</div>");
                }
                else
                {
                   $('#loader_div').show();
                    $('#deposit_div').hide();
                }

                var coin = "{{ $coin }}";

                 $.ajax({
                      type: 'POST',
                      url: "{{url('get_deposit')}}",
                      data: {   btc_val:btc_val,coin:"{{ $coin }}",usd_amount:usd_val,_token:"{{csrf_token()}}" },
                      success:  function(data)
                      {
                        console.log(data);
                          $('#clear').empty();
                          $('#address_div').empty();

                                var html ="<div class='col-md-12'><center><img src='"+data.qrcode_url+"' class='img-fluid'><h3 style='color:white;'>≈ "+ coin +" Amount</h3>  <div class='form-group'><div class='input-group'><input type='text' class='form-control' value="+ data.amount +" id='post-shortlink22' readonly ><span class='input-group-btn'><button class='btn btn-secondary btn-copy' id='copy-button' data-clipboard-target='#post-shortlink' type='button' onclick='copytext22()'>copy</button></span> </div></div><h3  style='color:white;'>Send "+coin+" To This Address</h3> <div class='form-group'><div class='input-group'><input type='text' class='form-control' value="+ data.address +" id='post-shortlink11' readonly ><span class='input-group-btn'><button class='btn btn-secondary btn-copy' id='copy-button' data-clipboard-target='#post-shortlink' type='button' onclick='copytext11()' >copy</button></span> </div></div>  <h3 style='color:white;'>TXID (Informative)</h3><b>"+data.txn_id+"</b></center> </div><div class='mb-5'></div>";

                                $('#address_div').html(html);  

                                 $('#loader_div').hide();
                                 $('#deposit_div').show();    
                      }
                    });
            }

             function get_live()
            {
            
             var usd = $('#usd_value').val();
                   $('#address_div').empty();
                   $.ajax({
                      type: 'POST',
                      url: "{{url('get_live_value')}}",
                      data: { usd_val:usd,coin:"{{ $coin }}",_token:"{{csrf_token()}}" },
                      success:  function(response)
                      {
                        $('#btc_value').val(response);
                      }
                    });
             } 


             function get_live1()
            {
            
                  var coin_val = $('#btc_value').val();
                   $('#address_div').empty();

                   $.ajax({
                      type: 'POST',
                      url: '/get_live_value1',
                      data: {coin_val:coin_val,coin:"{{ $coin }}",_token:"{{csrf_token()}}" },
                      success:  function(response)
                      {
                        $('#usd_value').val(response);
                      }
                    });
           
                 
             } 

 function copytext11()
        {
           var copyText = document.getElementById("post-shortlink11");
          copyText.select();
            document.execCommand("Copy");
        }


  function copytext22()
        {
           var copyText = document.getElementById("post-shortlink22");
          copyText.select();
            document.execCommand("Copy");
        }

        </script>

@endsection  