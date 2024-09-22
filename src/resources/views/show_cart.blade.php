@include('includes.header')
<style>
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
    <div class="cart-header">
        <h1>Shopping Cart</h1>
    </div>

    @if($cartProducts->count() > 0)
        <main class="cart-main">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartProducts as $product)
                        <tr class="product_row">
                            <td><a href={{route('product', ["id" => $product->id])}}>{{$product->name}}</a></td>
                            <td class="product_price">${{$product->price}}</td>
                            <td>
                                <form action="{{route('change_quantity', ["id" => $product->id])}}" method="POST">
                                    {{csrf_field()}}

                                    <input name="quantity_input" class="quantity_input" type="number"
                                        value="{{$product->pivot->quantity}}" min="1" autocomplete="off"
                                        data-id={{$product->id}} data-previous-number="{{$product->pivot->quantity}}">
                                </form>
                            </td>
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
                    <td>total cost:</td>
                    <td class="total_cost">${{$totalPriceOfProducts}}</td>
                    <td></td>
                    <td></td>
                </tbody>

            </table>
            <div class="text-center">
                <a href="{{route('checkout', ["id" => Auth::id()])}}" class="btn btn-secondary">checkout</a>
            </div>
        </main>
    @else
        <div class="mt-3 text-center">
            <span>shopping cart is currentlhy empty</span>
        </div>
    @endif
</div>
<div id="result"></div>
<script>
    $(document).ready(function () {
        @if($cartProducts->count() > 0)

                $(".quantity_input").on("focusout", function () {
                    console.log('focus');
                    console.log($(this).val());
                    actionTaken = $(this).val() > value ? 'inc' : 'dec';
                    focusValue = $(this).val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        type: "POST",
                        url: "{{ route('change_quantity', ["id" => $product->id]) }}",
                        data: { actionTaken, focusValue },
                        success: function (data) {
                            console.log(data);
                        },
                    });

                });



                $('.quantity_input').on('change', function () {

                    let value = $(this).data('previous-number');
                    actionTaken = $(this).val() > value ? 'inc' : 'dec';

                    let id = $(this).data('id');

                    let url = "{{ route('change_quantity', ["id" => '__ID__']) }}".replace('__ID__', id);
                    totalPrice = 0;

                    $('tbody').each(function (index) {
                        $('.product_row').each(function (idx) {
                            var $currentRow = $(this);
                            var priceText = $currentRow.find('.product_price').text().replace('$', '');
                            var price = parseFloat(priceText);
                            var quantity = parseFloat($currentRow.find('.quantity_input').val())
                            totalPrice += price * quantity;

                        });
                    });
                    $('.total_cost').text('$' + totalPrice);


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        type: "POST",
                        url: url,
                        data: { actionTaken },
                        success: function (data) {
                            console.log(data);
                        },
                    });
                });

            });
        @endif
</script>
@include('includes.footer')

