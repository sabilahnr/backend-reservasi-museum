<!DOCTYPE html>
<html>
<head>
    <title>Email Confirmation</title>
</head>
<body>
    <h1>Hello, {{ $userData['name'] }}</h1>
    <p>Thank you for your payment. Your order has been confirmed.</p>
    <p>Order details:</p>
    <ul>
        <li>Order ID: {{ $userData['order_id'] }}</li>
        <li>Product: {{ $userData['product_name'] }}</li>
        <li>Price: {{ $userData['price'] }}</li>
    </ul>
    <p>Thank you for shopping with us!</p>
</body>
</html>