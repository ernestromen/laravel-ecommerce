<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="https://assets.edlin.app/favicon/favicon.ico">

  <link rel="stylesheet" href="https://assets.edlin.app/bootstrap/v5.3/bootstrap.css">

  <script src="https://www.paypal.com/sdk/js?client-id=AThdBqm8pGYp_N0g2QBEZQsK_Q4BTeKWZC6uwuy0LV7FoMQapcVMUQHsRDy7uD1xlKfKryZ8HBafFJyN&currency=GBP&intent=capture"></script>

  <!-- Title -->
  <title>PayPal Laravel</title>
</head>
<body>

      <div class="row mt-3">
        <div class="col-12 col-lg-6 offset-lg-3" id="payment_options"></div>
      </div>
   
</body>
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
      return fetch("/complete", {method: "post", headers: {"X-CSRF-Token": '{{csrf_token()}}'}})
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
</html>
