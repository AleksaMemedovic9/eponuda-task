<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<div class="container-fluid">
    <div class="row flex-nowrap">
        @if(Route::current()->getName() == 'prijemnici')
            @include('sidebar')
        @endif
        <div class="col py-3">
            <div class="container-xxl">
                @foreach($products as $product) 
                    <div class="card" style="display:inline-block;width: 18rem; margin-bottom: 10px; height: 30rem;">
                        <img src="{{$product->image_link}}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{$product->price}}</p>
                        <a href="#" disabled class="btn btn-primary">{{$product->category}}</a>
                        </div>
                    </div>
                    &nbsp;
                @endforeach
            </div>
            <!-- Pagination Links -->
            {{ $products->links() }}
            
        </div>
    </div>
</div>


