@php 
use App\User;
use App\Model\User_product_view;
use App\Model\Order;
use App\Model\Category;
use App\Model\Review;
use App\Model\Product;
use App\Model\Slide;

$visitors=User_product_view::all();
$orders_pending=Order::where('delivered',0);
$orders_delivered=Order::where('delivered',1);
$orders=Order::all();
$users=User::all();
$categories=Category::all();
$reviews=Review::all();
$products=Product::all();
$slide=Slide::all();

@endphp
 <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset(Auth::user()->image)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <a href="{{route('user.show',Auth::user()->id)}}"> {{Auth::user()->name}}</a>
          <a href="{{route('user.show',Auth::user()->id)}}"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- search form -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{route('home')}}"><i class="fa fa-tachometer"></i> User Dashboard</a></li>
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-tachometer"></i> Admin Dashboard</a></li>
          </ul>
        </li>
        
        <li class="treeview">
            <a href="#">
              <i class="fa fa-table"></i> <span>Tables</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
              <ul class="treeview-menu">
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-table"></i> <span>Product</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                    <ul class="treeview-menu">
                       <li><a href="{{route('product.index')}}"><i class="fa fa-list"></i> <span>Index</span>
                        <span class="pull-right-container">
                          <small class="label pull-right bg-blue">{{$products->count()}}</small>
                        </span> 
                      </a></li>

                      <li><a href="{{route('product.create')}}"><i class="fa fa-list"></i> Create Product</a></li>
                    </ul>
                </li>

                 <li class="treeview">
                  <a href="#">
                    <i class="fa fa-table"></i> <span>Category</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                    <ul class="treeview-menu">
                      <li><a href="{{route('category.index')}}"><i class="fa fa-list"></i> 
                        <span>Index</span>
                        <span class="pull-right-container">
                          <small class="label pull-right bg-yellow">{{$categories->count()}}</small>
                        </span> 
                      </a></li>
                    </ul>
                </li>

                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-table"></i> <span>User</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                    <ul class="treeview-menu">
                      <li><a href="{{route('user.index')}}"><i class="fa fa-list"></i> 
                        <span>Index</span>
                        <span class="pull-right-container">
                          <small class="label pull-right bg-yellow">{{$users->count()}}</small>
                        </span> 
                      </a></li>
                    </ul>
                </li>

                 <li class="treeview">
                  <a href="#">
                    <i class="fa fa-table"></i> <span>Color</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                    <ul class="treeview-menu">
                      <li><a href="{{route('color.index')}}"><i class="fa fa-list"></i> 
                        <span>Index</span>
                        <span class="pull-right-container">
                          <small class="label pull-right bg-yellow">{{$orders->count()}}</small>
                        </span> 
                      </a></li>
                    </ul>
                </li>

                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-table"></i> <span>Review</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                    <ul class="treeview-menu">
                      <li><a href="{{route('review.index')}}"><i class="fa fa-list"></i> 
                        <span>Index</span>
                        <span class="pull-right-container">
                          <small class="label pull-right bg-yellow">{{$reviews->count()}}</small>
                        </span> 
                      </a></li>
                    </ul>
                </li>

              </ul>
        </li>
         <li class="treeview">
            <a href="#">
              <i class="fa fa-table"></i> <span>Order</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
              <ul class="treeview-menu">
                <li><a href="{{url('admin/orders')}}"><i class="fa fa-list"></i> 
                  <span>Index</span>
                  <span class="pull-right-container">
                    <small class="label pull-right bg-blue">{{$orders->count()}}</small>
                  </span> 
                </a></li>

                <li><a href="{{url('admin/orders/pending')}}"><i class="fa fa-list"></i>
                  <span>Order Pending</span>
                  <span class="pull-right-container">
                    <small class="label pull-right bg-red">{{$orders_pending->count()}}</small>
                  </span> 
                </a></li>

                <li><a href="{{url('admin/orders/delivered')}}"><i class="fa fa-list"></i>
                  <span>Order Delivered</span>
                  <span class="pull-right-container">
                    <small class="label pull-right bg-green">{{$orders_delivered->count()}}</small>
                  </span> 
                </a></li>
              </ul>
          </li>
      </ul>
    </section>
  </aside>