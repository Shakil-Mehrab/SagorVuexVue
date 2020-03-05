@extends('admin.admin')
@section('link')
  <link rel="stylesheet" href="{{asset('ecommerce/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('navigation')
 <section class="content-header">
      <h1>
        Data Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Reviews tables</li>
      </ol>
    </section>
@endsection
@section('content')
  <section class="content">
  	@include('admin.includes.box')
      <div class="row">
        <div class="col-xs-12">
          <div class="box"><br>
          @include("admin.includes.message.message")
          
             <div class=" col-md-12 box-header text-center">
              <h3 class="box-title">ReviewsTable</h3>
            </div>
            <!-- /.box-header -->
             <form method="post" action="{{route('review.delete')}}" enctype="multipart/form-data">
              @csrf
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Name</th>
                            <th>Product</th> 
                            <th>Review</th>  
                            <th>View</th>    
                            <th>Edit</th>    
                            <th>Delete</th>    
                        </tr>
                      </thead>

                      <tbody>
                        @forelse($reviews as $property)
                        <tr>
                            <td>{{$property->id}}</td>
                            <td><input type="checkbox" name="checkboxes[]" value="{{$property->id}}" class="checkboxes"></td>
                            <td>{{$property->name}}</td>
                            <td>{{$property->product->name}}</td>
                            <td>@php echo str_limit($property->body,10) @endphp</td>
                            <td> <a href="{{route('review.show',$property->id)}}"><span style="color:green"><i class="fa fa-eye"></i></span></a></td>
                            <td><a href="{{route('review.edit',$property->id)}}" ><span style=""><i class="fa fa-pencil"></i></span></a></td>
                            <td><button type="submit"><span style="color:#DD4F43"><i class="fa fa-trash"></i></span></button></td>

                         </tr>
                        @empty
                        <tr>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4>No Review</h4></td>
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
                    <th>Product</th> 
                    <th>Review</th>  
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
<script src="{{asset('ecommerce/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('ecommerce/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
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