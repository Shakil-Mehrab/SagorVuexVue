@if(!empty($notification->data['product']['id'] && $notification->type=="App\Notifications\RepliedToProduct" ))
 	<a class="dropdown-item" href="{{route('single-product.show',$notification->data['product']['id'])}}"><strong>New Comment</strong>  on <strong> {{$notification->data['product']['name']}}</strong> {{$notification->created_at->diffForHumans()}}</a>
{{--      @if($notification->created_at->diffForHumans()<="24 hours ago")
	    <a class="dropdown-item" href="{{route('single-product.show',$notification->data['product']['id'])}}">{{$notification->data['user']['name']}} commented on <strong> {{$notification->data['product']['name']}}</strong> {{$notification->created_at->diffForHumans()}}</a>

	    @elseif($notification->created_at->diffForHumans()=="1 day ago")
	    <a class="dropdown-item" href="{{route('single-product.show',$notification->data['product']['id'])}}">{{$notification->data['user']['name']}} commented on <strong> {{$notification->data['product']['name']}}</strong> {{$notification->created_at->diffForHumans()}}</a> 
	
	@elseif($notification->created_at->diffForHumans()=="2 days ago")
	    <a class="dropdown-item" href="{{route('single-product.show',$notification->data['product']['id'])}}">{{$notification->data['user']['name']}} commented on <strong> {{$notification->data['product']['name']}}</strong> {{$notification->created_at->diffForHumans()}}</a> 
	
	@else
	    <a class="dropdown-item" href="{{route('single-product.show',$notification->data['product']['id'])}}">{{$notification->data['user']['name']}} commented on <strong> {{$notification->data['product']['name']}}</strong> {{$notification->created_at->diffForHumans()}}</a> 
	@endif --}}
@endif  
@if(!empty($notification->data['product']['id'] && $notification->type=="App\Notifications\CreatedProductNotification" ))
 	<a class="dropdown-item" href="{{route('single-product.show',$notification->data['product']['id'])}}"><strong>New Product</strong> has been created <strong> {{$notification->data['product']['name']}}</strong> {{$notification->created_at->diffForHumans()}}</a>
{{--      @if($notification->created_at->diffForHumans()<="24 hours ago")
	    <a class="dropdown-item" href="{{route('single-product.show',$notification->data['product']['id'])}}">{{$notification->data['user']['name']}} commented on <strong> {{$notification->data['product']['name']}}</strong> {{$notification->created_at->diffForHumans()}}</a>

	    @elseif($notification->created_at->diffForHumans()=="1 day ago")
	    <a class="dropdown-item" href="{{route('single-product.show',$notification->data['product']['id'])}}">{{$notification->data['user']['name']}} commented on <strong> {{$notification->data['product']['name']}}</strong> {{$notification->created_at->diffForHumans()}}</a> 
	
	@elseif($notification->created_at->diffForHumans()=="2 days ago")
	    <a class="dropdown-item" href="{{route('single-product.show',$notification->data['product']['id'])}}">{{$notification->data['user']['name']}} commented on <strong> {{$notification->data['product']['name']}}</strong> {{$notification->created_at->diffForHumans()}}</a> 
	
	@else
	    <a class="dropdown-item" href="{{route('single-product.show',$notification->data['product']['id'])}}">{{$notification->data['user']['name']}} commented on <strong> {{$notification->data['product']['name']}}</strong> {{$notification->created_at->diffForHumans()}}</a> 
	@endif --}}
@endif  