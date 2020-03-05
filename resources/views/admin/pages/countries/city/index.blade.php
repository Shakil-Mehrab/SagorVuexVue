@extends('admin.admin')
@section('navigation')
<section class="content-header">
  <h1><a href="/admin">Admmin Dashboard</a></h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i><span style="font-size:15px">Admin Dashboard</span></a></li>
    <li class="active"><span style="color:orange;font-size:15px">City</span></li>
  </ol>
</section><br>
@endsection
@section('content')
@php
use  App\Model\Country; 
$countries=Country::orderBy('name','asc')->get();
@endphp
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
			                <a href="#"><button class="btn btn-success" data-toggle="modal" data-target="#mymodal"> Add City</button></a>
			            </div>
			        </div>
					<div class="col-md-8 col-md-offset-2"> 
					@include('admin.includes.message.message')    
		
            <table class="table table-hover table-striped table-bordered">
                  <thead>
                  <tr>
                      <th>id</th>
                      <th>Country</th>
                      <th>City</th> 
                      <th>Edit</th> 
                      <th>Delete</th> 
                  </tr>                 
                  </thead>
                  <tbody>
                  @forelse($categories as $category)
                  <tr>
                      <td>{{$category->id}}</td> 
                      <td>{{$category->country->name}}</td> 
                      <td>{{$category->name}}</td>



                      <td><a href="#" ><span data-toggle="modal" data-target="#mymodal-{{$category->id}}"><i class="fa fa-pencil"></i></span></a></td>
                      <td><a href="{{route('city.delete',$category->id)}}" ><span style="color:#DD4F43"><i class="fa fa-trash"></i></span></a></td>
                            
          
                      <div id="mymodal-{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" >
                          <div class="modal-dialog" role="document">
                              <form method="post" action="{{route('city.update',$category->id)}}" class="forms-sample" enctype="multipart/form-data"> 
                                {{csrf_field()}}
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update City</h4>
                                    </div>
                                    <div class="modal-body">

                                    	<div class="form-group">
										    <label><h4>Country</h4></label>
										     	<select class="form-control" name="country_id" required>
										     		<optgroup label="Select One"> 
										     		@forelse($countries as $country)
										           <option value="{{$country->id}}" {{$country->id==$category->country_id?'selected':''}}>{{$country->name}}</option>
										            @empty
													 <option value="">No Country</option>
												    @endforelse
										        	</optgroup>
										        </select>
										        @if ($errors->has('country_id'))
										        <span class="help-block">
										            <strong>{{ $errors->first('country_id') }}</strong>
										        </span>
										    @endif
										</div>
                                        <div class="form-group">
                                            <label for="Category">City<span style='color:red'>*</span></label>
                                            <input type="text" class="form-control p-input" name="name" placeholder="Country" value="{{$category->name}}" required> 
                                        </div>
                                      
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Update City">
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
    	              <form method="post" action="{{route('city.store')}}" class="forms-sample" enctype="multipart/form-data"> 
    	                  {{csrf_field()}}
    		          	<div class="modal-content">
    			            <div class="modal-header">
    			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			              <h4 class="modal-title">Add City</h4>
    			            </div>
    			            <div class="modal-body">
    			            	<div class="form-group">
								    <label><h4>Country</h4></label>
								     	<select class="form-control" name="country_id" required>
								     		<optgroup label="Select One"> 
								     		@forelse($countries as $country)
								            <option value="{{$country->id}}">{{$country->name}}</option>
								            @empty
											 <option value="">No Country</option>
										    @endforelse
								        	</optgroup>
								        </select>
								        @if ($errors->has('country_id'))
								        <span class="help-block">
								            <strong>{{ $errors->first('country_id') }}</strong>
								        </span>
								    @endif
								</div>
    			              <div class="form-group">
    			                  <label for="Category">City<span style='color:red'>*</span></label>
    			                  <input type="text" class="form-control p-input" name="name" placeholder="Country" value="{{Request::old('name')}}" required> 
    			              </div>
                        
    			            </div>
    			            <div class="modal-footer">
    			              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    			              <button type="submit" class="btn btn-primary">Create City</button>
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
