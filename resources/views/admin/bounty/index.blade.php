

@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | Admin Bounty
@endsection


@section('content')


    <div class="container-fluid">
            <div class="col">
                <br/>
                <br/>
                <h2>User's Bounty</h2>
                <br/>
                <div class="row">
                    <div class="col-md-12">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase"> <!-- title --></h5>
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>
                                                 <!-- <table class="table table-striped data-table"> -->
                                                   <table id="data-table" class="table table-striped data-table" cellspacing="0" width="100%">
                                                      <thead class="thead-dark">
                                                         <tr>
                                                            <th scope="col">Sr.</th>
                                                            <th scope="col">User Detail</th>
                                                            <th scope="col">Bounty Screenshots</th>
                                                            <th scope="col">Status</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                          <?php $i = 1;?>
                                                          @foreach($bounty_data as $key)
                                                          <tr>
                                                              <td>{{ $i++ }}</td>
                                                              <td><b>UserName : </b>{{ $key->user->username }}<br>
                                                                <b>Email : </b>{{ $key->user->email }}<br></td>
                                                              <td>

                                                                 @if($key->status == 0)
                                                                   <a href="{{ url('bounty_show',$key->id) }}"><button class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;View</button></a>
                                                                  @elseif($key->status == 1)
                                                                  <i class="fa fa-check" aria-hidden="true"></i>&nbsp; Approve
                                                                  @elseif($key->status == 2)
                                                                   <i class="fa fa-times" aria-hidden="true"></i>&nbsp;Reject
                                                                  @else
                                                                  @endif

                                                                </td>
                                                              <td>
                                                                    @if($key->status == 0)
                                                                  <i class="fa fa-spinner" aria-hidden="true"></i>&nbsp;pending
                                                                  @elseif($key->status == 1)
                                                                  <i class="fa fa-check" aria-hidden="true"></i>&nbsp; Approve
                                                                  @elseif($key->status == 2)
                                                                   <i class="fa fa-times" aria-hidden="true"></i>&nbsp;Reject
                                                                  @else
                                                                  @endif
                                                              </td>

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