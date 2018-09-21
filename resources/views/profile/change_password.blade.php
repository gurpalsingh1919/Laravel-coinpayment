@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt Coin
@endsection

@section('content')
<div class="container-fluid">
    <div class="col">
        <div class="col">
            <br/>
            <br/>
            <div class="row">            
                <div class="col-md-12"> 
                   @if(session('success')) 
                        <div class="alert alert-success alert-dismissable ">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>Success : </strong>   {{ session('success') }}
                        </div>
                    @endif

                   @if(session('error')) 
                        <div class="alert alert-danger alert-dismissable ">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 <strong>Error : </strong>   {{ session('error') }}
                        </div>
                    @endif 
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div> 
                <div class="col">
                    <div class="card mb-5">
                        <div class="card-header">
                            <h4>Change Password</h4>
                        </div>
                        <div class="card-body"> 
                            <div class="row">       
                                <div class="col-lg-7 col-md-6">
                                    <br/>
                                    @if($user = Sentinel::getUser())
                                        @if($user->inRole('user'))
                                            <form id="freeze-input"  action="{{ url('/user-password-updated') }}" method="POST">
                                        @else
                                            <form id="freeze-input"  action="{{ url('/password-updated') }}" method="POST">
                                        @endif
                                    @endif                                    
                                        {{ csrf_field() }}
                                        <div class="row clearfix"> 
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="new-password" class="col-form-label">Current Password:</label>
                                                        <input type="password" class="form-control" id="current-password" name="current_password">     @if ($errors->has('current_password'))
                                                                <span class="help-block text-danger">
                                                                    {{ $errors->first('current_password') }}
                                                                </span>
                                                        @endif                                       
                                                    </div>
                                                </div>
                                              
                                                <div class="col-lg-12">
                                                    <div class="form-group "> 
                                                        <label for="new-password" class="col-form-label">New Password:</label>
                                                        <input type="password" class="form-control" id="new-password" name="new_password">
                                                         @if ($errors->has('new_password'))
                                                                <span class="help-block text-danger">
                                                                    {{ $errors->first('new_password') }}
                                                                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="new-password-confirm" class="col-form-label">Retype New Password:</label>
                                                        <input type="password" class="form-control" id="new-password-confirm" 
                                                        name="confirm_new_password"> 
                                                         @if ($errors->has('confirm_new_password'))
                                                                <span class="help-block text-danger">
                                                                    {{ $errors->first('confirm_new_password') }}
                                                                </span>
                                                        @endif            
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-primary btn-sm">Apply Changes</button>
                                                </div> 
                                            <div class="col">
                                                <br/>
                                                <br/>
                                            </div>
                                        </div>
                                    </form>
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