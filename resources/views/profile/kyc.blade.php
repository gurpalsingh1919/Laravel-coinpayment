    @extends('layouts.master')
    <!-- head -->
    @section('title')
    User-KYC
    @endsection


   @section('content')
    
 
      <br/>
      <br/>
      <div class="col-md-12">
            <div class="card p-4">
              <div class="card-body">

                <div id="idensic"></div> 
              </div>
            </div>
           
      </div>
 @if($accessTokenError)
  <div style="color: red; text-align: center;">
      {{ $accessTokenError}} <br/>
      {{ $applicantIdError }}
  </div>
@endif
 @if ($uploadProfileImageError)
  <div style="color: red; text-align: center;">
      {{$uploadProfileImageError }}
  </div>
  @endif
  

  <script src="{{$baseUrl}}/idensic/static/idensic.js"></script>
  <script>
    var id = idensic.init(
      '#idensic',
      {
        accessToken: '<?=$accessToken?>',
        applicantId: '<?=$applicantId?>'
      },
      function (messageType, payload) {
        // idCheck.onReady, idCheck.onResize, idCheck.onCancel, idCheck.onSuccess, idCheck.onApplicantCreated
        console.log('[IDENSIC DEMO] Idensic message:', messageType, payload);
        // resizing iframe to the inner content size
        if (messageType == 'idCheck.onResize') {
          idensic.iframe.height = payload.height;
        }
      }
    );

  </script>
<style>
    #idensic {
      width: 100%;
      border: 0;
      padding: 0;
      margin: 0;
    }
    .img.logo-grey {
    display: none;
}

  </style>
 @endsection