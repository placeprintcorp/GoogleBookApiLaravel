@extends('layouts.app')
@section('content')
<div class="col-md-12 p-5" style="background: #F6F9FC;">
<div class="col-md-4 m-auto p-4" style="background: #fff; border-radius: 10px;">
  
    <h4 class="fw-300 c-grey-900 mb-4 text-center">Register</h4>
    <form method="POST" action="{{ route('register') }}" >
        {{ csrf_field() }}
        <div  class="row">
         <div class="col-md-12">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="text-normal text-dark">Email  <span class="text-danger">*</span></label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" >

                    @if ($errors->has('email'))
                        <span class="form-text text-danger">
                            <small>{{ $errors->first('email') }}</small>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="text-normal text-dark">Password  <span class="text-danger">*</span></label>
                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password"  placeholder="Password">

                    @if ($errors->has('password'))
                        <span class="form-text text-danger">
                            <small>{{ $errors->first('password') }}</small>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation" class="text-normal text-dark">Confirm Password  <span class="text-danger">*</span></label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

                      @if ($errors->has('password_confirmation'))
                        <span class="form-text text-danger">
                            <small>{{ $errors->first('password_confirmation') }}</small>
                        </span>
                    @endif

                </div>

        </div>

        </div>        

        <div class="form-group">
            <div class="peers ai-c jc-sb fxw-nw">
                 <div class="row">
            <div class="col-md-6">
                <div class="peer" >
                    <a href="login" class="left">I have an account</a>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="peer" >
                    <button class="btn create-account-btn btn-custom right" >Register</button>
                </div>
            </div>
        </div>
            </div>
        </div>
    </form>
</div>
</div>
@endsection
