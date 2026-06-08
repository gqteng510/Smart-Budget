<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - SmartBudget Ezzati Catering</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #e6fdf5; display: flex; justify-content: center; padding: 20px; }
        /* Ditambah box-sizing: border-box supaya kad tidak pecah pada paparan skrin kecil */
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); width: 100%; max-width: 500px; margin-bottom: 20px; box-sizing: border-box; }
        .status-badge { background-color: #fef3c7; color: #d97706; padding: 8px 15px; border-radius: 20px; font-weight: bold; font-size: 15px; display: inline-block; margin-bottom: 15px; border: 1px solid #fde68a;}
        .btn-green { background-color: #00a859; color: white; border: none; padding: 12px; width: 100%; border-radius: 8px; font-weight: bold; font-size: 16px; cursor: pointer; text-decoration: none; display: block; text-align: center; margin-top: 20px; box-sizing: border-box;}
        .btn-green:hover { background-color: #008f4c; }
        .info-box { background-color: #f0fdf4; border-left: 4px solid #00a859; padding: 15px; border-radius: 4px; color: #166534; font-size: 14px; margin-top: 20px; line-height: 1.5; }
        .list-item { display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding: 10px 0; }
    </style>
</head>
<body>

    <div class="card">
        <h2 style="margin-top:0; text-align:center;">Your Order Details</h2>

        <div style="text-align:center;">
            <div class="status-badge">Status: {{ $order->status }}</div>
        </div>

        <p><strong>Reference No:</strong> #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
        <p><strong>Phone Number:</strong> {{ $order->phone_number }}</p>
        <p><strong>Delivery Address:</strong> <br> {{ $order->delivery_address }}</p>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0;">

        <h4 style="margin-bottom: 10px; margin-top:0;">Order List</h4>

        <div class="list-item">
            <span>Catering Package ({{ $order->number_of_guests }} Guests)</span>
        </div>

        <div class="list-item" style="font-weight: bold; font-size: 18px; border: none; margin-top: 10px;">
            <span>Total Amount:</span>
            <span style="color: #00a859;">RM {{ number_format($order->total_amount, 2) }}</span>
        </div>

        <div class="info-box">
            <strong>Notice:</strong> Your order status is currently <b>Pending</b>. If the admin accepts this order, the status will change to <b>Accepted</b> and our admin will immediately contact you via the phone number above for confirmation.
        </div>

        <a href="{{ route('checkout.menu') }}" class="btn-green">Back to Home</a>
    </div>

</body>
</html>
