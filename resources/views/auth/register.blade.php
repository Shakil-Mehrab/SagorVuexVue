
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hatirpal | User Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
     <div class="register-logo" style="margin-bottom:-50px;margin-top:-50px">
      <a href="/"><img src="{{asset('images/default/logo/registerLogo.png')}}" height='200px' with='100%' alt="logo"></a>
    </div>
@php
use App\Model\Country;
$countries=Country::all();
@endphp

  <div class="register-box-body">
    <p class="login-box-msg"><span style="font-size:25px;color:orange">Register a New Account</span></p>

    <form action="{{route('register')}}" method="post">
      @csrf
      <div class="form-group{{ $errors->has('name') ? ' is-invalid' : '' }} has-feedback">
        <input type="text" class="form-control" name="name" id="name" placeholder="Full name" value="{{ old('name') }}" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong style="color:red">{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('email') ? ' is-invalid' : '' }} has-feedback">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong style="color:red">{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
        <div class="form-group{{ $errors->has('country_id') ? ' is-invalid' : '' }} has-feedback">
          <select name="country_id" class="form-control" required>
              <option value="">Select One</option>
              @forelse($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @empty
              <option value="">No Country</option>
              @endforelse
          </select> 
          @if ($errors->has('country_id'))
              <span class="invalid-feedback" role="alert">
                  <strong style="color:red">{{ $errors->first('country_id') }}</strong>
              </span>
          @endif
       </div>
      
       
       <div class="form-group{{ $errors->has('city_id') ? ' is-invalid' : '' }} has-feedback col">
            <select class="form-control" name="city_id" required>
                                   
                                    
            </select> 
            @if ($errors->has('city_id'))
            <span class="help-block">
                <strong style="color: red">{{ $errors->first('city_id') }}</strong>
            </span>
             @endif
       </div>
        <div class="form-group{{ $errors->has('district_id') ? ' is-invalid' : '' }} has-feedback">
          <select class="form-control" name="district_id" required>
                         
                          
          </select> 
          @if ($errors->has('district_id'))
          <span class="help-block">
              <strong style="color: red">{{ $errors->first('district_id') }}</strong>
          </span>
          @endif
       </div>
     
       <div class="form-group{{ $errors->has('phone') ? ' is-invalid' : '' }} has-feedback">
          <div class="input-group">
            <div class="input-group-addon">
                <select name="code_id" required>
                </select> 
            </div>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Mobile No" value="{{ old('phone') }}" required>
          </div>
          <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          @if ($errors->has('code_id'))
              <span class="invalid-feedback" role="alert">
                  <strong style="color:red">{{ $errors->first('code_id') }}</strong>
              </span>
          @endif
          @if ($errors->has('phone'))
              <span class="invalid-feedback" role="alert">
                  <strong style="color:red">{{ $errors->first('phone') }}</strong>
              </span>
          @endif
       </div>
      
      
      
      <div class="form-group{{ $errors->has('password') ? ' is-invalid' : '' }} has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="{{ old('password') }}" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong style="color:red">{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Retype password" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="/login" class="text-center"><span style="font-size:20px">Have You Already an Account ? Login</span></a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="{{asset('bazarbaariadmin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bazarbaariadmin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bazarbaarifront/js/jquery-2.2.4.min.js')}}"></script>

<!-- iCheck -->
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





<script>
   $(function(){
    var country=$('select[name="country_id"]');
    var code=$('select[name="code_id"]');
    var city=$('select[name="city_id"]');
    var district=$('select[name="district_id"]');

    code.attr('disabled','disabled')
    city.attr('disabled','disabled')
    district.attr('disabled','disabled')



 country.change(function(){
      var id=$(this).val();
      if(id==''){
       code.attr('disabled','disabled')
       city.attr('disabled','disabled')

       s='<option value=""></option>'
       code.html(s);
       city.html(s);
     }})
    country.change(function(){
      var id=$(this).val();
      if(id){
       city.attr('disabled','disabled')
       $.get('{{url('/cities?country_id=')}}'+id)
        .success(function(data){
          var s='<option value="">Select One</option>';
          data.forEach(function(row){
            s +='<option value="'+row.id+'">'+row.name+'</option>'
          })
          city.removeAttr('disabled')
         city.html(s);

        })


       code.attr('disabled','disabled')
       $.get('{{url('/codes?country_id=')}}'+id)
        .success(function(data){
          data.forEach(function(row){
            s='<option value="'+row.id+'">'+row.code+'</option>'
          })
          code.removeAttr('disabled')
          code.html(s);
        })
      }
    })




    city.change(function(){
      var id=$(this).val();
      if(id==''){
       district.attr('disabled','disabled')
       s='<option value=""></option>'
       district.html(s);
     }})
    city.change(function(){
      var id=$(this).val();
      if(id){
       district.attr('disabled','disabled')
       $.get('{{url('/districts?city_id=')}}'+id)
        .success(function(data){
          var s='<option value="">Select One</option>';
          data.forEach(function(row){
            s +='<option value="'+row.id+'">'+row.name+'</option>'
          })
          district.removeAttr('disabled')
          district.html(s);
        })
      }
    })   



  })
</script>


</body>
</html>
