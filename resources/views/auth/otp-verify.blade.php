<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hatirpal | User Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" type="image/png" href="{{asset('images/default/icon/icon.png')}}" />
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/plugins/iCheck/square/blue.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
     <div class="register-logo" style="margin-bottom:-50px;margin-top:-50px">
      <a href="/"><img src="{{asset('images/default/logo/registerLogo.png')}}" height='200px' with='100%' alt="logo"></a>
    </div>
  <div class="login-box-body">
    <p class="login-box-msg"><span style="font-size:25px;color:orange">Enter varification Code</span></p>
        @if(Session::has('message'))
            <div class="alert alert-danger">{{Session::get('message')}}</div>
        @endif
    <form action="{{route('verify')}}" method="post">
        @csrf
      <div class="form-group{{ $errors->has('code') ? ' is-invalid' : '' }} has-feedback">
        <input type="text" class="form-control" id="code" name="code" placeholder="Otp Code" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
         @if ($errors->has('code'))
            <span class="invalid-feedback" role="alert">
                <strong style="color:red">{{ $errors->first('code') }}</strong>
            </span>
        @endif              
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Verify</button>
        </div>
      </div>
    </form>
       <br>
    <a href="/verify" class="text-center"><span style="font-size:15px">Resend Code</span></a>
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
