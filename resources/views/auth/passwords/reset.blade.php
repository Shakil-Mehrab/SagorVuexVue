
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hatirpal | User Password Reset Form</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" type="image/png" href="{{asset('images/default/icon/icon.png')}}" />
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/plugins/iCheck/square/blue.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo" style="margin-bottom:-50px;margin-top:-50px">
      <a href="/"><img src="{{asset('images/default/logo/registerLogo.png')}}" height='200px' with='100%' alt="logo"></a>
    </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="{{ route('password.update') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

      <div class="form-group{{ $errors->has('email') ? ' is-invalid' : '' }} has-feedback">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
           <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $errors->first('email') }}</strong>
                </span>
            @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' is-invalid' : '' }} has-feedback">
        <label for="email" class="col-md-6 col-form-label text-md-right">{{ __('New Password') }}</label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $errors->first('password') }}</strong>
                </span>
            @endif
      </div>
      <div class="form-group has-feedback">
        <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="checkbox icheck">
            <label>
            </label>
          </div>
        </div>
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="{{asset('bazarbaariadmin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bazarbaariadmin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bazarbaariadmin/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
