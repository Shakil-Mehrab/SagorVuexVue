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
            <option value="{{$category->id}}">{{$category->name}}</option>
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














{{-- 
 <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }} col-md-6">
 	<div class="range-slider-one clearfix">
	<label for="category_id" class="control-label">Category Id</label>
	<select id="size" name="category_id" class="form-control" required>
   		<optgroup label="Select One"> 
			@forelse($categories as $category)
				@if(
					isset($product) && $product->category->id==$category->id || !isset($product) && $area->id==$category->id && old('category_id') || old('category_id')==$category->id
				)
   				    <option value="{{$category->id}}">{{$category->name}}</option>
 				@else
   					<option value="{{$category->id}}">{{$category->name}}</option>
   				@endif
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
</div> --}} 

