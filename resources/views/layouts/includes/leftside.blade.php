@php 
use App\User;
use App\Model\User_product_view;
use App\Model\Order;
use App\Model\Category;
use App\Model\Review;
use App\Model\Product;
use App\Model\Membership;
$visitors=User_product_view::all();
$orders_pending=Order::where('delivered',0);
$orders_delivered=Order::where('delivered',1);
$orders=Order::all();
$users=User::all();
$categories=Category::all();
$reviews=Review::all();
$products=Product::all();
$membership=Membership::where('user_id',auth()->user()->id)->where('status','approved')->first();
$membership_create=Membership::where('user_id',auth()->user()->id)->first();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="index3.html" class="brand-link">
    <img src="{{asset('defaultImage/developer.JPG')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Shakil Mehrab</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('defaultImage/user.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if($membership)
        <li class="nav-item">
          <router-link to="/home" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>Dashboard</p>
          </router-link>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>Products<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <router-link to="/all/product" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Products</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/add/product" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Product</p>
              </router-link>
            </li>
          </ul>
        </li>
        @endif
        <li class="nav-item">
          @if(!empty($membership_create))
          <router-link to="/membership/information" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>Membership Information</p>
          </router-link>
          @else
            <router-link to="/membership/create" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>Create Suppliers Membership</p>
          </router-link>
          @endif
        </li>
        <li class="nav-item">
          <router-link to="/user/information" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>User Information</p>
          </router-link>
        </li>
        <li class="nav-item">
          <div style="margin-left: 20px">
            <div class="fb-messengermessageus" 
              messenger_app_id="451585265723432" 
              page_id="105488687708483"
              color="blue"
              size="large" >
            </div> 
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>{{ __('Logout') }}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
        </li>
      </ul>
    </nav>
  </div>
</aside>
 