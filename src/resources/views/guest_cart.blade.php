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
    @if(Session::has('productInCart') && !empty(Session::get('productInCart')))

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
                @foreach(Session::get('productInCart') as $product)
                        <tr class="product_row">
                        <input class="product_id" type="hidden" value="{{$product['id']}}"/>

                        <td><a href={{route('product', ["id" => $product['id']])}}>{{$product['name']}}</a></td>
                        <td class="product_price">${{$product['price']}}</td>
                            <td>
                                <form action="" method="POST">
                                    {{csrf_field()}}

                                    <input name="quantity_input" class="quantity_input" type="number"
                                        value="{{$product['quantity']}}" min="0" autocomplete="off"
                                        data-id={{$product['id']}} data-previous-number={{$product['quantity']}}>
                                </form>
                            </td>
                            <td>
                                <form class="delete_form"
                                    method="post" class="m-auto">
                                    {{csrf_field()}}
                                    <button class="btn btn-danger rounded-circle mb-2">
                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true" title="delete model">

                                        </i></button>
                            </form>
                            </td>
                        </tr>
                        @endforeach

                    <td>total cost:</td>
                    <td class="total_cost">${{$totalPrice}}</td>
                    <td></td>
                    <td></td>
                </tbody>
            </table>
            <div class="text-center">
                <a href="{{route('register')}}" class="btn btn-secondary">checkout</a>
            </div>
        </main>
        @else

        <div class="mt-3 text-center">
            <span>shopping cart is currentlhy empty</span>
        </div>
        @endif
</div>
<script>
    $(document).ready(function () {
        @if(Session::has('productInCart') && !empty(Session::get('productInCart')) && count(Session::get('productInCart')) > 0)

                function calculateSumOfProducts() {
                    totalPrice = 0;
                    totalQuantity = 0;
                    $('tbody').each(function (index) {
                        $('.product_row').each(function (idx) {
                            var $currentRow = $(this);
                            var priceText = $currentRow.find('.product_price').text().replace('$', '');
                            var price = parseFloat(priceText);
                            var quantity = parseFloat($currentRow.find('.quantity_input').val());
                            totalQuantity += quantity;
                            totalPrice += price * quantity;

                        });
                    });
                    totalPrice = totalPrice[totalPrice.length - 1] == 0 ? totalPrice.replace(/.$/, "") : totalPrice;
                    $('#cart_count').text(totalQuantity);
                    $('.total_cost').text('$' + totalPrice);
                }

                $('.delete_form').on('submit', function () {
                    let idSessionRow = $(this).parent().parent().find('.product_id').val();
                    let result = $(this).parent().parent().remove();
                    let url = "{{ route('delete_session_cart_item', ["id" => '__ID__']) }}".replace('__ID__', idSessionRow);
                    calculateSumOfProducts()
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        type: "POST",
                        url: url,
                        // data: { idSessionRow },
                        success: function (data) {
                            console.log(data);
                        },
                    });
                })


                $(".quantity_input").on("focusout", function () {
                    console.log('focus');
                    console.log($(this).val());
                    actionTaken = $(this).val() > value ? 'inc' : 'dec';
                    focusValue = $(this).val();

                    let id = $(this).data('id');
                    let url = "{{ route('change_session_quantity', ["id" => '__ID__']) }}".replace('__ID__', id);

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        type: "POST",
                        url: url,
                        data: { actionTaken, focusValue },
                        success: function (data) {
                            console.log(data);
                        },
                    });

                });

                $('.quantity_input').on('change', function () {

                    let value = $(this).data('previous-number');
                    actionTaken = $(this).val() > value ? 'inc' : 'dec';
                    var currentQuantity = $(this).val()
                    let id = $(this).data('id');

                    if ($(this).val() == 0) {
                        $(this).parent().parent().parent().remove();
                        let url = "{{ route('delete_cart_item', ["id" => '__ID__']) }}".replace('__ID__', id);

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            },
                            type: "POST",
                            url: url,
                            success: function (data) {
                                console.log(data);
                            },
                        });
                    }
                    let url = "{{ route('change_session_quantity', ["id" => '__ID__']) }}".replace('__ID__', id);
                    calculateSumOfProducts()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        type: "POST",
                        url: url,
                        data: { id,actionTaken },
                        success: function (data) {
                            console.log(data);
                        },
                    });
                });

            });
        @endif
</script> 
@include('includes.footer')

