@include('includes.header')
<div class="container">
    <nav class="navbar justify-content-center">
        <ul class="nav-menu d-flex ">
            @foreach($categories as $category)
                <li class="nav-item @if($category->name == $currentCategory->name) font-weight-bold @endif "><a
                        href="{{route('category', ['id' => $category->id])}}" class="nav-link">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </nav>
    <h1>Category: {{$currentCategory->name}}</h1>
    <ul class="product-list">
        @foreach ($currentCategory->products()->get() as $product)
            <li class="product-item">
                <h2><a href="{{route('product', ['id' => $product->id])}}">{{$product->name}}</a></h2>
                <p>{{$product->description}}</p>
                <p><strong>{{$product->price}}</strong></p>
                <button class="btn btn-primary" type="button">Add to Cart</button>
            </li>
        @endforeach
    </ul>
</div>
@include('includes.footer')
