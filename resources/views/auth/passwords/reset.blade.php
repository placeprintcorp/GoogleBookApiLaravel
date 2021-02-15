@extends('layouts.app')

@section('content')

<div class="col-md-12 p-5 " style="background: #F6F9FC; height:600px;">
<div class="col-md-4 m-auto p-4" style="background: #fff; border-radius: 10px;">
    <h4 class="fw-300 c-grey-900 mB-40">Reset Password</h4>
    <form class="form-horizontal" method="POST" action="{{ route('submitforget') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="text-normal text-dark">E-Mail Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="form-text text-danger">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="text-normal text-dark">Password</label>

            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block text-danger">
                   {{ $errors->first('password') }}
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm" class="text-normal text-dark">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block text-danger">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                @endif
        </div>

        <div class="form-group">
                <button type="submit" class="btn create-account-btn btn-custom">
                    Reset Password
                </button>
        </div>
    </form>
</div>
</div>
    
@endsection
