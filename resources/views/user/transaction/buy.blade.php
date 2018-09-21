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
        <div class="card mb-5 pt-2 col-md-12">
         <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active"  href="{{ url('/buy-coin-list') }}">Buy Token</a>
          </li>
           <li class="nav-item">
            <a class="nav-link"  href="{{ url('/deposit-list') }}">Wallet Transaction</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane  " id="home">
          </div>
          <div class="tab-pane active pr-4">
            <h5 class="mt-4 text-uppercase">Buy Kwatt transaction</h5>
            <div class="dropdown-divider"></div>
            <br/>           
            <table id="ico-table" class="display responsive nowrap" width="100%">
              <thead>
               <td>Sr.</td>
               <th>Token</th>      
               <th>Coin</th>
               <th>Coin Amount</th>                                                        
             </thead>
             <tbody>
              <?php $i=1; ?>
              @foreach($buy_data as $key)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{  $key->token }}</td>
                <td>{{  $key->type }}</td>
                 @if($key->ico_amount=='0')
                                                          <td><span class="badge badge-success">Commission</span></td>
                                                          @else
                                                          <td>{{  $key->ico_amount }}</td>
                                                          @endif
              </tr>
              @endforeach

            </tbody>
          </table>        
          <br/>
          <br/>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>


@endsection  