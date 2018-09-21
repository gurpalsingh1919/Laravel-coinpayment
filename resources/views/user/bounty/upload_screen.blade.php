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
                    <div class="card-header">
                        <h5 class="text-uppercase">Bounty</h5>
                    </div>
                    <div class="card-body no-padding">
                        <br/>
                        <div class="col">

        <div>

        <form class="form-horizontal theme-form mt-5 row"  action="{{ url('screen_upload')}}" method="post" enctype= "multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="user_id" value="{{Sentinel::getUser()->id}}">

            <div class="container">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload ScreenShots</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" id="imgInp" name="imgInp">
                                </span>
                            </span>

                        </div>
                        <img id='img-upload'/>
                    </div>
                </div>

                <input type="hidden" value="{{ $serv }}" name="service" />

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    <input class="btn btn-success" type="submit" name="" value="Submit">
                                </span>
                            </span>

                        </div>

                    </div>
                </div>
            </div>
        </form>
            

            
        
        </div>
                            <br/>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection  