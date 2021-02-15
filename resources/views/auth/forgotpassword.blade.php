
@extends('layouts.app')

@section('content')
<div class="col-md-12 p-5" style="background: #e7e7e7; height:600px;">
<div class="col-md-4 m-auto p-4" style="background: #fff; border-radius: 10px;">
    <h4 class="fw-300 c-grey-900 mB-40">Reset Password</h4>
               
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-horizontal" method="POST" action="{{ route('send_link_forget_password') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="text-normal text-dark">E-Mail Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Send Password Reset Link
            </button>
        </div>
    </form>
</div>
</div>
@endsection