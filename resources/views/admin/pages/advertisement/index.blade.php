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
        <li class="active">Products tables</li>
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
              <h3 class="box-title">ProductsTable</h3>
            </div>
            <!-- /.box-header -->
             <form method="post" action="{{route('slide.delete')}}" enctype="multipart/form-data">
              @csrf
              {{ method_field("DELETE") }}
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Video</th>
                            <th>Delete</th>    
                        </tr>
                      </thead>

                      <tbody>
                        @forelse($products as $property)
                        <tr>
                            <td>{{$property->id}}</td>
                            <td><input type="checkbox" name="checkboxes[]" value="{{$property->id}}" class="checkboxes"></td>
                            <td>@php echo str_limit($property->title,10) @endphp</td>
                            <td>@php echo str_limit($property->link,20) @endphp</td>
                            <td>
                              
                            <iframe width="200" height="112" src="{{$property->link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>






                            </td>
                            <td><button type="submit"><span style="color:#DD4F43"><i class="fa fa-trash"></i></span></button></td>

                         </tr>
                        @empty
                        <tr>
                            
 
                        </tr>
                        @endforelse
                      </tbody>
                <tfoot>
                 <tr>
                      <th>ID</th>
                      <th><input type="checkbox" id="selectallboxes"></th>
                      <th>Title</th>
                      <th>Link</th>
                      <th>Video</th>  
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
<div>

</div>











<section class="content">
  <div class="panel panel-default">
    <div class="panel-heading text-center">
      <h3>Create Your Video</h3>
    </div>
    <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
          @include("admin.includes.message.message")
            <form method="post" action="{{route('video.store')}}" enctype="multipart/form-data">
            {{csrf_field()}}
              <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                  <div class="title text-center"><h3>Basic Into</h3></div>
              </div>
              <div class="row">
                  <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }} col-lg-6 col-md-6 col-sm-12">
                      <label for="title" class="control-label"><h4>Video Title</h4></label>
                      <input type="text" name="title" id="title" class="form-control" placeholder="Video Title" value="{{Request::old('title')}}">
                       @if ($errors->has('title'))
                      <span class="help-block">
                          <strong style="color:red">{{ $errors->first('title') }}</strong>
                      </span>
                  @endif
                  </div>
            
                 <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }} col-lg-6 col-md-6 col-sm-12">
                      <label for="link" class="control-label"><h4>Video Link</h4></label>
                      <input type="text" name="link" id="link" class="form-control" placeholder="Video Link" value="{{Request::old('link')}}">
                       @if ($errors->has('link'))
                      <span class="help-block">
                          <strong style="color:red">{{ $errors->first('link') }}</strong>
                      </span>
                  @endif
                  </div>
                 
              </div>

           
                
                 
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-md-offset-5">
                      <button type="submit" class="btn btn-success"> Upload Video</button>
                  </div>
              </div>
            </form>
          </div>
        </div>
    </div>
   </div>     
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

     