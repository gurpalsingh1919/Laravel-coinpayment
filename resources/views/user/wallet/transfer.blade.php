@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | Transfer
@endsection


@section('content')

    <div class="container-fluid">
            <div class="col">
                <br/>
                <br/>
                <h2>Transfer Kwatt</h2>
                <br/>
                <?php $user = Sentinel::getUser(); ?>
                  
                <div class="row">
                    <div class="col-md-4">
                            <div class="card mb-5 col-md-12">
                              <div class="card-header">
                                 <h5 class="text-uppercase">Total Kwatt : {{ $user->kwatt_balance }}</h5>
                            </div>

                        @if(session('error')) 
                        <div class="alert alert-danger alert-dismissable">
                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                       <strong>Error : </strong>   {{ session('error') }}
                     </div>@endif

                       @if(session('success')) 
                            <div class="alert alert-success alert-dismissable">
                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                       <strong>Success : </strong>   {{ session('success') }}
                     </div>@endif

                            <div class="card-body no-padding" >
                            <br/>

                            <div id="tran_div"></div>

                             <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label  class="col-form-label"> KWATT Amount To Transfer </label>
                                        <input type="number" class="form-control"  name="kwatt_amount" onkeyup="check_kwatt(this.value)" id="kwatt_coin"  placeholder="KWATT Amount">
                                    </div>
                             </div>

                              <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label  class="col-form-label"> UserName</label>
                                        <input type="text" class="form-control" onfocusout="check_username(this.value)"  name="username" id="username"  placeholder="Enter Username">
                                    </div>
                             </div>

                              <div class="form-group col-lg-12">
                                   <button type="submit" disabled="" onclick="trans_coin()" id="transfer-btn" class="btn btn-primary btn-sm">Transfer </button>
                              </div>   

                            </div>
                        </div>
                        
                    </div>

                    <div class="col-md-8">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">Transfer Coin History</h5>
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>
                                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                                <thead>
                                                     <td>Sr.</td>
                                                     <th>Token</th>      
                                                     <th>Coin</th>
                                                     <th>Description</th>   
                                                               
                                                    </thead>

                                                    <tbody>
                                                        <?php $i=1; ?>
                                                        @foreach($tran_data as $key)
                                                        <tr>
                                                          <td>{{ $i++ }}</td>
                                                          <td>{{ $key->token }}</td>
                                                          <td>KWATT</td>
                                                          <td>Transfer {{ $key->token }} KWATT  To  {{ $key->user_to->username }}</td>
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

        function check_kwatt(kwatt_amount)
        {
          var total_kwatt = "{{ $user->kwatt_balance }}";
          if(parseFloat(kwatt_amount) > parseFloat(total_kwatt))
          {
                $("#transfer-btn").prop('disabled', true);
                $('#tran_div').html("<div class='alert alert-danger'><strong>Not Enough!</strong> You Have No Enough Balance To Transfer</div>");
          }
          else
          {
               $("#transfer-btn").prop('disabled', false);
               $('#tran_div').empty();
          }
        }


        function check_username(unm)
        {
                   $.ajax({
                      type: 'POST',
                      url: '/check_username',
                      data: { username:unm,_token:"{{csrf_token()}}" },
                      success:  function(response)
                      {
                        if(response == 1)
                        {
                              $('#tran_div').empty();
                              $("#transfer-btn").prop('disabled', false);
                        }
                        else
                        {
                              $("#transfer-btn").prop('disabled', true);
                              $('#tran_div').html("<div class='alert alert-danger'><strong>No Found! </strong>  UserName No Found.</div>");
                        }
                      }
                    });
        }


        function trans_coin()
        {
          var kwatt_coin = $('#kwatt_coin').val();
          var username = $('#username').val();

               $.ajax({
                      type: 'POST',
                      url: '/add_transfer',
                      data: { username:username,kwatt_coin:kwatt_coin,_token:"{{csrf_token()}}" },
                      success:  function(response)
                      {
                              $("#transfer-btn").prop('disabled', false);
                              $('#tran_div').html("<div class='alert alert-success'><strong>Success </strong>  Transfer Token Successfully.</div>");
                                setTimeout(function(){ location.reload(); },1500);
                      }
                    });
        }
        
        </script>

@endsection  