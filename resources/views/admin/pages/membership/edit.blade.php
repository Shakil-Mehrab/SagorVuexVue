@php
use App\Model\Membership;
use App\Model\Product;
use App\Model\Order;
use App\User;
use App\Model\Country;
use App\Model\Category;
$countries=Country::orderBy('name','asc')->get();
$user=User::where('id',auth()->user()->id)->first();
$membership=Membership::where('user_id',auth()->user()->id)->where('status','approved')->first();
$products=Product::orderBy('id','desc')->get();
$pending_orders=Order::orderBy('id','desc')->where('user_id',auth()->user()->id)->where('delivered',0)->paginate(1);
$orders_delivered=Order::orderBy('id','desc')->where('user_id',auth()->user()->id)->where('delivered',1)->paginate(1);
$categories=Category::orderBy('name','asc')->get();
@endphp
@extends('admin.admin')
@section('link')
  {{-- <link rel="stylesheet" href="{{asset('dist/css/foundation.css')}}"/> --}}
  {{-- <link rel="stylesheet" href="{{asset('dist/css/app.css')}}"/>  --}}
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endsection
@section('navigation')
<section class="content-header">
  <h1><a href="/admin">Admmin Dashboard</a></h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i><span style="font-size:15px">Admin Dashboard</span></a></li>
    <li class="active"><a href="{{route('admin-membership.index')}}"><span style="font-size:15px">Membership</span></a></li>
    <li class="active"><span style="color:orange;font-size:15px">Edit</span></li>
  </ol>
</section>
@endsection






