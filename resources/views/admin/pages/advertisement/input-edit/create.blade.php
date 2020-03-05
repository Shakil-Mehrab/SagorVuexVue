@extends('layouts.pages.products.input-edit.index')  

@section('navigation')
 <section class="content-header">
    <h1>
      Data Tables
      <small>Advance Form</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Products Create</li>
    </ol>
</section>
@endsection
@section('content')
<section class="content">
  <!-- Small boxes (Stat box) -->
  @include('layouts.pages.products.input-edit.partials.box.box')
  <div class="panel panel-default">
    <div class="panel-heading text-center">
      <h3>Upload a video</h3>
    </div>
    <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
           @include("admin.includes.message.message")
            <form method="post" action="{{route('video.store')}}" enctype="multipart/form-data">
              {{csrf_field()}}
                 <div class="form-group col-lg-4 col-md-4 col-sm-12">
                      <label><h4>Front Image Upload</h4></label>
                       <input type="file" class='form-control' class="form-control-file" name='file_name' id="exampleInputFile2" aria-describedby="fileHelp">
                  </div><br><br>
                  <div class="form-group col-lg-3 col-md-6 col-sm-12">
                      <button type="submit" class="btn btn-success"> Submit Product</button>
                  </div>
            </form>
          </div>
           <hr>
           
           <div class="col-md-12">
           <hr>

              @forelse($categories as $cat)
                <video width='200' height='100' controls><source src='{{asset($cat->video)}}' type='video/webm'></video>
                  @empty
              @endforelse
           </div>
        </div>
    </div>
</section>
@endsection
