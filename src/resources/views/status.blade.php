<!DOCTYPE html>
<html>
<head>
    <title>Payment Status</title>
</head>
<body>
    <h1>Payment Status</h1>
    @if(session('error'))
        <p>{{ session('error') }}</p>
    @else
        <p>Payment was successful!</p>
        <p>Payment ID: {{ request()->get('paymentId') }}</p>
        <p>Payer ID: {{ request()->get('PayerID') }}</p>
    @endif
</body>
</html>
