@extends('admin.admin')
@section('navigation')
<section class="content-header">
  <h1><a href="/admin">Admmin Dashboard</a></h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i><span style="font-size:15px">Admin Dashboard</span></a></li>
    <li class="active"><span style="color:orange;font-size:15px">Orders</span></li>
  </ol>
</section>
@endsection
@section('content')
  <section class="content">
    @include('admin.includes.box')
      @include('admin.includes.message.message')
      @forelse($orders as $order)
      <div class="panel panel-default">
          <div class="panel-body">
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
                                <input type="text" class="form-control" name="transaction_no" id="transaction_no" placeholder="Plz Enter Transaction No" value="{{old('transaction_no')}}" required>              
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
              <form method="post" action="{{route('toggle.delivered',$order->id)}}" class="pull-right" > 
                {{csrf_field()}}
                    <label for="delivered">Delivered</label>
                    <input type="checkbox" name="delivered" value='1' {{$order->delivered==1?'checked':''}} required> 
                    <button type="submit" class="btn btn-success" id="delivered">Submit</button>
              </form>
            </div><br><br>
               <table class="table table-hover table-bordered table-striped">
                  <thead>
                     <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Owner Contact No</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Total</th>
                     </tr>
                  </thead>
                  <tbody>
                   @foreach($order->orderItems as $item)
                      <td>{{$order->id}}</td>
                      <td><img src="{{asset($item->image1)}}" alt="{{$order->image1}}" style="max-height:50px;max-width: 50px "></td>
                      <td><a href="{{route('single-product.show',$item->id)}}"> {{$item->name}}</a></td>
                      <td><a href="{{route('admin-membership.show',$item->user->membership->id)}}"> {{$item->user->mobile_no}}</a></td>
                      <td>{{$item->pivot->qty}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->pivot->total}}</td>
                  </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
      </div>
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
          {{ $orders->links() }}
        </div>
  </section>   
@endsection
