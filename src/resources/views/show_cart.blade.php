@include('includes.header')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .cart-container {
        max-width: 800px;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .cart-header h1 {
        margin: 0;
        text-align: center;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .cart-table th,
    .cart-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .cart-table th {
        background-color: #f4f4f4;
    }

    .cart-table input[type="number"] {
        width: 60px;
        text-align: center;
    }

    .remove-btn {
        background-color: #e74c3c;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .remove-btn:hover {
        background-color: #c0392b;
    }

    .cart-footer {
        text-align: right;
        padding-top: 10px;
    }

    .cart-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .checkout-btn {
        background-color: #2ecc71;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .checkout-btn:hover {
        background-color: #27ae60;
    }
</style>
<div class="cart-container">
    <header class="cart-header">
        <h1>Shopping Cart</h1>
    </header>
    <main class="cart-main">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartProducts as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td><input type="number" value="1" min="1"></td>
                        <td>$10.00</td>
                        <td>
                            <form action={{route('delete_cart_item', ['id' => $product->id])}} method="post" class="m-auto">
                                {{csrf_field()}}
                                <button class="btn btn-danger rounded-circle mb-2">
                                    <i class="fa fa-trash-o fa-lg" aria-hidden="true" title="delete model">

                                    </i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    @include('includes.footer')

