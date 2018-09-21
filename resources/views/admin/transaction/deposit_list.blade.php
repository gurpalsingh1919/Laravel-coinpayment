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
                <h2>Deposit History</h2>
                <br/>

                <div class="row">
                   
                    <div class="col-md-12">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">Deposit History</h5>
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>
                                              <table id="ico-table" class="display responsive nowrap" width="100%">
                                                <thead>
                                                     <th>Sr.</th>
                                                      <th>coin</th>
                                                      <th>Amount</th> 
                                                      <th>status</th> 
                                                       <th>Name</th>
                                                       <th>Email</th>
                                                       <th>Transaction ID</th>
                                                       <th>Address</th>
                                                                       
                                                       <th>Date</th>
                                                    </thead>

                                                    <tbody>
                                                        <?php $i=1; ?>
                                                          @foreach($deposit_data as $key)
                                                          <tr>
                                                       <td>{{ $i++ }}</td>
                                                       <td>{{ $key->coin }}</td>
                                                       <td><?php echo number_format($key->amount,8); ?> </td>
                                                       <td> @if($key->status ==0)
                            <span class="badge badge-primary">Pending</span>
                            @elseif($key->status ==100)
                            <span class="badge badge-success">Success</span>
                            @else
                            <span class="badge badge-warning">Cancelled / Timed Out</span>
                            @endif</td>
                                                        <td>{{ $key->user_info->fullname }}</td>
                                                        <td>{{ $key->user_info->email }}</td>
                                                        <td>{{ $key->tx_id }}</td>
                                                        <td>{{ $key->address }}</td>
                                                        <td>{{  date_format($key->updated_at,"Y-m-d H:i") }}</td>

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