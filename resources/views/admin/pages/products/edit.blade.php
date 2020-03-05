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
            <form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{ method_field("patch") }}
              <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                  <div class="title text-center"><h3>Basic Into</h3></div>
              </div>
              <div class="row">
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                      <label for="name" class="control-label"><h4>Proruct Name</h4></label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" value="{{$product->name}}" required>
                       @if ($errors->has('name'))
                      <span class="help-block">
                          <strong style="color:red">{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                  </div>
                  <div class="form-group{{ $errors->has('brand') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                    <label for="brand" class="control-label"><h4>Brand</h4></label>
                    <input type="text" name="brand" id="brand" class="form-control" placeholder="Brand" value="{{$product->brand}}" required>
                     @if ($errors->has('brand'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('brand') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                    <label for="price" class="control-label"><h4>Price</h4></label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Price (TK)" value="{{$product->price-$product->extra_price}}" required>
                     @if ($errors->has('price'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('price') }}</strong>
                    </span>
                    @endif
                </div>
              </div>
              <div class="row">
                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                <div class="range-slider-one clearfix">
                    <label><h4>Category</h4></label>
                 	<select class="form-control" name="category_id" required>
                 		<optgroup label="Select One"> 
                 		@forelse($categories as $category)
                        <option value="{{$category->id}}" {{$category->id==$product->category->id?'selected':''}}>{{$category->name}}</option>
                        @empty
            			 <option value="">No Category</option>
            		    @endforelse
                    	</optgroup>
                    </select>
                    @if ($errors->has('category_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                @endif
                </div>
            </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label><h4>Size</h4></label>
                <select class="form-control" name="size" required>
                     <optgroup label="Select One"> 
                        <option value="small">Small</option>
                        <option value="mdediam">Mdediam</option>
                        <option value="large">Large</option>
                        <option value="all">All</option>
                    </optgroup>
                </select>
                 @if ($errors->has('size'))
                    <span class="help-block">
                        <strong>{{ $errors->first('size') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                    <label for="discount" class="control-label"><h4>Discount (%)</h4></label>
                    <input type="text" name="discount" id="discount" class="form-control" placeholder="Discount (%)" value="{{$product->discount*100/($product->price-$product->extra_price)}}" required>
                     @if ($errors->has('discount'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('discount') }}</strong>
                    </span>
                    @endif
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                <div class="title text-center"><h3>Price Info</h3></div>
              </div>
              <div class="row">
                  <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                    <label for="qty" class="control-label"><h4>Quantity</h4></label>
                    <input type="text" name="qty" id="qty" class="form-control" placeholder="Quantity" value="{{$product->qty}}" required>
                     @if ($errors->has('qty'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('qty') }}</strong>
                    </span>
                    @endif
                 </div>
                <div class="form-group{{ $errors->has('min_order') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                    <label for="min_order" class="control-label"><h4>Minimum Order Quantity</h4></label>
                    <input type="text" name="min_order" id="min_order" class="form-control" placeholder="Minimum Order Quantity" value="{{$product->min_order}}" required>
                     @if ($errors->has('min_order'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('min_order') }}</strong>
                    </span>
                    @endif
                </div>
                 
                 <div class="form-group{{ $errors->has('max_order') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                    <label for="max_order" class="control-label"><h4>Maximum Order Quantity</h4></label>
                    <input type="text" name="max_order" id="max_order" class="form-control" placeholder="Maximum Order Quantity" value="{{$product->max_order}}" required>
                     @if ($errors->has('max_order'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('max_order') }}</strong>
                    </span>
                    @endif
                </div>
              </div>
              <div class="row">
                <div class="form-group{{ $errors->has('extra_price') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                    <label for="extra_price" class="control-label"><h4>Extra Price</h4></label>
                    <input type="text" name="extra_price" id="extra_price" class="form-control" placeholder="Extra Price (US-$)" value="{{$product->extra_price}}" required>
                     @if ($errors->has('extra_price'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('extra_price') }}</strong>
                    </span>
                    @endif
                </div>
                 <div class="form-group{{ $errors->has('vat') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                    <label for="vat" class="control-label"><h4>Vat</h4></label>
                    <input type="text" name="vat" id="vat" class="form-control" placeholder="Vat" value="{{$product->vat*100/$product->price}}" required>
                     @if ($errors->has('vat'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('vat') }}</strong>
                    </span>
                    @endif
                 </div>
                  <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }} col-lg-4 col-md-4 col-sm-12">
                    <label for="position" class="control-label"><h4>Position</h4></label>
                     <select class="form-control" name="position" required>
                         <optgroup label="Select One"> 
                            <option value="other">Other</option>
                            <option value="topcollection">Top Collection</option>
                            <option value="advertisement">Advertisement</option>
                        </optgroup>
                    </select>
                     @if ($errors->has('size'))
                        <span class="help-block">
                            <strong>{{ $errors->first('size') }}</strong>
                        </span>
                    @endif
                 </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12" style="background: black;color:white">
                  <div class="title text-center"><h3>Detail Information</h3></div>
              </div>
              <div class="row">
                  <div class="form-group col-lg-12">
                      <textarea name="detail" class="form-control my-editor" placeholder="Detailed Information" class="my-editor">{{$product->detail}}</textarea>
                       @if ($errors->has('detail'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('detail') }}</strong>
                        </span>
                    @endif
                  </div>
                   <div class="form-group col-lg-12 col-md-12 col-sm-12">
                      <button type="submit" class="btn btn-success"> Update Product</button>
                      <span class="pull-right" style="font-size:18px;border:1px solid blue;padding:2px"><a href="{{route('admin.image.edit',$product->id)}}">Edit Image</a></span>
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