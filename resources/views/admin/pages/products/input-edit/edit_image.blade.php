@php
use App\Model\Membership;
$membership=Membership::where('user_id',$product->user_id)->where('status','approved')->first();
@endphp
@extends('admin.admin')  
@section('link')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endsection
@section('navigation')
 <section class="content-header">
  <h1><a href="/admin">Admmin Dashboard</a></h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i><span style="font-size:15px">Admin Dashboard</span></a></li>
     <li class="active"><a href="{{route('product.index')}}"><span style="font-size:15px">Product</span></a></li>
    <li class="active"><span style="color:orange;font-size:15px">Edit</span></li>
  </ol>
</section><br>
@endsection
@if($membership)
@section('content')
<section class="content">
  @include('admin.includes.box')
  <div class="panel panel-default">
    <div class="panel-heading text-center">
      <h3>Edit Your Product</h3>
    </div>
    <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
          @include("admin.includes.message.message")
            <form method="post" action="{{route('admin.image.update',$product->id)}}" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                  <div class="title text-center"><h3>Property Gallery</h3></div>
                </div>
                <div class="row">
                  <div class="form-group{{ $errors->has('image1') ? ' has-error' : '' }} col-lg-6 col-md-6 col-sm-12">
                      <label><h4>Front Image Upload</h4></label>
                       <input type="file" class='form-control' class="form-control-file" name='image1' id="exampleInputFile2" aria-describedby="fileHelp">
                       @if ($errors->has('image1'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('image1') }}</strong>
                        </span>
                       @endif
                  </div>
                  <div class="form-group{{ $errors->has('image2') ? ' has-error' : '' }} col-lg-6 col-md-6 col-sm-12">
                      <label><h4>Back Image Upload</h4></label>
                       <input type="file" class='form-control' class="form-control-file" name='image2' id="exampleInputFile2" aria-describedby="fileHelp">
                        @if ($errors->has('image2'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('image2') }}</strong>
                        </span>
                       @endif
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label><h4>Extra Image Upload (Optional)</h4></label>
                       <input type="file" class='form-control' class="form-control-file" name='images[]' id="exampleInputFile2" aria-describedby="fileHelp"  multiple>
                  </div>
                   <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label><h4>Video Upload (Optional)</h4></label>
                       <input type="file" class='form-control' class="form-control-file" name='video' id="exampleInputFile2" aria-describedby="fileHelp">
                  </div>
              </div>


              <div class="row">
                  <div class="form-group col-lg-12 col-md-12 col-sm-12">
                      <button type="submit" class="btn btn-success"> Update Product</button>
                  </div>
              </div>
            </form>
          </div>
        </div>
    </div>
   </div>     
</section>   
@endsection
@endif

@section('js')
<script>
  var editor_config = {
    path_absolute : "{{URL::to('/')}}/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }
      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };
  tinymce.init(editor_config);
</script>
{{-- <script src="{{asset('style/admin/tinymce/js/changeable.js')}}"></script> --}}
@endsection