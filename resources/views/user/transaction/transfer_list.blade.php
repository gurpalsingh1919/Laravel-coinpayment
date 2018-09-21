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
                <h2>Transfer Kwatt History</h2>
                <br/>

                <div class="row">
                    <div class="col-md-12">

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


@endsection  