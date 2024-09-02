@include('includes.header')
<style>
    /* Customize styles here */
    .product-img {
        max-width: 100%;
        height: auto;
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">

            <img src="{{ $currentProduct->image ? asset('images/' . $currentProduct->image) : 'https://via.placeholder.com/400x300' }}"
                alt="Product Image" class="product-img">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @role('admin')
            <form action="{{ route('products_store', ["id" => $currentProduct->id]) }}" method="post"
                enctype="multipart/form-data" class="mt-2">
                @csrf
                <label for="fileInput" id="saveLabel">
                    LABEL:
                </label>
                <input name="imageUrl" id="fileInput" type="file" />
                <br>
                <button id="saveImageBtn" type="submit" class="btn btn-success" value="save image">
                    <i class=" fa-1x fa fa-save" style="cursor:pointer"></i> Save image

                </button>
            </form>
            @endrole
        </div>
        <div class="col-md-6">
            <h2>{{$currentProduct->name}}</h2>
            <a class="text-muted"
                href="{{route('category', ['id' => $currentProductCategory->id])}}">{{$currentProductCategory->name}}</a>

            <p>{{$currentProduct->description}}</p>
            <p><strong>{{$currentProduct->price}}$</strong></p>
            <div class="mb-3">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" class="form-control"
                    style="width: 100px;">
            </div>
            <button type="button" class="btn btn-primary">Add to Cart</button>
        </div>
    </div>
</div>
<!-- Bootstrap JS and dependencies (jQuery, Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@include('includes.footer')
