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
      <div class="info"><a href="#" class="d-block">{{Auth::user()->name}}</a></div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p> Dashboard <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <router-link to="/" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Admin Dashboard</p></router-link>
            </li>
             <li class="nav-item">
              <router-link to="/home" class="nav-link"><i class="far fa-circle nav-icon"></i><p>User Dashboard</p></router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <router-link to="/admin/all/product" class="nav-link"><i class="nav-icon fas fa-table"></i><p>Products</p></router-link>
        </li>
        <li class="nav-item">
          <router-link to="/admin/all/category" class="nav-link"><i class="nav-icon fas fa-table"></i><p>Categories</p></router-link>
        </li>
        <li class="nav-item">
          <router-link to="/admin/all/member" class="nav-link"><i class="nav-icon fas fa-table"></i><p>Membership</p></router-link>
        </li>
        <li class="nav-item">
          <router-link to="/admin/all/user" class="nav-link"><i class="nav-icon fas fa-table"></i><p>Users</p></router-link>
        </li>
        <li class="nav-item">
          <router-link to="/admin/all/country" class="nav-link"><i class="nav-icon fas fa-table"></i><p>Countries</p></router-link>
        </li>
         <li class="nav-item">
          <router-link to="/admin/all/city" class="nav-link"><i class="nav-icon fas fa-table"></i><p>Cities</p></router-link>
        </li>
        <li class="nav-item">
          <router-link to="/admin/all/district" class="nav-link"><i class="nav-icon fas fa-table"></i><p>Districts</p></router-link>
        </li>
         <li class="nav-item">
          <router-link to="/admin/all/area" class="nav-link"><i class="nav-icon fas fa-table"></i>
            <p>Areas</p></router-link>
        </li>
         <li class="nav-item has-treeview">
          <a href="#" class="nav-link"> <i class="nav-icon fas fa-table"></i><p>Orders<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <router-link to="/admin/all/order" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Orders</p></router-link>
            </li>
            <li class="nav-item">
              <router-link to="/admin/pending/order" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Pending Orders</p></router-link>
            </li>
            <li class="nav-item">
              <router-link to="/admin/delivered/order" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Delivered Orders</p></router-link>
            </li>
          </ul>
        </li>
         <li class="nav-item">
          <router-link to="/admin/all/slide" class="nav-link"><i class="nav-icon fas fa-table"></i><p>Slides</p></router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>{{ __('Logout') }}</a>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
      </ul>
    </nav>
  </div>
</aside>
 