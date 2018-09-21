@extends('layouts.master')
@section('title') Affiliates @endsection
@section('style')
@endsection
@section('content')


<script type="text/javascript" src="{{ url('/') }}/back/js/jquery.countdownTimer.js"></script>
<script type="text/javascript" src="{{ url('/') }}/back/js/jquery.fireworks.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="{{ url('/') }}/back/css/jquery.countdownTimer.css" /> -->
<!-- <script src="{{ url('/') }}/back/js/ServerDate.js"></script> -->

<div class="banner_afilatetp">
 <div id="imgs" class="aflita_styl_sect">
      <img width="100%"  class="image-bg-affiliate" height="700" src="{{ url('/') }}/back/images/bg-affilate.jpg">
      <div class="content-msg">
         <div class="col-lg-12">
         <h2>4NEW POWER EXPLOSION <span>AFFILIATE CONTEST DETAILS</span></h2>
         <h4 class="mb-2">Get a chance to WIN <span>a 2018 BMWi8, a Gold Breitling Bentley Watch or a Tropical Exotic Cruise.</span></h4>
       </div>
          <img width="1273"  src="{{ url('/') }}/back/images/afilate-bnr2 .png">
       </div>
    </div>

</div>
<script type="text/javascript">
$(document).ready(function(){
    setTimeout(function() {
        $('#imgs').fireworks();
    });
});
</script>


<div class="col mt-4">
    <div class="col-lg-12">
      <div class="card mb-2 text-center">
      <div class="card-header"><a href="#" data-toggle="modal" data-target="#termsandconditions"><strong>Contest Terms and conditions</strong></a>

      </div>
      </div>
    </div>
  </div>

<div class="container-fluid affiliate_wrap">
   <div class="col">
     <br/>
    <div class="row">

   <div class="col-lg-12">
   <div class="row">
   <div class="col-lg-8">
    <div class="card mb-4">
      <div class="card-header">
            <h5 class="text-uppercase mb-0">TOP 10 AFFILIATES!</h5>

        </div>
        <div class="card-body pt-3 pb-2 pr-4">
           <p><strong>You could be the next 4NEW Affiliate Story!</strong></p>
          <ul class="affiliate-userlisting">
               @foreach($toprated as $list)
              <li>
                <p><!-- <i class="fas fa-user"></i>  -->
                  @if($list->ref_user_id=='20773' || $list->ref_user_id=='32')
                  {{'Anonymous'}}

                  @else 
                  {{ substr(ucfirst(strtolower($list->aff_user->fullname)),0,16)}}
                  @endif
                </p>
                <span><i class="fas fa-dollar-sign"></i>
                  {{number_format(($list->total_bonus *2), 2)}}</span>
            </li>
           @endforeach


          </ul>

        </div>
    </div>
   </div>

   <div class="col-lg-4">
   <div class="card-header">

            <h5 class="text-uppercase mb-0">25% MATCH BONUS  EXPIRES IN</h5>

   </div>
    <div class="calculations_c">

    <div class="count_donnew p-3">
       <!-- <h5>BONUS SALE ENDS IN</h5> -->
      <!--  <div id="number"></div> -->
       <div id="countdowntimer"><span id="future_date"><span></div>
       <!-- <p id="title">
        <span id="das">Days</span>
        <span id="hourB">Hours</span>
        <span id="Min">Minutes</span>
        <span id="Secd">Seconds</span>
      </p> -->
      <br/>
      <p>For best results, go here to our AFFILIATE SECTION and get access to the 4NEW promotional tools.</p>
     </div>
</div>
</div>
</div>
<script>
    $(function(){
        $('#future_date').countdowntimer({
            dateAndTime : "2018/08/11 14:00:00",
           startDate : "<?php echo date('Y/m/d H:i:s'); ?>",
            regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
regexpReplaceWith: "<div class='timer-inner'> $1<span>days</span></div>" + "<div class='timer-inner'>$2 <span>hours</span></div>" +  "<div class='timer-inner'> $3 <span>minutes</span></div>" + "<div class='timer-inner'> $4 <span>seconds</span>",
timeZone:-470
        });
    });

</script>

<div class="mt-4">
<div class="card">
  <div class="card-body p-4 text-center list-inline">
    <li class="list-inline-item"><h4><strong>Number of Affiliates </strong> <span class="text-success">{{count($ref_list)}}</span> </h4>
    </li>
    <li class="list-inline-item"><h3>/</h3></li>
    <li class="list-inline-item">
    <h4><strong>Total KWATT Tokens </strong><span class="text-success">{{number_format(Sentinel::getUser()->kwatt_balance, 2, '.', ',')}}</span></h4>
  </li>
  </div>
  </div>