@section('content')
@if($membership)
 
  <section class="content">
    <div class="row">
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <a href="{{asset($user->image)}}">
              <img class="profile-user-img img-responsive img-circle" src="{{asset($user->image)}}" alt="User profile picture">
            </a>
            <p class="text-muted text-center"><a href="{{route('user-user.edit',$user->id)}}">Edit Profile Picture</a></p>
            <h4 class="profile-username text-center">{{ucfirst($user->name)}}</h4>
            <h4 class="profile-username text-center"><strong>Supplier From {{ucfirst($user->membership->company_name)}}</strong></h4>
          </div>
        </div>
        <div class="box box-primary" style="margin-top: -20px">
          <div class="box-header with-border">
            <h3 class="box-title">About Company</h3>
          </div>
          <div class="box-body">
            <p><img src="{{asset($user->country->image)}}" width="5%" alt="flag"> Country :  {{$user->membership->country->name}}</p>
            <p><i class="fas fa-city"></i> City :  {{$user->membership->city->name}}</p>
            <p><i class="fas fa-city"></i> District :  {{$user->membership->district->name}}</p>
            <p><i class="fas fa-align-justify"></i> Product Type :  {{$user->membership->category->name}}</p>
            <p><i class="fas fa-phone"></i> {{$user->mobile_no}}</p>
            <p><i class="fas fa-envelope"></i> {{$user->email}}</p>
            <p><i class="fa fa-map-marker margin-r-5"></i>{{$user->membership->address}}</p>
            <hr>
          </div>
        </div>
      </div>







      <div class="col-md-8">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Company Photo</a></li>
            <li><a href="#timeline" data-toggle="tab">Document</a></li>
            <li><a href="#add" data-toggle="tab">Add Product</a></li>
            <li><a href="#settings" data-toggle="tab">Settings</a></li>

          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
             
              <div class="post">
                <div class="row margin-bottom">
                  <div class="col-sm-6">
                    <a href="{{asset($user->membership->image)}}">
                      <img class="img-responsive" src="{{asset($user->membership->image)}}" alt="{{$user->membership->image}}">
                    <a href="{{URL::to($user->image)}}">

                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-sm-6">
                          @forelse($user->membership->membership_extra_image as $extra)
                        <a href="{{URL::to($extra->image)}}"><img class="img-responsive" src="{{asset($extra->image)}}" alt="{{$extra->image}}"></a><br>
                         @empty
                         @endforelse
                      </div>
                      <div class="col-sm-6">
                         @forelse($user->membership->membership_extra_image2nd as $extra)
                           <a href="{{URL::to($extra->image)}}"><img class="img-responsive" src="{{asset($extra->image)}}" alt="{{$extra->image}}"></a><br>
                         @empty
                         @endforelse
                      </div>
                    </div>
                  </div>
                </div>

                <ul class="list-inline">
                 {{--  <li class="pull-right">
                    <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments (5)</a></li> --}}
                </ul>
                 <br>
              </div>
            </div>







            <div class="tab-pane" id="timeline">
              <ul class="timeline timeline-inverse">
                <li class="time-label">
                     
                </li>
                <li>
                  <i class="fa fa-envelope bg-blue"></i>

                  <div class="timeline-item">

                    <h3 class="timeline-header"><a href="#">{{$user->membership->company_name}}</a></h3>

                    <div class="timeline-body">
                      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                      weebly ning heekya handango imeem plugg dopplr jibjab, movity
                      jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                      quora plaxo ideeli hulu weebly balihoo...
                    </div>
                  </div>
                </li>
                <li>
                  <i class="fa fa-user bg-aqua"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header no-border"><a href="#"></a>
                    </h3>
                  </div>
                </li>
                <li>
                  <i class="fa fa-camera bg-purple"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header"><a href="#">Certificket</a></h3>
                    <div class="timeline-body">
                      <img src="{{asset($user->cover_photo)}}" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div>



            <div class="tab-pane" id="add">
             <div class="panel panel-default">
                <div class="panel-heading text-center">
                  <h3>Create Your Product</h3>
                </div>
                
             </div> 
            </div>





            <div class="tab-pane" id="settings">
              <form class="form-horizontal">
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>









  <div class="panel panel-default">
    <div class="panel-heading text-center">
      <h3>Edit Your Membership</h3>
    </div>
    <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
          @include("admin.includes.message.message")
            <form method="post" action="{{route('membership.update',$membership->id)}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{ method_field("patch") }}
              <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                  <div class="title text-center"><h3>Address Info</h3></div>
              </div>
              <div class="row">
                   <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                     <label for="country_id" class="control-label"><h4>Country</h4></label>
                      <select class="form-control" name="country_id" required>
                        <option value="">Select One</option>
                        @forelse($countries as $country)
                            <option value="{{$country->id}}"  {{$country->id==$membership->country_id?'selected':''}}>{{$country->name}}</option>
                            @empty
                       <option value="">No Country</option>
                        @endforelse
                      </select> 
                      @if ($errors->has('country_id'))
                      <span class="help-block">
                          <strong style="color: red">{{ $errors->first('country_id') }}</strong>
                      </span>
                      @endif
                    </div>
                    
                   <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                       <label for="city_id" class="control-label"><h4>City</h4></label>
                        <select class="form-control" name="city_id" required>
                         
                          
                        </select> 
                        @if ($errors->has('city_id'))
                        <span class="help-block">
                            <strong style="color: red">{{ $errors->first('city_id') }}</strong>
                        </span>
                        @endif
                   </div>
                    <div class="form-group{{ $errors->has('district_id') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                       <label for="district_id" class="control-label"><h4>District</h4></label>
                        <select class="form-control" name="district_id" required>
                         
                          
                        </select> 
                        @if ($errors->has('district_id'))
                        <span class="help-block">
                            <strong style="color: red">{{ $errors->first('district_id') }}</strong>
                        </span>
                        @endif
                   </div>
                    
              </div>
               <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                  <div class="title text-center"><h3>Basic Into</h3></div>
              </div>
              <div class="row">
                  <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                      <label for="company_name" class="control-label"><h4>Company Name</h4></label>
                      <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" value="{{$membership->company_name}}" required>
                       @if ($errors->has('company_name'))
                      <span class="help-block">
                          <strong style="color:red">{{ $errors->first('company_name') }}</strong>
                      </span>
                  @endif
                  </div>
                   <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                      <label for="address" class="control-label"><h4>Address</h4></label>
                      <input type="text" name="address" id="address" class="form-control" placeholder="Company Address" value="{{$membership->address}}" required>
                       @if ($errors->has('address'))
                      <span class="help-block">
                          <strong style="color:red">{{ $errors->first('address') }}</strong>
                      </span>
                      @endif
                   </div>
                   <div class="form-group{{ $errors->has('product_type') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                      <label for="product_type" class="control-label"><h4>Product Category</h4></label>
                      <select class="form-control" name="category_id" required>
                          <optgroup label="Select One"> 
                        @forelse($categories as $category)
                            <option value="{{$category->id}}" {{$category->id==$membership->category_id?'selected':''}}>{{$category->name}}</option>
                            @empty
                       <option value="">No Category</option>
                        @endforelse
                          </optgroup>
                        </select>
                       @if ($errors->has('category_id'))
                      <span class="help-block">
                          <strong style="color:red">{{ $errors->first('category_id') }}</strong>
                      </span>
                      @endif
                   </div>
              </div>
                <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                  <div class="title text-center"><h3>Company Gallery</h3></div>
                </div>
              <div class="row">
                  <!-- Form Group -->
                  <div class="form-group{{ $errors->has('image1') ? ' has-error' : '' }} col-lg-6 col-md-6 col-sm-12">
                      <label><h4>Company Document</h4></label>
                       <input type="file" class='form-control' class="form-control-file" name='image1' id="exampleInputFile2" aria-describedby="fileHelp">
                       @if ($errors->has('image1'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('image1') }}</strong>
                        </span>
                       @endif
                  </div>
                  <div class="form-group{{ $errors->has('image2') ? ' has-error' : '' }} col-lg-6 col-md-6 col-sm-12">
                      <label><h4>More Documents</h4></label>
                       <input type="file" class='form-control' class="form-control-file" name='images[]' id="exampleInputFile2" aria-describedby="fileHelp" multiple>
                        @if ($errors->has('image2'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('image2') }}</strong>
                        </span>
                       @endif
                  </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                  <div class="title text-center"><h3>Detail Information</h3></div>
              </div>
              <div class="row">
                  <!-- Form Group -->
                  <div class="form-group col-lg-12">
                      <textarea name="detail" class="form-control my-editor" placeholder="Detailed Information" class="my-editor">{{$membership->detail}}</textarea>
                       @if ($errors->has('detail'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('detail') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group col-lg-3 col-md-6 col-sm-12">
                      <button type="submit" class="btn btn-success"> Submit Product</button>
                  </div>
              </div>
            </form>
          </div>
        </div>
    </div>
  </div> 
</section>
@endif
@endsection
@section('js')
<script>



  $(function(){
    var country=$('select[name="country_id"]');
    var city=$('select[name="city_id"]');
    var district=$('select[name="district_id"]');

    city.attr('disabled','disabled')
    district.attr('disabled','disabled')



     country.change(function(){
      var id=$(this).val();
      if(id==''){
       city.attr('disabled','disabled')
       s='<option value=""></option>'
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

var membership="<?php echo $membership->id ?>";
if(membership){
    // var cty="<?php echo $membership->city->name ?>";
    // var dst="<?php echo $membership->district->name ?>";

    // district.removeAttr('disabled')
    // city.removeAttr('disabled')

    // var cty='<option value="">Select One</option>';
    // cty +='<option value="'+row.id+'">'+row.name+'</option>'

    // city.html('<option value="">'+cty+'</option>');
    // district.html('<option value="">'+dst+'</option>');





      var id=country.val();
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
      }



      var id=city.val();
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



}
  })
</script>


<script src="{{asset('style/admin/tinymce/js/changeable.js')}}"></script>
<!-- Table js -->
<script src="{{asset('bazarbaariadmin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bazarbaariadmin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('style/admin/multipleselection/selection.js')}}"></script>


<script type="text/javascript" src="{{asset('bazarbaarifront/js/jquery-2.2.4.min.js')}}"></script>
<script>
<!-- SlimScroll -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection