@include('includes.header')
<style>
    .container {
        max-width: 960px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .product-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .product-item {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .product-item:hover {
        transform: translateY(-5px);
    }

    .product-item h2 {
        margin-top: 0;
        font-size: 1.5rem;
    }

    .product-item p {
        margin-bottom: 0;
        color: #666;
    }
</style>

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
