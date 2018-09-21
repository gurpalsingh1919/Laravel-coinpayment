@extends('layouts.master')
<!-- head -->
@section('title') Kwatt Dashboard @endsection


@section('content')

  <div class="container-fluid">
        <div class="col">
            <div class="col">
  		<!-- <div class="contant_section"> -->
            <div class="container top-margin">
                 <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
                        	<a href="{{url('admin-user-list')}}">
                            <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                                <div class="card-body p-4">
                                    <!-- Accepts .invisible: Makes the items. Use this only when you want to have an animation called on it later -->
                                    <div class="tile-left">
                                        <i class="fa fa-users fa-6 batch-icon-xxl" aria-hidden="true"></i>
                                       <!--  <i class="fa fa-user-o  batch-icon-user-alt batch-icon-xxl" aria-hidden="true"></i> -->

                                    </div>
                                    <div class="tile-right">
                                        <div class="tile-number">{{$total_users}}</div>
                                        <div class="tile-description">Customers</div>
                                    </div>
                                </div>
                            </div></a>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
                        	<a href="{{url('admin-buy')}}">
                            <div class="card card-tile card-xs bg-secondary bg-gradient text-center">
                                <div class="card-body p-4">
                                    <div class="tile-left">
                                      
                                        <i class="fa fa-tag batch-icon-xxl" aria-hidden="true"></i>

                                    </div>
                                    <div class="tile-right">
                                        <div class="tile-number">${{number_format((float)$total_kwatt, 2, '.', '')}}</div>
                                        <div class="tile-description">Total Sales</div>
                                    </div>
                                </div>
                            </div></a>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
                            <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                                <div class="card-body p-4">
                                    <div class="tile-left">
                                      
                                        <i class="fa fa-calendar  batch-icon-xxl" aria-hidden="true"></i>

                                    </div>
                                    <div class="tile-right">
                                        <div class="tile-number">26</div>
                                        <div class="tile-description">Open Tickets</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
                            <div class="card card-tile card-xs bg-secondary bg-gradient text-center">
                                <div class="card-body p-4">
                                    <div class="tile-left">
                                        <i class="fa fa-star-o batch-icon-xxl"></i>
                                    </div>
                                    <div class="tile-right">
                                        <div class="tile-number">${{number_format((float)$todays_sales, 2, '.', '')}}</div>
                                        <div class="tile-description">New Orders</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   <div class="row">
                        <div class="col-md-6 col-lg-4 mb-5">
                            <div class="card card-sm bg-info twitter">
                                <div class="card-body">
                                    <div class="mb-4 clearfix">
                                        <div class="float-left text-left icon-batch-set">
                                            <i class="fab fa-twitter batch-icon-xxl"></i>
                                        </div>
                                        <div class="float-right text-right right-margin">
                                            <h6 class="m-0">Twitter Followers</h6>
                                        </div>
                                    </div>
                                    <div class="text-right clearfix right-margin">
                                        <div class="display-4">9,325</div>
                                        <!-- <div class="m-0">+72 Today</div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <div class="card card-sm bg-facebook">
                                <div class="card-body">
                                    <div class="mb-4 clearfix">
                                        <div class="float-left text-left icon-batch-set">
                                            <i class="fab fa-facebook-f batch-icon-xxl"></i>
                                        </div>
                                        <div class="float-right text-right right-margin">
                                            <h6 class="m-0">Facebook Followers</h6>
                                        </div>
                                    </div>
                                    <div class="text-right clearfix right-margin">
                                        <div class="display-4">7,842</div>
                                        <div class="m-0">
                                            <!-- <a href="#">Read More</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                   <!--  <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-8 mb-5">
                            <div class="card">
                                <div class="card-header">
                                    Sales Overview
                                    <div class="header-btn-block">
                                        <span class="data-range dropdown">
                                            <a href="#" class="btn btn-primary dropdown-toggle waves-effect waves-light" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                                <i class="batch-icon batch-icon-calendar"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button" x-placement="bottom-end" style="position: absolute; transform: translate3d(52px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item" href="today">Today</a>
                                                <a class="dropdown-item active" href="week">This Week</a>
                                                <a class="dropdown-item" href="month">This Month</a>
                                                <a class="dropdown-item" href="year">This Year</a>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#32dac3" data-chart-legend-1="Sales ($)" data-chart-legend-2="Orders" data-chart-height="281"><canvas id="sales-overview" style="width: 641.359px; height: 281px; display: block;" width="641" height="281"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4 mb-5">
                            <div class="card card-md">
                                <div class="card-header">
                                    Traffic Sources
                                    <div class="header-btn-block">
                                        <span class="data-range dropdown">
                                            <a href="#" class="btn btn-primary dropdown-toggle waves-effect waves-light" id="navbar-dropdown-traffic-sources-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                                <i class="batch-icon batch-icon-calendar"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-traffic-sources-header-button">
                                                <a class="dropdown-item" href="today">Today</a>
                                                <a class="dropdown-item" href="week">This Week</a>
                                                <a class="dropdown-item" href="month">This Month</a>
                                                <a class="dropdown-item active" href="year">This Year</a>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <p class="text-left">Your top 5 traffic sources</p>
                                    <div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#32dac3" data-chart-color-3="#4f5b60" data-chart-color-4="#FCCF31" data-chart-color-5="#f43a59" style="width: 224.55px; height: 224.55px;"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe><canvas id="traffic-source" width="225" height="225" style="display: block; width: 225px; height: 225px;"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
<style>
.icon-batch-set{
    display: flex;
    margin-top: 11px;
    position: absolute;
}
.right-margin{
    margin: 15px 15px;
}
.card .card-body .tile-left {
    position: absolute;
}
.card .card-body .tile-right {
    text-align: right;
    line-height: 1.618;
}

.batch-icon-xxl {
    font-size: 4.8rem !important;
}

.bg-gradient {
     color: #FFFFFF !important;
     background: #07a7e3;
     background: -moz-linear-gradient(-45deg, #07a7e3 0%, #32dac3 100%);
     background: -webkit-linear-gradient(-45deg, #07a7e3 0%, #32dac3 100%);
     background: linear-gradient(135deg, #07a7e3 0%, #32dac3 100%);
     filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=$qp-color-1, endColorstr=$qp-color-2,GradientType=1 );
     -webkit-transition: opacity 0.2s ease-out;
     -moz-transition: opacity 0.2s ease-out;
     -o-transition: opacity 0.2s ease-out;
     transition: opacity 0.2s ease-out;
}
.bg-secondary.bg-gradient {
     color: #FFFFFF !important;
     background: #4f5b60;
     background: -moz-linear-gradient(-45deg, #4f5b60 0%, #97a9b2 100%);
     background: -webkit-linear-gradient(-45deg, #4f5b60 0%, #97a9b2 100%);
     background: linear-gradient(135deg, #4f5b60 0%, #97a9b2 100%);
     filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=$qp-color-1, endColorstr=$qp-color-2,GradientType=1 );
     -webkit-transition: opacity 0.2s ease-out;
     -moz-transition: opacity 0.2s ease-out;
     -o-transition: opacity 0.2s ease-out;
     transition: opacity 0.2s ease-out;
     -webkit-transition: width 0.3s ease-in-out;
     -moz-transition: width 0.3s ease-in-out;
     -o-transition: width 0.3s ease-in-out;
     transition: width 0.3s ease-in-out;
}

.text-warning .batch-icon {
    color: #fce418 !important;
}
.batch-icon-xxl {
    font-size: 3.8rem !important;
}
.card.card-sm.bg-info.twitter{
	 color: #FFFFFF;
    background-color: #55d3f5 !important;
  
}
.bg-facebook
{
     color: #FFFFFF;
    background-color: #3B5998 !important;
}
.bg-dark *, 
.bg-danger *, 
.bg-warning *, 
.bg-info *, 
.bg-success *, 
.bg-secondary *, 
.bg-primary *,
.bg-dark .batch-icon, 
.bg-danger .batch-icon, 
.bg-warning .batch-icon, 
.bg-info .batch-icon, 
.bg-success .batch-icon, 
.bg-secondary .batch-icon, 
.bg-primary .batch-icon {
    color: #FFFFFF;
}
.container.top-margin
{
	margin-top: 50px;
}
	</style>
