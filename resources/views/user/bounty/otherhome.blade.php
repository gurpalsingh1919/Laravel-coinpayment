@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | Bounty
@endsection


@section('content')

    <div class="container-fluid">
            <div class="col">
                <br/>
                <br/>
                <h2>Bounty Details</h2>
                <br/>

                <div class="card mb-5 col-md-12">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error : </strong>   {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success : </strong>   {{ session('success') }}
                    </div>
                @endif
               

                    <div class="card-header">
                        <h5 class="text-uppercase">Bounty</h5>
                           <a style="float: right;" href="{{ url('screen-upload',$service) }}"><button class="btn btn-warning"><i class="fa fa-cloud-upload"></i>&nbsp;Upload Screenshots</button></a>
                    </div>
                    <div class="card-body no-padding">
                        <br/>
                        <div class="col">
           <div>
              @if($service == 'reddit')
                        Reddit Share Functionality &nbsp;&nbsp;&nbsp;
                        <a target="_blank" href="https://www.reddit.com/submit?url=&title=" class="btn btn-success"><i class="fa fa-reddit-alien" aria-hidden="true"></i>&nbsp;Share</a>
                        @endif


            <div class="row">
                <div class="col-md-12">
                    <table id="data-table" class="table table-striped data-table" cellspacing="0" width="100%">
                        <thead  class="thead-dark">
                            <th scope="col">Sr No.</th>
                            <th scope="col">Bounty For</th>
                            <th scope="col">Document</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </thead>
                        <tbody>
                     <?php $i = 1;?>
                    @foreach($other_data as $key)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $service }}</td>
                        <td><img src="{{ url('/') }}/upload/bounty/{{ $key->document }}" height="70px"></td>
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

                        <td>
                        @if($key->status == 0)
                       <a href="{{ url('del_bounty',$key->id) }}"><button class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Delete</button></a>
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
                            <br/>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection  