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
                <h2>Bounty</h2>
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
                    </div>
                    <div class="card-body no-padding">
                        <br/>
                        <div class="col">
                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                <thead>
                                        <th>Social Media</th>  
                                        <th>Name</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('/') }}/icon/fb.png"  style="height: 30px;width: 30px;"></td>
                                            <td>Facebook</td>
                                            <td><a href="{{ url('go_to/facebook') }}"><button class="btn btn-primary btn-sm">Facebook</button></a></td>
                                        </tr>

                                        <tr>
                                            <td><img src="{{ url('/') }}/icon/tw.png"  style="height: 30px;width: 30px;"></td>
                                            <td>Twitter</td>
                                            <td><a href="{{ url('redirect/twitter') }}"><button class="btn btn-primary btn-sm">Twitter</button></a></td>
                                        </tr>

                                        <tr>
                                            <td><img src="{{ url('/') }}/icon/btc_talk.png"  style="height: 30px;width: 30px;"></td>
                                            <td>BitCointalk</td>
                                            <td><a href="{{ url('go_to/bitcointalk') }}"><button class="btn btn-primary btn-sm">BitCointalk</button></a></td>
                                        </tr>

                                        <tr>
                                            <td><img src="{{ url('/') }}/icon/reddit.png"  style="height: 30px;width: 30px;"></td>
                                            <td>Reddit</td>
                                            <td><a href="{{ url('go_to/telegram') }}"><button class="btn btn-primary btn-sm">Reddit</button></a></td>
                                        </tr>
                                    
                                    </tbody>
                            </table>
                            <br/>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection  