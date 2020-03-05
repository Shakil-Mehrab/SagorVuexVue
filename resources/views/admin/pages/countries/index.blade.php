@extends('admin.admin')
@section('navigation')
<section class="content-header">
  <h1><a href="/admin">Admmin Dashboard</a></h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i><span style="font-size:15px">Admin Dashboard</span></a></li>
    <li class="active"><span style="color:orange;font-size:15px">Country</span></li>
  </ol>
</section><br>
@endsection
@section('content')
<div class="dashboard">
        <div class="container-fluid">
            <div class="content-area">
                <div class="dashboard-content">
                     @include('admin.includes.box')
                </div>
            </div>
        </div>
    </div>
 <div class="dashboard">
    <div class="container-fluid">
        <div class="content-area">
            <div class="dashboard-content">
				<div class="row">    
			        <div class="col-md-8 col-md-offset-2">
			            <div class="content-wrap well text-center">
			                <a href="#"><button class="btn btn-success" data-toggle="modal" data-target="#mymodal"> Add Country</button></a>
			            </div>
			        </div>
					<div class="col-md-8 col-md-offset-2"> 
					@include('admin.includes.message.message')    
		
            <table class="table table-hover table-striped table-bordered">
                  <thead>
                  <tr>
                      <th>id</th>
                      <th>Country</th> 
                      <th>Pavilion</th> 
                      <th>Image</th> 
                      <th>Edit</th> 
                      <th>Delete</th> 
                  </tr>                 
                  </thead>
                  <tbody>
                  @forelse($categories as $category)
                  <tr>
                      <td>{{$category->id}}</td>  
                      <td>{{$category->name}}</td> 
                      <td>{{$category->pavilion==1?'Yes':'No'}}</td>
                      <td><img src="{{asset($category->image)}}" style="max-height:40px;min-height: 40px;max-width: 40px;min-width: 40px"></td> 

                      <td><a href="#" ><span data-toggle="modal" data-target="#mymodal-{{$category->id}}"><i class="fa fa-pencil"></i></span></a></td>
                      <td><a href="{{route('country.delete',$category->id)}}" ><span style="color:#DD4F43"><i class="fa fa-trash"></i></span></a></td>
                            
          
                      <div id="mymodal-{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" >
                          <div class="modal-dialog" role="document">
                              <form method="post" action="{{route('country.update1',$category->id)}}" class="forms-sample" enctype="multipart/form-data"> 
                                {{csrf_field()}}
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update Country</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="Category">Country<span style='color:red'>*</span></label>
                                            <input type="text" class="form-control p-input" name="name" placeholder="Country" value="{{$category->name}}" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="Category">Pvilion Status</label>
                                            <select class="form-control" name="pavilion" required>
                                                <option value="0" {{$category->pavilion==0?'selected':''}}>NO</option>
                                                <option value="1" {{$category->pavilion==1?'selected':''}}>Yes</option>
                                            </select>
                                            @if ($errors->has('category_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category_id') }}</strong>
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
                                    <input type="submit" class="btn btn-primary" value="update Category">
                                    </div>
                                </div><!-- /.modal-content -->
                              </form>
                          </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
                  </tr> 
                  @empty
                  <tr>
                      <td></td>
                      <td></td>  
                      <td>No Categories</td>        
                      <td></td>
                      <td></td>
                  </tr>  
                  @endforelse                    
                  </tbody>
            </table>
                   
    			  <div id="mymodal" class="modal fade" tabindex="-1" role="dialog" >
    		        <div class="modal-dialog" role="document">
    	              <form method="post" action="{{route('country.store')}}" class="forms-sample" enctype="multipart/form-data"> 
    	                  {{csrf_field()}}
    		          	<div class="modal-content">
    			            <div class="modal-header">
    			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			              <h4 class="modal-title">Add Country</h4>
    			            </div>
    			            <div class="modal-body">
    			              <div class="form-group">
    			                  <label for="Category">Country<span style='color:red'>*</span></label>
    			                  <input type="text" class="form-control p-input" name="name" placeholder="Country" value="{{Request::old('name')}}" required> 
    			              </div>
                         <div class="form-group">
                            <label><h4>Upload Image</h4></label>
                             <input type="file" class='form-control' class="form-control-file" name='image' id="exampleInputFile2" aria-describedby="fileHelp">
                        </div>
    			            </div>
    			            <div class="modal-footer">
    			              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    			              <button type="submit" class="btn btn-primary">Create Country</button>
    			            </div>
    		        	</div><!-- /.modal-content -->
    		           </form>
    		        </div><!-- /.modal-dialog -->
    		    </div><!-- /.modal -->
				   </div>
				</div>
			</div>
        </div>
    </div>
</div>   
@endsection
@section('js')
<script src="{{asset('style/admin/multipleselection/selection.js')}}"></script>
@endsection
