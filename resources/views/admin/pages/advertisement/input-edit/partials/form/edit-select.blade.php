@php 
use App\Model\Category;
$categories=Category::all();
@endphp
<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }} col-lg-6 col-md-6 col-sm-12">
    <div class="range-slider-one clearfix">
        <label><h4>Category</h4></label>
        <select class="form-control" name="category_id">
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
<div class="form-group col-lg-6 col-md-6 col-sm-12">
    <label><h4>Size</h4></label>
    <select class="form-control" name="size">
        <optgroup label="Select One"> 
            <option value="small" {{$product->size=='small'?'selected':''}}>Small</option>
            <option value="mdediam" {{$product->size=='mdediam'?'selected':''}}>Mdediam</option>
            <option value="large" {{$product->size=='large'?'selected':''}}>Large</option>
            <option value="all" {{$product->size=='all'?'selected':''}}>All</option>
        </optgroup>
    </select>
     @if ($errors->has('size'))
        <span class="help-block">
            <strong>{{ $errors->first('size') }}</strong>
        </span>
    @endif
</div>

