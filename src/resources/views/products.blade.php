@include('includes.header')

<div class="container ">
    <h2 class="text-center my-5">Products</h2>
    <div class="row">
        <div class="col-2">

        </div>
        <div class="col-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-6">
                    @role('admin')
                    <a class="btn btn-secondary" href={{route('create_product')}}>Add Product</a>
                    @endrole
                </div>
                <div class="col-6"> @csvButton($products)
                </div>
            </div>
            <table class="table border">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        @role('admin')
                        <th></th>
                        <th></th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="text-center">
                            <th scope="row">{{$product->id}}</th>
                            <td><a href="{{route('product', ['id' => $product->id])}}">{{$product->name}}</a></td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->sku}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>{{$product->updated_at}}</td>
                            @role('admin')
                            <td> <a href="{{route('edit_product', ["id" => $product->id])}}"
                                    class="btn btn-success rounded-circle"><i class="fa fa-pencil-square-o"
                                        aria-hidden="true" title="delete category">

                                    </i></a>
                            </td>
                            <td>
                                <form action={{route('delete_product', ['id' => $product])}} method="post" class="m-auto">
                                    {{csrf_field()}}
                                    <button class="btn btn-danger rounded-circle mb-2">
                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true" title="delete model">

                                        </i></button>
                                </form>
                            </td> @endrole
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-2">

        </div>
    </div>
</div>
@include('includes.footer')
