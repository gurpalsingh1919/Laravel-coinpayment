@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt
@endsection
@section('content')
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
<div class="container-fluid">
  <div class="col">
    <div class="col">
      <br/> <br/>
      <h2>Deposite History</h2>
      <br/>
      <div class="card mb-5">
        <div class="card-header">
          <h5 class="text-uppercase">Transaction History</h5>
        </div>
        <div class="card-body no-padding">
          <br/>
          <div class="col">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            @if(session('error'))<br><div class="alert alert-danger">{{ session('error') }}</div><br>@endif
            @if(session('success'))<br><div class="alert alert-success">{{ session('success') }}</div><br>@endif
            <table id="data-table" class="table table-striped data-table" cellspacing="0" width="100%">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Sr.</th>
                  <th scope="col">Username</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Type</th>
                  <th scope="col">Address</th>
                  <th scope="col">Txid</th>
                  <th scope="col">Status</th>
                  <th scope="col">Created On</th>
                  <th scope="col">Description</th>
                  <th scope="col">Admin</th>
               </tr>
              </thead>
              <tbody>
                <?php $i=1;  ?>
                @foreach($withdraw_data as $key)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$key->user_info->username}}</td>
                    <td>{{$key->amount}}</td>
                    <td>{{$key->type}}</td>                
                    <td>{{$key->address}}</td>
                    <td>{{$key->txid }}</td>
                    <td>
                        @if($key->status == 0)
                            <span class="badge badge-warning">Pending</span>           
                        @elseif($key->status == 1)
                            <span class="badge badge-success">Confirm</span>
                        @else
                        @endif
                    </td>
                    <td>{{$key->created_at}}</td>
                    <td>{{$key->description}}</td>
                      <td>
                          @if($key->status == 0 )
                              <button onclick="confirmStatus('{{$key->id}}','1')"  class="btn btn-success btn-sm"> Confirm </button>
                              <button onclick="rejectStatus('{{$key->id}}','2')"  class="btn btn-danger btn-sm"> Reject </button>
                          @else
                              -
                          @endif
                      </td>
                  </tr>
                @endforeach 
              </tbody>
            </table><BR/>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection