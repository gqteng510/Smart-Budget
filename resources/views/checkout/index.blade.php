<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - SmartBudget Ezzati Catering</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #e6fdf5; display: flex; justify-content: center; padding: 20px; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); width: 100%; max-width: 500px; margin-bottom: 20px; box-sizing: border-box; }
        .btn-green { background-color: #00a859; color: white; border: none; padding: 15px; width: 100%; border-radius: 8px; font-weight: bold; font-size: 16px; cursor: pointer; transition: background 0.2s; }
        .btn-green:hover { background-color: #008f4c; }
        .summary-item { display: flex; justify-content: space-between; margin-bottom: 15px; }
        .alert-box { background-color: #f0f4f8; border: 1px solid #d9e2ec; padding: 15px; border-radius: 8px; color: #334e68; font-size: 14px; margin-bottom: 20px; line-height: 1.4; }
        input, textarea { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        label { font-weight: 600; color: #4a5568; }
    </style>
</head>
<body>

<div style="width: 100%; max-width: 500px;">
    @if(session('success'))
        <div style="background: #00a859; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('checkout.place') }}" method="POST">
        @csrf

        <!-- Delivery Information Card -->
        <div class="card">
            <h3 style="margin-top:0; color: #1a202c; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">Delivery Information</h3>

            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" placeholder="e.g. 0176232541" required>

            <label for="delivery_address">Delivery Address</label>
            <textarea id="delivery_address" name="delivery_address" rows="3" placeholder="Enter full delivery address here..." required></textarea>
        </div>

        <!-- Order Summary Card -->
        <div class="card">
            <h3 style="margin-top:0; color: #1a202c; padding-bottom: 8px;">Order Summary</h3>
            <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 15px;">

            @foreach($orderSummary as $item)
                <div class="summary-item">
                    <div>
                        <strong>{{ $item['name'] }}</strong><br>
                        <small style="color: gray;">RM {{ number_format($item['price'], 2) }} × {{ $guests }} guests</small>
                    </div>
                    <div style="font-weight: 600;">
                        RM {{ number_format($item['item_total'], 2) }}
                    </div>
                </div>
            @endforeach

            <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 15px;">

            <div class="summary-item">
                <span style="color: gray;">Number of Guests:</span>
                <strong>{{ $guests }}</strong>
            </div>
            <div class="summary-item">
                <span style="color: gray;">Items Ordered:</span>
                <strong>{{ count($orderSummary) }}</strong>
            </div>

            <div class="summary-item" style="font-size: 19px; margin-top: 20px; border-top: 2px dashed #e2e8f0; padding-top: 15px;">
                <strong>Total Amount:</strong>
                <strong style="color: #00a859;">RM {{ number_format($totalAmount, 2) }}</strong>
                <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
            </div>
        </div>

        <div class="alert-box">
            <strong>What's Next?</strong> Our team will contact you within 24 hours to confirm your order details and arrange payment. Please keep your order reference number handy.
        </div>

        <input type="hidden" name="number_of_guests" value="{{ $guests }}">

        <button type="submit" class="btn-green">Place Order</button>
    </form>
</div>

</body>
</html>
