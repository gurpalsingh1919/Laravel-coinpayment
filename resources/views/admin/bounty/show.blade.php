
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
                <h2></h2>
                <br/>
                <div class="row">
                    <div class="col-md-4">

                            <div class="card mb-5 col-md-12">
                              <div class="card-header">
                                 <h5 class="text-uppercase"> Bounty For {{ $bounty_full->service  }} Service</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase"> <!-- title --></h5>
                                    </div>

                                    <div id="msg">
                                      
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>
                                      <table class="table">
                                         <tr>
                                             <td><b>Screenshot Details</b></td>
                                             <td>
                                                 <img src="{{ url('/') }}/upload/bounty/{{ $bounty_full->document }}" height="200px;" />
                                             </td>
                                         </tr>
                                              <tr>
                                             <td><b>User Details</b></td>
                                             <td>
                                               <b>UserName : </b> {{ $bounty_full->user->username }}<br>
                                               <b>Email : </b> {{ $bounty_full->user->email }}<br>
                                             </td>
                                         </tr>
                                     </table>

                                                      @if($bounty_full->status == 0)

                                                           <span id="fill_here"><button class="btn btn-success" onclick="show_input()">Accept</button></span>
                                                           <a href="{{ url('bounty_reject',$bounty_full->id) }}"><button class="btn btn-danger">Reject</button></a>

                                                          @elseif($bounty_full->status == 1)
                                                          <i class="fa fa-check" aria-hidden="true"></i>&nbsp; Approve
                                                          @elseif($bounty_full->status == 2)
                                                           <i class="fa fa-times" aria-hidden="true"></i>&nbsp;Reject
                                                          @else
                                                          @endif

                                    </div>
                                </div>
                    </div>
                </div>

            </div>
        </div>

   

<input type="hidden"  name="main_id" id="main_id" value="{{ $bounty_full->id }}">
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">

<script type="text/javascript">
  function show_input()
  {
    $('#fill_here').empty();
    $('#fill_here').append("<label>Enter Token To Give User</label><input type='text' placeholder='Enter Token To Give User' class='form-control' id='give_token'><button class='btn btn-success' onclick='give_coin()'> Give</button><button type='reset' class='btn btn-danger' > Cancel</button><hr>");
  }

  function give_coin()
  {
      var _token = $('#_token').val();
      var give_coin=$('#give_token').val();
      var main_id=$('#main_id').val();

       $.ajax({

        url: "{{ url('give_to_user') }}",
        method : "post",
        data : { '_token' : _token, 'give_coin':give_coin, 'main_id':main_id },
        success: function(result)
        {
          if(result==1)
          {
               $('#msg').append("<div class='alert alert-success'><strong>Success!</strong> Approve Bounty Document And Give Token To User Successfully.</div>");
               setTimeout(function(){window.location.reload(1);},3000);

          }
          else
          {

          }
        }
    });
  }
</script>
@endsection  