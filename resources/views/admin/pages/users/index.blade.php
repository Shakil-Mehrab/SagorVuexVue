@extends('admin.admin')
@section('link')
  <link rel="stylesheet" href="{{asset('ecommerce/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('navigation')
<section class="content-header">
  <h1><a href="/admin">Admmin Dashboard</a></h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i><span style="font-size:15px">Admin Dashboard</span></a></li>
    <li class="active"><span style="color:orange;font-size:15px">User</span></li>
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
              <h3 class="box-title">UserTable</h3>
            </div>
            <!-- /.box-header -->
             <form method="post" action="{{route('user.delete')}}" enctype="multipart/form-data">
              @csrf
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Type</th>
                            <th>View</th>    
                            <th>Edit</th>    
                            <th>Delete</th>    
                        </tr>
                      </thead>

                      <tbody>
                        @forelse($users as $property)
                        <tr>
                            <td>{{$property->id}}</td>
                            <td><input type="checkbox" name="checkboxes[]" value="{{$property->id}}" class="checkboxes"></td>
                            <td>{{$property->name}}</td>
                            <td>{{$property->email}}</td>
                            <td><img src="{{URL::to($property->image)}}" style="max-height:40px;min-height: 40px;max-width: 40px;min-width: 40px"></td>
                            <td>
                              @if(!empty($property->membership->status))
                              {{$property->membership->status}}
                              @else
                               User Only
                              @endif
                            </td>
                            <td> <a href="{{route('user.show',$property->id)}}"><span style="color:green"><i class="fa fa-eye"></i></span></a></td>
                            <td><a href="{{route('user.edit',$property->id)}}" ><span style=""><i class="fa fa-pencil"></i></span></a></td>
                            <td><button type="submit"><span style="color:#DD4F43"><i class="fa fa-trash"></i></span></button></td>

                         </tr>
                        @empty
                        <tr>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4>No User</h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>
                            <td><h4></h4></td>     
                            <td><h4></h4></td>  
                        </tr>
                        @endforelse
                      </tbody>
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
<script src="{{asset('style/admin/tinymce/js/changeable.js')}}"></script>
<!-- Table js -->
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