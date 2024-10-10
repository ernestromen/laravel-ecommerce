@include('includes.header')

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
      <div class="row mt-3">
        <div class="" id="payment_options"></div>
      </div>
    </div>
  </main>

  @include('includes.footer')
</body>
<script
  src="https://www.paypal.com/sdk/js?client-id=AThdBqm8pGYp_N0g2QBEZQsK_Q4BTeKWZC6uwuy0LV7FoMQapcVMUQHsRDy7uD1xlKfKryZ8HBafFJyN&currency=GBP&intent=capture"></script>

<script>
  paypal.Buttons({
    createOrder: function () {
      return fetch("/create/" + document.getElementById("paypal-amount").value)
        .then((response) => response.text())
        .then((id) => {
          return id;
        });
    },

    onApprove: function () {
      return fetch("/complete", { method: "post", headers: { "X-CSRF-Token": '{{csrf_token()}}' } })
        .then((response) => response.json())
        .then((order_details) => {
          console.log(order_details);
          document.getElementById("paypal-success").style.display = 'block';
          //paypal_buttons.close();
        })
        .catch((error) => {
          console.log(error);
        });
    },

    onCancel: function (data) {
      //todo
    },

    onError: function (err) {
      //todo
      console.log(err);
    }
  }).render('#payment_options');
</script>