</div>


              <div class="row">
              <div class="col-lg-12">
               <div class="card mb-5 mt-4">
                    <section class="trajectory h-trajectory section--background">
                      <div class="row">
                        <div class="Valuation_calucalater">
                          <div class="card-header">
                            <h5 class="text-uppercase mb-0">BONUS TOKEN PROJECTION ESTIMATOR</h5>
                            <!-- <p class="text-center">Projected Annual Token Valuation</p> -->
                          </div>

                        <div class="col-lg-12 pt-3"><p>Use this BONUS TOKEN PROJECTION ESTIMATOR to see your 5 year earning potential as an affiliate. Click the scale and move it from left to right.</p></div>
                        </div>
                        <div class="six columns left">
                          <div class="card">

                            <h5 class="invest__headline"> KWATT BONUS TOKENS
                              <span id="investLabel">$150 ETH</span>
                            </h5>
                            <form id="investForm" action="https://www.envion.org/en/ico/">
                              <!--input type="range" value="50000" min="1000" max="100000" step="500" name="investInput" id="investInput" class="invest__input"-->
                              <input type="range" value="50000" min="500" max="100000" step="500" name="investInput" id="investInput" class="invest__input">
                              </form>
                              <table id="investTable" class="invest__table">
                                <tr>
                                  <th colspan="2" style="line-height: 2em">Projected Annual Token Valuation:</th>
                                </tr>
                                <tr>
                                  <th>Year 1</th>
                                  <td id="year_one">5%</td>
                                </tr>
                                <tr>
                                  <th>Year 2</th>
                                  <td id="year_two">10%</td>
                                </tr>
                                <tr>
                                  <th>Year 3</th>
                                  <td id="year_three">15%</td>
                                </tr>
                                <tr>
                                  <th>Year 4</th>
                                  <td id="year_four">20%</td>
                                </tr>
                                <tr>
                                  <th>Year 5</th>
                                  <td id="year_five">25%</td>
                                </tr>

                              </table>

                            </div>
                          </div>
                          <div class="six columns right">
                            <div id="investDiscount" class="invest__discount">
                              <h5 class="text-uppercase mb-0">Projected Annual Token Valuation:</h5>
                            </div>
                            <div class="chart">
                              <div class="chart__bar" id="chartYear1" style="height: 13%;">
                                <div class="chart__label" id="chartYear1Label">$79,695</div>
                                <div class="chart__cashout">
                                  <span class="chart__tooltip">$59,771.25</span>
                                </div>
                                <div class="chart__axis">Year&nbsp;1</div>
                              </div>
                              <div class="chart__bar" id="chartYear2" style="height: 18%;">
                                <div class="chart__label" id="chartYear2Label">$111,772</div>
                                <div class="chart__cashout">
                                  <span class="chart__tooltip">$83,829</span>
                                </div>
                                <div class="chart__axis">Year&nbsp;2</div>
                              </div>
                              <div class="chart__bar" id="chartYear3" style="height: 26%;">
                                <div class="chart__label" id="chartYear3Label">$156,760</div>
                                <div class="chart__cashout">
                                  <span class="chart__tooltip">$117,570</span>
                                </div>
                                <div class="chart__axis">Year&nbsp;3</div>
                              </div>
                              <div class="chart__bar" id="chartYear4" style="height: 36%;">
                                <div class="chart__label" id="chartYear4Label">$219,856</div>
                                <div class="chart__cashout">
                                  <span class="chart__tooltip">$164,892</span>
                                </div>
                                <div class="chart__axis">Year&nbsp;4</div>
                              </div>
                              <div class="chart__bar" id="chartYear5" style="height: 50%;">
                                <div class="chart__label" id="chartYear5Label">$308,348</div>
                                <div class="chart__cashout">
                                  <span class="chart__tooltip">$231,261</span>
                                </div>
                                <div class="chart__axis">Year&nbsp;5</div>
                              </div>
                            </div>
                            <div class="chart__legend">
                              <span class="chart__explain chart__explain--cashout">Token Valuation</span>
                            </div>
                          </div>
                        </div>
                      </section>
                      <script type="text/javascript">
