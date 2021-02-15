@extends('layouts.app')

@section('content')
<div class="col-md-12 p-5" style="background: #F6F9FC; height:600px;">
<div class="col-md-4 m-auto p-4" style="background: #fff; border-radius: 10px;">
    <h4 class="fw-300 c-grey-900 mB-40 text-center">Login</h4>
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="text-normal text-dark">Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"   placeholder="Email" autofocus>

            @if ($errors->has('email'))
                <span class="form-text text-danger">
                    <small>{{ $errors->first('email') }}</small>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="text-normal text-dark">Password</label>
            <input id="password" type="password" class="form-control" name="password"  placeholder="Password" >

            @if ($errors->has('password'))
                <span class="form-text text-danger">
                    <small>{{ $errors->first('password') }}</small>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="row">
            <div class="col-md-8">
            <div class="peers ai-c jc-sb fxw-nw">
                <div class="peer">
                    <div class="checkbox checkbox-circle checkbox-info peers ai-c left" >
                        <input type="checkbox" id="remember" name="remember" class="peer" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class=" peers peer-greed js-sb ai-c">
                            <span class="peer peer-greed">Remember Me</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-4">
                <div class="peer">
                    <button class="btn create-account-btn btn-custom right" >Login</button>
                </div>
            </div>
           
        </div>
        </div>
        <div class="peers ai-c jc-sb fxw-nw">
             <div class="row">
            <div class="col-md-6 p-0">
            <div class="peer">
                <a class="btn btn-link left"  style="    font-size: 14px;" href="{{ route('forgotpassword') }}">
                    Forgot Your Password?
                </a>
            </div>
        </div>
          <div class="col-md-6 p-0">
            <div class="peer">
                <a href="register " style="     font-size: 14px;" class="btn btn-link right">Create new account</a>
            </div>
        </div>
        </div>
        </div>
    </form>
</div>
</div>
@endsection
