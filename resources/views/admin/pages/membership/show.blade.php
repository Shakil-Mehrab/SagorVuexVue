@php
use App\Model\Order;
use App\Model\Product;

$pending_orders=Order::orderBy('id','desc')->where('user_id',$membership->user->id)->where('delivered',0)->paginate(1);
$orders_delivered=Order::orderBy('id','desc')->where('user_id',$membership->user->id)->where('delivered',1)->paginate(1);
$products=Product::orderBy('id','desc')->where('user_id',$membership->user->id)->get();

@endphp

@extends('admin.admin')
@section('link')
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Related Css ============================================ -->
    <link rel="stylesheet" href="{{asset('dist/css/foundation.css')}}"/>
    <link rel="stylesheet" href="{{asset('dist/css/app.css')}}"/> 
@endsection
@section('navigation')
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="active">User</li>
user
  </ol>
</section>
@endsection
@section('content')
<section class="content">
    @include('admin.includes.box')
     <div class="row">
      {{-- Profile Photo --}}
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <a href="{{asset($membership->user->image)}}">
              <img class="profile-user-img img-responsive img-circle" src="{{asset($membership->user->image)}}" alt="User profile picture">
            </a>
            <p class="text-muted text-center"><a href="{{route('user-user.edit',$membership->user->id)}}">Edit Profile</a></p>
            <h4 class="profile-username text-center">{{ucfirst($membership->user->name)}}</h4>
            <h4 class="profile-username text-center"><strong>Supplier From {{ucfirst($membership->company_name)}}</strong></h4>
          </div>
        </div>
        <div class="box box-primary" style="margin-top: -20px">
          <div class="box-header with-border">
            <h3 class="box-title">About Company</h3>
          </div>
          <div class="box-body">
            <p><img src="{{asset($membership->country->image)}}" width="5%" alt="flag"> Country :  {{$membership->country->name}}</p>
            <p><i class="fas fa-city"></i> City :  {{$membership->city->name}}</p>
            <p><i class="fas fa-city"></i> District :  {{$membership->district->name}}</p>
            <p><i class="fas fa-align-justify"></i> Product Type :  {{$membership->category->name}}</p>
            <p><i class="fas fa-phone"></i> {{$membership->user->phone}}</p>
            <p><i class="fas fa-envelope"></i> {{$membership->user->email}}</p>
            <p><i class="fa fa-map-marker margin-r-5"></i>{{$membership->address}}</p>
            <hr>
          </div>
        </div>
      </div>

      {{-- Cover Photo --}}
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
                    <a href="{{asset($membership->image)}}">
                      <img class="img-responsive" src="{{asset($membership->image)}}" alt="{{$membership->image}}"></a>
                    

                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-sm-6">
                          @forelse($membership->membership_extra_image as $extra)
                        <a href="{{URL::to($extra->image)}}"><img class="img-responsive" src="{{asset($extra->image)}}" alt="{{$extra->image}}"></a><br>
                         @empty
                         @endforelse
                      </div>
                      <div class="col-sm-6">
                         @forelse($membership->membership_extra_image2nd as $extra)
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

                    <h3 class="timeline-header"><a href="#">{{$membership->company_name}}</a></h3>

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
                      <img src="{{asset($membership->user->cover_photo)}}" alt="..." class="margin">
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
</section>



