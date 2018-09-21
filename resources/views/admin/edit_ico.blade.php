@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt
@endsection

@section('style')

<link href="{{ url('/') }}/assets/datepicker/css/tempusdominus-bootstrap-4.css" rel="stylesheet" type="text/css" />

<link href="{{ url('/') }}/assets/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills nav-fill theme-tab">
                <li class="nav-item">
                    <a class="nav-link @if(!session('validator')) active @endif" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">ICO setting</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade @if(!session('validator'))  show active @endif" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-md-12">
                        <form class="form-horizontal theme-form mt-5 row"  action="{{url('ico-update')}}" method="post" enctype="multipart/form-data">    
                            @if(session('success'))
                                <div class="alert alert-success">
                                    <strong>Success : </strong>{{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <strong>Error : </strong> {{ session('error') }}
                                </div>
                            @endif                  
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="setting_id" value="{{$setting->id}}">
                       
                            <div class="form-group col-md-6">
                                <label for="ico_start_date">ICO Start Date</label>

                                <div class=" input-group date" id="end_date" data-target-input="nearest">
                                    <input type="datetime-local" class="form-control" name="ico_start_date" value="{{ date('Y-m-d',strtotime($setting->ico_start_date)).'T'. date('H:i',strtotime($setting->ico_start_date))}}" id="ico_start_date" autocomplete="off">


                                </div>
                                @if ($errors->has('ico_start_date'))
                                    <span class="help-block text-danger">
                                                <strong>{{ $errors->first('ico_start_date') }}</strong>
                                            </span>
                                @endif
                              
                            </div>   
                            <div class="form-group col-md-6">
                                <label for="ico_end_date">ICO End Date</label>
                                <div class=" input-group date" id="end_date" data-target-input="nearest">

                                       <input type="datetime-local" class="form-control" name="ico_end_date" value="{{ date('Y-m-d',strtotime($setting->ico_end_date)).'T'. date('H:i',strtotime($setting->ico_end_date))}}" id="end_date" autocomplete="off">

                                </div>
                                @if ($errors->has('ico_end_date'))
                                    <span class="help-block text-danger">
                                                <strong>{{ $errors->first('ico_end_date') }}</strong>
                                            </span>
                                @endif
                              
                            </div>                    
                            <div class="form-group col-md-6">
                                <label for="total_coins">Total Coins</label>
                                <input type="text" class="form-control" name="total_coins" value="{{$setting->total_coins}}" id="" autocomplete="off">
                                @if ($errors->has('total_coins'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('total_coins') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sold_coins">Sold Coins</label>
                                <input type="text" class="form-control" name="sold_coins" value="{{$setting->sold_coins}}" id="" autocomplete="off">
                                @if ($errors->has('sold_coins'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('sold_coins') }}</strong>
                                    </span>
                                @endif
                            </div>

                              <div class="form-group col-md-6">
                                <label for="sold_coins">Referal Bonus(%)</label>
                                <input type="text" class="form-control" name="referal_bonus" value="{{$setting->referal_bonus}}" id="" autocomplete="off">
                                @if ($errors->has('referal_bonus'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('referal_bonus') }}</strong>
                                    </span>
                                @endif
                            </div>


                                   <div class="form-group col-md-6">
                                <label for="sold_coins">USD Rate ($)</label>
                                <input type="text" class="form-control" name="usd_rate" value="{{$setting->usd_rate}}" id="" autocomplete="off">
                               
                            </div>


                            <div class="form-group col-md-12 text-right">
                                <button type="submit" class="mt-4 btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  

@section('script') 
    <script type="text/javascript" src="{{ url('/') }}/assets/datepicker/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/assets/datepicker/js/tempusdominus-bootstrap-4.js"></script>

@endsection