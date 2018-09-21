@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | Buy
@endsection


@section('content')

<div class="container-fluid">
    <div class="col">
        <br/>
        
        <br/>
        <div class="row">                   
            <div class="col-md-12">
                <div class="card mb-5 pt-3 pb-5 col-md-12">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link "  href="{{ url('/buy-coin-list') }}">Buy Token</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link active"  href="{{ url('/deposit-list') }}">Wallet Transaction</a>
                    </li>
                </ul>

<div class="tab-content">
                  <div class="tab-pane">
                  </div>
                  <div class="tab-pane active pr-4" >
                    <h5 class="mt-4 text-uppercase">Deposit History</h5>
                    <div class="dropdown-divider"></div>
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
                            <span class="badge badge-primary">Pending</span>
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
</div>


@endsection  