<section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><a href=""><span > <h3><strong>Ordered Products Info</strong></h3></span></a></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
         <div class="panel-heading text-center" style="background: #202B38;color:white"><h3><strong>Pending By The Company </strong></h3></div>
          <div class="panel-body">
            @forelse($pending_orders as $order)
             
              <div class="col-md-12">
                <form   class="pull-right" > 
                      <label for="delivered">Delivered</label>
                      <input type="checkbox" name="delivered" value='1' {{$order->delivered==1?'checked':''}}> 
                </form>
              </div><br><br>
               <table class="table table-hover table-bordered table-striped">
                  <thead>
                      <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Total</th>
                      </tr>
                  </thead>
                  <tbody>
                    
                   @foreach($order->orderItems as $item)
                      <tr>
                      <td>{{$order->id}}</td>
                      <td><img src="{{asset($item->image1)}}" alt="{{$order->image1}}" style="max-height:50px;max-width: 50px "></td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->pivot->qty}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->pivot->total}}</td>
                  </tr>
                  @endforeach
                  </tbody>
              </table>
              @empty
              <div class="panel panel-default">
                  <div class="panel-body">
                     <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                              <th>Name</th>
                              <th>Quantity</th>
                              <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td></td>
                              <td><h4>No Order</h4></td>
                              <td></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </div>
              @endforelse 
              <div class="text-center">
                {{ $pending_orders->links() }}
            </div>
          </div>
        </div>
      </div>
  
      <div class="col-lg-12">
        <div class="panel panel-default">
         <div class="panel-heading text-center" style="background: #202B38;color:white"><h3><strong>Delivered By The Company </strong></h3></div>
          <div class="panel-body">
            @forelse($orders_delivered as $order)
              <div class="col-md-12">
                <form method="post" action="{{route('toggle.delivered',$order->id)}}" class="pull-right" > 
                  {{csrf_field()}}
                      <label for="delivered">Delivered</label>
                      <input type="checkbox" name="delivered" value='1' {{$order->delivered==1?'checked':''}}> 
                      <button type="submit" class="btn btn-success" id="delivered">Submit</button>
                </form>
              </div><br><br>
               <table class="table table-hover table-bordered table-striped">
                  <thead>
                      <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Total</th>
                      </tr>
                  </thead>
                  <tbody>
                    
                   @foreach($order->orderItems as $item)
                      <tr>
                      <td>{{$order->id}}</td>
                      <td><img src="{{asset($item->image1)}}" alt="{{$order->image1}}" style="max-height:50px;max-width: 50px "></td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->pivot->qty}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->pivot->total}}</td>
                  </tr>
                  @endforeach
                  </tbody>
              </table>
              @empty
              <div class="panel panel-default">
                  <div class="panel-body">
                     <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                              <th>Name</th>
                              <th>Quantity</th>
                              <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td></td>
                              <td><h4>No Order</h4></td>
                              <td></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </div>
              @endforelse 
              <div class="text-center">
                {{ $orders_delivered->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
</section>



  <section class="content">


   <!-- layouts.includes.bo -->




      <div class="row">
        <div class="col-xs-12">
          <div class="box"><br>
          @include("admin.includes.message.message")
             <div class=" col-md-12 box-header text-center">
              <h3 class="box-title">ProductsTable</h3>
            </div>
             <form method="post" action="{{route('product.delete')}}" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th><input type="checkbox" id="selectallboxes"></th>
                              <th>Name</th>
                              <th>Category</th>
                              <th>Size</th>
                              <th>image</th>
                              <th>Status</th> 
                              <th>Price</th>  
                              <th>Quantity</th>  
                              <th>View</th>       
                          </tr>
                        </thead>

                        <tbody>
                          @forelse($products as $property)
                          <tr>
                              <td>{{$property->id}}</td>
                              <td><input type="checkbox" name="checkboxes[]" value="{{$property->id}}" class="checkboxes"></td>
                              <td>@php echo str_limit($property->name,10) @endphp</td>
                              <td>{{$property->category->name}}</td>
                              <td>{{$property->size}}</td>
                              <td><img src="{{URL::to($property->image1)}}" style="max-height:40px;min-height: 40px;max-width: 40px;min-width: 40px"></td>
                              <td>{{$property->status}}</td>
                              <td>{{$property->price}}</td>
                              <td>{{$property->qty}}</td>
                              <td> <a href="{{route('single-product.show',$property->id)}}"><span style="color:green"><i class="fa fa-eye"></i></span></a></td>
                           </tr>
                          @empty
                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>No Products</td>
                              <td></td>
                              <td></td>     
                              <td></td>  
                              <td></td> 
                          </tr>
                          @endforelse
                        </tbody>
                  <tfoot>
                   <tr>
                        <th>ID</th>
                        <th><input type="checkbox" id="selectallboxes"></th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Size</th>
                        <th>image</th>
                        <th>Status</th> 
                        <th>Price</th>  
                        <th>Detail</th>  
                        <th>View</th>      
                    </tr>
                  </tfoot>
                </table>
              </div>
            </form>
          </div>
        </div>
      </div>
  </section>
@endsection
@section('js')
<script src="{{asset('bazarbaariadmin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bazarbaariadmin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('style/admin/multipleselection/selection.js')}}"></script>

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

     