jQuery(document).ready(function() {
    var t = new Array,
        e = 0;
    jQuery("#investInput").on("input", function() {
        // $("#investTable").html("");

        var i = jQuery(this).val();
        jQuery("#investLabel").text((1 * i).toLocaleString("en-US", {
            maximumFractionDigits: 2
        }));
        jQuery("#investDiscount").html("Projected Annual Token Valuation:");
        t[0] = i;
        var naraa = "";
        for (var r = 0; r < 1; r++)
            naraa = t[r] * 3 + parseFloat(i);

        jQuery("#year_one").html(naraa.toLocaleString("en-US", {maximumFractionDigits:2}));
        jQuery("#chartYear1Label").html(naraa.toLocaleString("en-US", {maximumFractionDigits:2}));
         //Math.ceil(16e-5 * t[r]) +

         jQuery("#chartYear1" ).css({
            height: Math.ceil(9e-5 * naraa) + "%"
        });

        var naraatwo = "";
        for (var r = 0; r < 1; r++)
            naraatwo = t[r] * 7.20 + parseFloat(i);
       jQuery("#year_two").html(naraatwo.toLocaleString("en-US", {maximumFractionDigits:2}));
        jQuery("#chartYear2Label").html(naraatwo.toLocaleString("en-US", {maximumFractionDigits:2}));

         jQuery("#chartYear2").css({
            height: Math.ceil(5e-5 * naraatwo) + "%"
        });



         var naraathree = "";
        for (var r = 0; r < 1; r++)
            naraathree = t[r] * 15.40 + parseFloat(i);
       jQuery("#year_three").html(naraathree.toLocaleString("en-US", {maximumFractionDigits:2}));
        jQuery("#chartYear3Label").html(naraathree.toLocaleString("en-US", {maximumFractionDigits:2}));
       jQuery("#chartYear3").css({
            height: Math.ceil(3e-5 * naraathree) + "%"
        });

         var naraafour = "";
        for (var r = 0; r < 1; r++)
            naraafour = t[r] * 29.75 + parseFloat(i);
       jQuery("#year_four").html(naraafour.toLocaleString("en-US", {maximumFractionDigits:2}));
       jQuery("#chartYear4Label").html(naraafour.toLocaleString("en-US", {maximumFractionDigits:2}));
        jQuery("#chartYear4").css({
            height: Math.ceil(1.9e-5 * naraafour) + "%"
        });

         var year_five = "";
        for (var r = 0; r < 1; r++)
            naraafive = t[r] * 60.50 + parseFloat(i);
        jQuery("#year_five").html(naraafive.toLocaleString("en-US", {maximumFractionDigits:3}));
        jQuery("#chartYear5Label").html(naraafive.toLocaleString("en-US", {maximumFractionDigits:3}));
         jQuery("#chartYear5").css({
            height: Math.ceil(1.2e-5 * naraafive) + "%"
        });
        //console.log(Number(naraa) . Number(naraatwo) . Number(naraathree). Number(naraafour) + Number(naraafive));
        //console.log(Number(naraafive));
        var sum = Number(naraa) + Number(naraatwo) + Number(naraathree) + Number(naraafour) + Number(naraafive);
        jQuery("#sum").html(sum.toLocaleString("en-US", {maximumFractionDigits:2}));


    }), jQuery("#investInput").trigger("input")

})
                      </script>
                    </div>
           </div>
           </div>

<!-- TRANSACTIONS -->
<div class="row">

   <div class="col-md-6">
      <div class="card mb-5">
              <div class="card-header">
                <h5 class="text-uppercase mb-0">Transactions</h5>
              </div>
              <div class="card-body no-padding mt-4 min_hehtdv">
                <div class="col">
                  <div class="d-flex justify-content-center row">
                    <div class="col-md-12">
                      <div class="mb-12">
                        <table class="table table-striped">
                          <tr>
                            <th>Sr.</th>
                            <th>Name</th>

                            <th>Bonus</th>
                            <th>Date</th>
                          </tr>
                          <?php $i = 1;?>
                      @foreach($ref_list as $list)


                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$list['fullname']}}</td>

                            <td>{{sprintf('%0.2f', $list['bonus'])}}</td>
                            <td>{{$list['created_at']}}</td>
                          </tr>
                       @endforeach


                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
           </div>
   </div>
   <div class="col-md-6">
      <div class="card mb-5">
              <div class="card-header">
                <h5 class="text-uppercase mb-0">Bonus</h5>
              </div>
              <div class="card-body no-padding mt-4 min_hehtdv">
                <div class="col">
                  <div class="d-flex justify-content-center row">
                    <div class="col-md-12">
                      <div class="mb-12">
                        <table class="table table-striped">
                          <tr>
                            <th>Sr.</th>
                            <th>Date</th>

                            <th>Bonus</th>

                          </tr>
                        <!--  <tr><td>1</td>
                              <td>9th June to 22nd June</td>
                          <td>75%</td>
                        </tr> -->
                         <!-- <tr><td>1</td>
                              <td>23rd June to 6th July</td>
                          <td>50%</td>
                        </tr> -->
                        <!--  <tr><td>1</td>
                              <td>7th July to 20 July</td>
                          <td>30%</td>
                        </tr> -->
                         <tr><td>1</td>
                              <td>21 July – 10 August</td>
                          <td>25%</td>
                        </tr>


                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
           </div>
   </div>
</div>

 </div>
   



@endsection

<script type="text/javascript">
    function copyreferrallink() {
      var copyredText = document.getElementById("post-sharelink");
      //console.log(copyText);
      copyredText.select();
      document.execCommand("Copy");
    }
    function copyreferrallink2() {
      var copyredText = document.getElementById("post-sharelink-affiliate");
      //console.log(copyText);
      copyredText.select();
      document.execCommand("Copy");
    }

    function copyhtmlembedd(){
       var htmlembedcode = document.getElementById("html-embed-code");
      //console.log(copyText);
      htmlembedcode.select();
      document.execCommand("Copy");
    }
    function copyhtmlembeddcode(){
       var embedcode = document.getElementById("embed-code");
      //console.log(copyText);
      embedcode.select();
      document.execCommand("Copy");
    }




  </script>
