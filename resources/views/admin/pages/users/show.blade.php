@extends('admin.admin')
@section('link')
    <!-- Related Css ============================================ -->
    <link rel="stylesheet" href="{{asset('dist/css/foundation.css')}}"/>
    <link rel="stylesheet" href="{{asset('dist/css/app.css')}}"/> 
@endsection
@section('navigation')
 <section class="content-header">
  <h1><a href="/admin">Admmin Dashboard</a></h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i><span style="font-size:15px">Admin Dashboard</span></a></li>
     <li class="active"><a href="admin/product"><span style="font-size:15px">Product</span></a></li>
    <li class="active"><span style="color:orange;font-size:15px">Show</span></li>
  </ol>
</section>
@endsection
@section('content')
<section class="content">
                @include('admin.includes.box')
      <div class="row">
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-body box-profile">
              <a href="{{URL::to($user->image)}}">
                <img class="profile-user-img img-responsive img-circle" src="{{URL::to($user->image)}}" alt="User profile picture">
              </a>
              <p class="text-muted text-center"><a href="{{route('user-user.edit',$user->id)}}">Edit Profile Photo</a></p>
              <h3 class="profile-username text-center">{{ucfirst($user->name)}}</h3>

            </div>
          </div>
          <div class="box box-primary" style="margin-top: -20px">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <div class="box-body">
               <p class="text-muted"><img src="{{asset($user->country->image)}}" width="5%" alt="flag"> {{$user->country->name}}</p>
               <p class="text-muted"><i class="fas fa-city"></i> {{$user->city->name}}</p>
               <p class="text-muted"><i class="fas fa-city"></i> {{$user->district->name}}</p>
               <p class="text-muted"><i class="fas fa-envelope"></i> {{$user->email}}</p>
               <p><i class="fa fa-phone"></i> {{$user->phone}} </p>
              
            </div>
          </div>
          
        </div>
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <div class="post">
                  <div class="row">
                    <div class="col-sm-12">
                      <a href="{{URL::to('images/users/cover/default.gif')}}">
                        <img class="img-responsive" src="{{URL::to('images/users/cover/default.gif')}}" width="100%" style="height:330px" alt="{{$user->cover_photo}}">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</section>


@php
use App\Model\Product;
$products=Product::orderBy('id','desc')->get();
@endphp
  <section class="content">
   
    @include('layouts.pages.users.box')
    <hr>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><a href=""><span > <h3><strong>Order Information</strong></h3></span></a></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
         <div class="panel-heading text-center" style="background: #202B38;color:white"><h3><strong>Pending Order By Hatirpal </strong></h3></div>
          <div class="panel-body">
            @forelse($pending_orders as $order)
              <div class="row">
                <div class="col-md-6">
                      <h6><span style="color:#00C0EF"><i class="fa fa-user"></i> Order By</span> : <strong>{{$order->user->name}}</strong></h6>
                      <h6><span style="color:#00C0EF"><i class="fa fa-mobile"></i> Orderer Contact No</span> : <strong>{{$order->user->mobile_no}}</strong></h6>

                      <h6><span style="color:#00C0EF"><i class="fas fa-dollar-sign"></i> Total Price</span> : <strong>$ {{$order->total}}<strong></h6>
                      <h6><span style="color:#00C0EF"><i class="fas fa-clock"></i> Date</span> : <strong> {{$order->created_at->diffForHumans()}}<strong></h6>

                        
                </div>  
                <div class="col-md-6">     
                      <h6><span style="color:#00C0EF"><i class="fa fa-phone"></i> Customer Contact No</span>  : <strong> {{$order->address->phone_no}}</strong></h6>
                      <h6><span style="color:#00C0EF"><i class="fab fa-paypal"></i> Payment Method</span> : <strong> {{$order->payment_method}}</strong></h6>
                       <h6><span style="color:#00C0EF"><i class="fas fa-map-signs"></i> Address</span> : <strong> {{$order->address->address}},{{$order->address->city->name}},{{$order->address->country->name}}</strong></h6>


                        @if($order->transaction_no==0)
                          <form action="{{route('payment.transation_no.update',$order->id)}}" class="checkout woocommerce-checkout" method="post" name="checkout" enctype="multipart/form-data">
                          @csrf
                           
                           <div class="form-group{{ $errors->has('transaction_no') ? ' has-error' : '' }} col-md-6">
                             
                               <input type="text" class="form-control" name="transaction_no" id="transaction_no" placeholder="Plz Enter Transaction No" value="{{old('transaction_no')}}">              
                               @if ($errors->has('transaction_no'))
                                <span class="help-block">
                                    <strong style="color: red">{{ $errors->first('transaction_no') }}</strong>
                                </span>
                            @endif
                           </div>
                           <div class="form-group col-md-3">
                               <input type="Submit" class="form-control btn btn-success" value="Submit">              
                               
                           </div>
                        </form>
                        @else
                         <h6><span style="color:#00C0EF"><i class="fas fa-map-signs"></i> Transaction No</span> : <strong> {{$order->transaction_no}}</strong></h6>
                        @endif
                        

                </div>
              </div>
              <div class="col-md-12">
                <div style="float:left">
                  <form method="post" action="{{route('order.delete',$order->id)}}" class="pull-right" > 
                  {{csrf_field()}}
                      <button type="submit" class="btn btn-danger" id="delivered">Delete</button>
                  </form>
                </div>       
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
                      <td><a href="{{route('single-product.show',$item->id)}}"> {{$item->name}}</a></td>
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
         <div class="panel-heading text-center" style="background: #202B38;color:white"><h3><strong>Delivered Order By Hatirpal </strong></h3></div>
          <div class="panel-body">
            @forelse($orders_delivered as $order)
              <div class="row">
                <div class="col-md-6">
                      <h6><span style="color:#00C0EF"><i class="fa fa-user"></i> Order By</span> : <strong>{{$order->user->name}}</strong></h6>
                      <h6><span style="color:#00C0EF"><i class="fa fa-mobile"></i> Orderer Contact No</span> : <strong>{{$order->user->mobile_no}}</strong></h6>

                      <h6><span style="color:#00C0EF"><i class="fas fa-dollar-sign"></i> Total Price</span> : <strong>$ {{$order->total}}<strong></h6>
                        
                </div>  
                <div class="col-md-6">     
                      <h6><span style="color:#00C0EF"><i class="fa fa-phone"></i> Customer Contact No</span>  : <strong> {{$order->address->phone_no}}</strong></h6>
                      <h6><span style="color:#00C0EF"><i class="fab fa-paypal"></i> Payment Method</span> : <strong> {{$order->payment_method}}</strong></h6>
                       <h6><span style="color:#00C0EF"><i class="fas fa-map-signs"></i> Address</span> : <strong> {{$order->address->address}},{{$order->address->city->name}},{{$order->address->country->name}}</strong></h6>
                </div>
              </div>
              <div class="col-md-12">
                <div style="float:left">
                  <form method="post" action="{{route('order.delete',$order->id)}}" class="pull-right" > 
                  {{csrf_field()}}
                      <button type="submit" class="btn btn-danger" id="delivered">Delete</button>
                  </form>
                </div>       
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
























  
@endsection

@section('js')
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