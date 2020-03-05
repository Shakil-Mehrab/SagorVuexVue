@extends('admin.admin')
@section('navigation')
 <section class="content-header">
  <h1>
    Data Tables
    <small>advanced tables</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tables</a></li>
    <li class="active">Categories tables</li>
  </ol>
</section>
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
			                <a href="#"><button class="btn btn-success" data-toggle="modal" data-target="#mymodal"> Add Category</button></a>
			            </div>
			        </div>
					<div class="col-md-8 col-md-offset-2"> 
					@include('admin.includes.message.message')    
					  <form method="post" action="{{route('category.delete')}}" enctype="multipart/form-data">
 						@csrf   
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>Categories</th> 
                            <th>Edit</th> 
                            <th>Delete</th> 
                        </tr>                 
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>  
                            <td><input type="checkbox" name="checkboxes[]" value="{{$category->id}}" class="checkboxes"></td>  
                            <td>{{$category->name}}</td> 
                            <td><a href="#" ><span data-toggle="modal" data-target="#mymodal-{{$category->id}}"><i class="fa fa-pencil"></i></span></a></td>
                            <td><button type="submit"><span style="color:#DD4F43"><i class="fa fa-trash"></i></span></button></td>
                                  
                
                            <div id="mymodal-{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" >
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{route('category.update',$category->id)}}" class="forms-sample" enctype="multipart/form-data"> 
                                        {{csrf_field()}}
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update Caegories</h4>
                                    </div>
                                    <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Category">Caetgory<span style='color:red'>*</span></label>
                                        <input type="text" class="form-control p-input" name="name" placeholder="Caetgory" value="{{$category->name}}"> 
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Category</button>
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
            </form>            
			<div id="mymodal" class="modal fade" tabindex="-1" role="dialog" >
		        <div class="modal-dialog" role="document">
	              <form method="post" action="{{route('color.store')}}" class="forms-sample" enctype="multipart/form-data"> 
	                  {{csrf_field()}}
		          	<div class="modal-content">
			            <div class="modal-header">
			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			              <h4 class="modal-title">Add Caegories</h4>
			            </div>
			            <div class="modal-body">
			              <div class="form-group">
			                  <label for="Category">Caetgory<span style='color:red'>*</span></label>
			                  <input type="text" class="form-control p-input" name="name" placeholder="Caetgory" value="{{Request::old('name')}}"> 
			              </div>
			            </div>
			            <div class="modal-footer">
			              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			              <button type="submit" class="btn btn-primary">Create Category</button>
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
