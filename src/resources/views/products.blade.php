@include('includes.header')

<div class="cotnainer">
    <h2 class="text-center my-5">Products</h2>
    <div class="row">
        <div class="col-2">

        </div>
        <div class="col-8">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role_id</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col"></th>
                        <th scope="col"></th>

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
