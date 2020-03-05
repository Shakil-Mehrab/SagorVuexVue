@extends('admin.admin')
@section('link')
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('navigation')
<section class="content-header">
  <h1><a href="/admin">Admmin Dashboard</a></h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i><span style="font-size:15px">Admin Dashboard</span></a></li>
    <li class="active"><span style="color:orange;font-size:15px">Product</span></li>
  </ol>
</section><br>
@endsection
@section('content')
  <section class="content">
  	@include('admin.includes.box')
      <div class="row">
        <div class="col-xs-12">
          <div class="box"><br>
          @include("admin.includes.message.message")
          
             <div class=" col-md-12 box-header text-center">
              <h3 class="box-title">ProductsTable</h3>
            </div>
            <!-- /.box-header -->
             <form method="post" action="{{route('product.delete')}}" enctype="multipart/form-data">
              @csrf
              {{ method_field("DELETE") }}
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
                            <th>Owner</th>   
                            <th>View</th>    
                            <th>Edit</th>    
                            <th>Delete</th>    
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
                            <td>
                              <ul class="nav navbar-nav">
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$property->status}}<span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                    @if($property->status=="approved")
                                    <li><a href="{{route('status.update',$property->id)}}">Change To Pending</a></li>
                                    @else
                                    <li><a href="{{route('status.update',$property->id)}}">Change To Approved</a></li>
                                    @endif
                                  </ul>
                                </li>
                              </ul>  
                            </td>
                            <td>{{$property->price}}</td>
                            <td>{{$property->qty}}</td>
                            <td><a href="{{route('user.show',$property->user_id)}}">{{$property->user->name}}</a></td>
                            <td> <a href="{{route('single-product.show',$property->id)}}"><span style="color:green"><i class="fa fa-eye"></i></span></a></td>
                            <td><a href="{{route('product.edit',$property->id)}}" ><span style=""><i class="fa fa-pencil"></i></span></a></td>
                            <td><button type="submit"><span style="color:#DD4F43"><i class="fa fa-trash"></i></span></button></td>

                         </tr>
                        @empty
                        <tr>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4>No product</h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>     
                            <td><h4></h4></td>  
                            <td><h4></h4></td> 
                            <td><h4></h4></td> 

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
                      <th>Owner</th>   
                      <th>View</th>    
                      <th>Edit</th>    
                      <th>Delete</th>   
                  </tr>
                </tfoot>
              </table>
            </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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

     