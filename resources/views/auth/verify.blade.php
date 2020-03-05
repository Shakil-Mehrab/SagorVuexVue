@extends('layout.master')

@section('content')
<br><br><br><br><br><br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card" style="font-size: 20px;color:orange;text-align:center">
                @include("admin.includes.message.message")
                <div class="card-header">{{ __('Verify Your Email Address') }}</div><br>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}<br>
                    <!--{{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend',1) }}"><span style="color:blue">{{ __('click here to request another') }}</span></a>.-->
                </div>
            </div>
        </div>
    </div>
</div><br><br><br><br><br><br><br><br><br><br><br>
<style>
    
</style>
@endsection
