@extends('admin.admin')
@section('link')
  <link rel="stylesheet" href="{{asset('bazarbaariadmin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('navigation')
<section class="content-header">
      <h1><a href="/admin">Admmin Dashboard</a></h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i><span style="font-size:15px">Admin Dashboard</span></a></li>
        <li class="active"><span style="color:orange;font-size:15px">Area</span></li>
      </ol>
</section>
@endsection
@section('content')
@php
use  App\Model\District; 
$districts=District::orderBy('name','asc')->get();
@endphp
  <section class="content">
  	@include('admin.includes.box')
      <div class="row">
        <div class="col-xs-12">
          <div class="box"><br>
            @include("admin.includes.message.message")
             <div class="col-md-8 col-md-offset-2">
	            <div class="content-wrap well text-center">
	                <a href="#"><button class="btn btn-success" data-toggle="modal" data-target="#mymodal"> Add Area</button></a>
	            </div>
	        </div>
             <div class=" col-md-12 box-header text-center">
              <h3 class="box-title">Area Table</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>id</th>
                          <th>Country</th>
                          <th>City</th>
                          <th>District</th>
                          <th>Area</th> 
                          <th>Charge</th> 
                          <th>Edit</th> 
                          <th>Delete</th> 
                        </tr>
                      </thead>

                      <tbody>
                        @forelse($categories as $property)
                        <tr>
                            <td>{{$property->id}}</td>
                            <td>{{$property->district->city->country->name}}</td>
                            <td>{{$property->district->city->name}}</td>
                            <td>{{$property->district->name}}</td>
                            <td>{{$property->name}}</td>
                            <td>{{$property->charge}}</td>
                            <td><a href="#" ><span data-toggle="modal" data-target="#mymodal-{{$property->id}}"><i class="fa fa-pencil"></i></span></a></td>

                        <div id="mymodal-{{$property->id}}" class="modal fade" tabindex="-1" role="dialog" >
                          <div class="modal-dialog" role="document">
                              <form method="post" action="{{route('area.update',$property->id)}}" class="forms-sample" enctype="multipart/form-data"> 
                                {{csrf_field()}}
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update Area</h4>
                                    </div>
                                     <div class="modal-body">
                                <div class="form-group">
        	                      <label><h4>District</h4></label>
        	                      <select class="form-control" name="district_id" required>
        	                        <optgroup label="Select One"> 
        	                        @forelse($districts as $city)
        	                            <option value="{{$city->id}}" {{$city->id==$property->district_id?'selected':''}}>{{$city->name}} ({{$city->city->country->name.','.$city->city->name}})</option>
        	                            @empty
        	                       <option value="">No Country</option>
        	                        @endforelse
        	                          </optgroup>
        	                        </select>
        	                        @if ($errors->has('district_id'))
        	                        <span class="help-block">
        	                            <strong>{{ $errors->first('district_id') }}</strong>
        	                        </span>
        	                        @endif
        	                    </div>
                                <div class="form-group">
                                    <label for="Category">Area<span style='color:red'>*</span></label>
                                    <input type="text" class="form-control p-input" name="name" placeholder="Delivary Area" value="{{$property->name}}" required> 
                                    @if ($errors->has('name'))
        	                        <span class="help-block">
        	                            <strong><spann style="color:red">{{ $errors->first('name') }}</span></strong>
        	                        </span>
        	                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="Category">Charge<span style='color:red'>*</span></label>
                                    <input type="text" class="form-control p-input" name="charge" placeholder="Charge" value="{{$property->charge}}" required> 
                                    @if ($errors->has('charge'))
        	                        <span class="help-block">
        	                            <strong><spann style="color:red">{{ $errors->first('charge') }}</span></strong>
        	                        </span>
        	                        @endif
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



                            <td><a href="{{route('area.delete',$property->id)}}"><button type="submit"><span style="color:#DD4F43"><i class="fa fa-trash"></i></span></button></a></td>

                         </tr>
                        @empty
                        <tr>
                            <td>No Area</td>
                        </tr>
                        @endforelse
                      </tbody>
              </table>
				<div id="mymodal" class="modal fade" tabindex="-1" role="dialog" >
    		        <div class="modal-dialog" role="document">
    	              <form method="post" action="{{route('area.store')}}" class="forms-sample" enctype="multipart/form-data"> 
    	                  {{csrf_field()}}
    		          	<div class="modal-content">
    			            <div class="modal-header">
    			              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			              <h4 class="modal-title">Add Area</h4>
    			            </div>
    			            <div class="modal-body">
                                <div class="form-group">
        	                      <label><h4>District</h4></label>
        	                      <select class="form-control" name="district_id" required>
        	                        <optgroup label="Select One"> 
        	                        @forelse($districts as $city)
        	                            <option value="{{$city->id}}">{{$city->name}} ({{$city->city->country->name.','.$city->city->name}})</option>
        	                            @empty
        	                       <option value="">No Country</option>
        	                        @endforelse
        	                          </optgroup>
        	                        </select>
        	                        @if ($errors->has('district_id'))
        	                        <span class="help-block">
        	                            <strong>{{ $errors->first('district_id') }}</strong>
        	                        </span>
        	                        @endif
        	                    </div>
                                <div class="form-group">
                                    <label for="Category">Area<span style='color:red'>*</span></label>
                                    <input type="text" class="form-control p-input" name="name" placeholder="Delivary Area" value="{{Request::old('name')}}" required> 
                                    @if ($errors->has('name'))
        	                        <span class="help-block">
        	                            <strong><spann style="color:red">{{ $errors->first('name') }}</span></strong>
        	                        </span>
        	                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="Category">Charge<span style='color:red'>*</span></label>
                                    <input type="text" class="form-control p-input" name="charge" placeholder="Charge" value="{{Request::old('charge')}}" required> 
                                    @if ($errors->has('charge'))
        	                        <span class="help-block">
        	                            <strong><spann style="color:red">{{ $errors->first('charge') }}</span></strong>
        	                        </span>
        	                        @endif
                                </div>
                             </div>
    			            <div class="modal-footer">
    			              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    			              <button type="submit" class="btn btn-primary">Create Area</button>
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

