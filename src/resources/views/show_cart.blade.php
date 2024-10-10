@include('includes.header')

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
                                        value="{{$product->pivot->quantity}}" min="0" autocomplete="off"
                                        data-id={{$product->id}} data-previous-number="{{$product->pivot->quantity}}">
                                </form>
                            </td>
                            <td>
                                <form class="delete_form" action={{route('delete_cart_item', ['id' => $product->id])}}
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
                    let result = $(this).parent().parent().remove();

                    calculateSumOfProducts()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        type: "POST",
                        url: "{{ route('delete_cart_item', ["id" => $product->id]) }}",
                        // data: { actionTaken, focusValue },
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
                    let url = "{{ route('change_quantity', ["id" => '__ID__']) }}".replace('__ID__', id);
                    calculateSumOfProducts()

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

