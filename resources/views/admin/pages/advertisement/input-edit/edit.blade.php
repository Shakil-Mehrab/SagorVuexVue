@extends('admin.pages.products.input-edit.index')  
@section('link')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endsection
@section('navigation')
 <section class="content-header">
    <h1>
      Data Tables
      <small>Advance Form</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Products Edit</li>
    </ol>
</section>
@endsection
@section('content')
<section class="content">
  <!-- Small boxes (Stat box) -->
  @include('admin.pages.products.input-edit.partials.box.box')
  <div class="panel panel-default">
    <div class="panel-heading text-center">
      <h3>Edit Your Product</h3>
    </div>
    <div class="panel-body">
        <div class="row">
              <div class="col-md-12">
              @include("admin.includes.message.message")
                  <form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{ method_field("patch") }}

                      <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                          <div class="title text-center"><h3>Basic Into</h3></div>
                      </div>
                      <div class="row">
                          <!-- Form Group -->
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-lg-6 col-md-6 col-sm-12">
                              <label for="name" class="control-label"><h4>Proruct Name</h4></label>
                              <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" value="{{$product->name}}">
                               @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong style="color:red">{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                          </div>
                           <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }} col-lg-6 col-md-6 col-sm-12">
                              <label for="price" class="control-label"><h4>Price</h4></label>
                              <input type="text" name="price" id="price" class="form-control" placeholder="Price (US-$" value="{{$product->price}}">
                               @if ($errors->has('price'))
                              <span class="help-block">
                                  <strong style="color:red">{{ $errors->first('price') }}</strong>
                              </span>
                              @endif
                           </div>
                      </div>
                      <div class="row">
                        @include('admin.pages.products.input-edit.partials.form.edit-select')
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                         <div class="title text-center"><h3>Property Gallery</h3></div>
                      </div>
                      <div class="row">
                          <!-- Form Group -->
                          <div class="form-group col-lg-12 col-md-12 col-sm-12">
                              <label><h4>Upload Image</h4></label>
                               <input type="file" class='form-control' class="form-control-file" name='image' id="exampleInputFile2" aria-describedby="fileHelp">
                          </div>
                      </div>

                      <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                          <div class="title text-center"><h3>Detail Information</h3></div>
                      </div>
                      <div class="row">
                          <!-- Form Group -->
                          <div class="form-group col-lg-12">
                              <textarea name="detail" class="form-control my-editor" placeholder="Detailed Information" class="my-editor">{{$product->detail}}</textarea>
                               @if ($errors->has('detail'))
                                <span class="help-block">
                                    <strong style="color:red">{{ $errors->first('detail') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group col-lg-3 col-md-6 col-sm-12">
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
@endsection