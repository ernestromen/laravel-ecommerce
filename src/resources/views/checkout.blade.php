@include('includes.header')

<style>
    main {
        padding: 20px;
        display: flex;
        justify-content: center;
    }

    .checkout-container {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .summary-container {
        max-width: 300px; /* Adjust width as needed */
        background: #f9f9f9;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        margin-left: 20px; /* Space between form and summary */
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }

    .summary-title {
        margin-bottom: 15px;
        font-size: 18px;
        font-weight: bold;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
    }
</style>

<body>

    <main>
        <section class="checkout-container">
            <form action="/process-checkout" method="post">
                <h2>Billing Information</h2>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div class="form-group">
                    <label for="zip">ZIP Code:</label>
                    <input type="text" id="zip" name="zip" required>
                </div>
                <h2>Payment Information</h2>
                <div class="form-group">
                    <label for="card-number">Card Number:</label>
                    <input type="text" id="card-number" name="card_number" required>
                </div>
                <div class="form-group">
                    <label for="expiry">Expiry Date:</label>
                    <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" required>
                </div>
                <button type="submit">Complete Purchase</button>
            </form>
        </section>

        <div class="summary-container">
            <div class="summary-title">Order Summary</div>
            <div class="summary-item">
                <span>Subtotal:</span>
                <span>${{ $totalPriceOfProducts }}</span>
            </div>
            <div class="summary-item">
                <span>Shipping:</span>
                <span>$5.00</span> <!-- Change this value as needed -->
            </div>
            <div class="summary-item" style="font-weight: bold;">
                <span>Total:</span>
                <span>${{ $totalPriceOfProducts + 5.00 }}</span> <!-- Adjust for shipping -->
            </div>
        </div>
    </main>

    @include('includes.footer')
</body>
