@extends('admin.admin')
@section('link')
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('navigation')
<section class="content-header">
      <h1><a href="/admin">Admmin Dashboard</a></h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i><span style="font-size:15px">Admin Dashboard</span></a></li>
        <li class="active"><span style="color:orange;font-size:15px">Slide</span></li>
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
             <div class="col-md-8 col-md-offset-2">
	            <div class="content-wrap well text-center">
	                <a href="#"><button class="btn btn-success" data-toggle="modal" data-target="#mymodal"> Add Slide</button></a>
	            </div>
	        </div>
             <div class=" col-md-12 box-header text-center">
              <h3 class="box-title">Slide Table</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                      </thead>

                      <tbody>
                        @forelse($products as $property)
                        <tr>
                            <td>{{$property->id}}</td>
                            <td>{{$property->name}}</td>
                            <td><img src="{{URL::to($property->image)}}" style="max-height:40px;min-height: 40px;max-width: 40px;min-width: 40px"></td>
                            <td><a href="#" ><span data-toggle="modal" data-target="#mymodal-{{$property->id}}"><i class="fa fa-pencil"></i></span></a></td>

                        <div id="mymodal-{{$property->id}}" class="modal fade" tabindex="-1" role="dialog" >
                          <div class="modal-dialog" role="document">
                              <form method="post" action="{{route('slide.update',$property->id)}}" class="forms-sample" enctype="multipart/form-data"> 
                                {{csrf_field()}}
                                {{method_field('patch')}}
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update Slide</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="Category">Slide Name<span style='color:red'>*</span></label>
                                            <select class="form-control" name="name" required>
										        <optgroup label="Select One"> 
										            <option value="home" {{$property->name=='home'?'selected':''}}>Home</option>
										            <option value="pavilion" {{$property->name=='pavilion'?'selected':''}}>Pavilion</option>
										            <option value="helpline" {{$property->name=='helpline'?'selected':''}}>Helpline</option>
										            <option value="about" {{$property->name=='about'?'selected':''}}>About</option>
										            <option value="other" {{$property->name=='other'?'selected':''}}>Other</option>
										        </optgroup>
										    </select>
                                        </div>
                                       <div class="form-group">
                                          <label><h4>Upload Image</h4></label>
                                           <input type="file" class='form-control' class="form-control-file" name='image' id="exampleInputFile2" aria-describedby="fileHelp">
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Update Slide">
                                    </div>
                                </div>
                              </form>
                          </div>
                        </div>



                            <td><a href="{{route('slide.delete',$property->id)}}"><button type="submit"><span style="color:#DD4F43"><i class="fa fa-trash"></i></span></button></a></td>

                         </tr>
                        @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td>No product</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforelse
                      </tbody>
              </table>
				<div id="mymodal" class="modal fade" tabindex="-1" role="dialog" >
    		        <div class="modal-dialog" role="document">
    	              <form method="post" action="{{route('slide.store')}}" class="forms-sample" enctype="multipart/form-data"> 
    	                  {{csrf_field()}}
    		          	<div class="modal-content">
    			            <div class="modal-header">
    			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			              <h4 class="modal-title">Add Slide</h4>
    			            </div>
    			            <div class="modal-body">
    			              <div class="form-group">
    			                  <label for="name" class="control-label"><h4>Slide Name</h4></label>
			                      <select class="form-control" name="name" required>
							        <optgroup label="Select One"> 
							            <option value="home">Home</option>
							            <option value="pavilion">Pavilion</option>
							            <option value="helpline">Helpline</option>
							            <option value="about">about</option>
							            <option value="other">Other</option>
							        </optgroup>
							    </select>
			                      @if ($errors->has('name'))
			                        <span class="help-block">
			                          <strong style="color:red">{{ $errors->first('name') }}</strong>
			                        </span>
			                      @endif
    			              </div>
	                         <div class="form-group">
	                            <label><h4>Upload Image</h4></label>
	                             <input type="file" class='form-control' class="form-control-file" name='image' id="exampleInputFile2" aria-describedby="fileHelp">
	                        </div>
    			            </div>
    			            <div class="modal-footer">
    			              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    			              <button type="submit" class="btn btn-primary">Create Slide</button>
    			            </div>
    		        	</div><!-- /.modal-content -->
    		           </form>
    		        </div><!-- /.modal-dialog -->
    		    </div>


            </div>
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

