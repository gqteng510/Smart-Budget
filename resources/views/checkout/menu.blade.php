<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Menu - SmartBudget Catering</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #e6fdf5; padding: 20px; padding-bottom: 120px; margin: 0; display: flex; justify-content: center; }
        .container { width: 100%; max-width: 600px; }
        .header { text-align: center; margin-bottom: 25px; }
        .menu-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; }
        .menu-info { display: flex; align-items: center; gap: 15px; }
        .menu-checkbox { width: 22px; height: 22px; cursor: pointer; accent-color: #00a859; }
        .menu-name { font-weight: bold; font-size: 16px; color: #1a202c; }
        .menu-price { color: #4a5568; font-size: 14px; }

        /* STICKY BOTTOM BUDGET BAR */
        .sticky-budget-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.1);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
            z-index: 9999;
        }
        .budget-details { display: flex; gap: 25px; align-items: center; font-size: 16px; color: #2d3748; }
        .remaining-box { background-color: #f0fdf4; padding: 8px 18px; border-radius: 8px; display: flex; flex-direction: column; align-items: flex-start; border: 1px solid #bbf7d0; transition: all 0.2s ease; }
        .remaining-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #166534; font-weight: 700; }
        .remaining-large-amount { font-size: 22px; color: #00a859; font-weight: 800; }
        .bg-over-budget { background-color: #fff5f5 !important; border-color: #fed7d7 !important; }
        .text-over-budget { color: #e53e3e !important; }
        .budget-warning-badge { background-color: #fff5f5; color: #e53e3e; border: 1px solid #fed7d7; padding: 10px 15px; border-radius: 6px; font-weight: bold; font-size: 14px; }

        .btn-continue-checkout {
            background-color: #00a859; color: white; padding: 14px 28px; border-radius: 8px; font-weight: bold; text-decoration: none; font-size: 16px; display: inline-block; border: none; transition: all 0.2s; cursor: pointer;
        }
        .btn-continue-checkout:hover { background-color: #008f4c; }
    </style>
</head>
<body>

<form action="{{ route('checkout.saveMenu') }}" method="POST" class="container">
    @csrf

    <div class="header">
        <h2>Select Your Catering Menu</h2>
        <p style="color: #666;">Choose your packages within your RM {{ number_format($budget, 2) }} limit</p>
    </div>

    <div class="menu-card">
        <div class="menu-info">
            <input type="checkbox" name="selected_packages[]" class="menu-checkbox" data-price="250.00" value='{"name": "Sago Gula Melaka (Dessert Pack)", "price": 5.00}'>
            <div>
                <div class="menu-name">Sago Gula Melaka (Dessert Pack)</div>
                <div class="menu-price">RM 5.00 × 50 guests = <b>RM 250.00</b></div>
            </div>
        </div>
    </div>

    <div class="menu-card">
        <div class="menu-info">
            <input type="checkbox" name="selected_packages[]" class="menu-checkbox" data-price="100.00" value='{"name": "Teh Tarik (Beverage Pack)", "price": 2.00}'>
            <div>
                <div class="menu-name">Teh Tarik (Beverage Pack)</div>
                <div class="menu-price">RM 2.00 × 50 guests = <b>RM 100.00</b></div>
            </div>
        </div>
    </div>

    <div class="menu-card">
        <div class="menu-info">
            <input type="checkbox" name="selected_packages[]" class="menu-checkbox" data-price="750.00" value='{"name": "Nasi Minyak & Ayam Masak Merah (Premium Pack)", "price": 15.00}'>
            <div>
                <div class="menu-name">Nasi Minyak & Ayam Masak Merah (Premium Pack)</div>
                <div class="menu-price">RM 15.00 × 50 guests = <b>RM 750.00</b></div>
            </div>
        </div>
    </div>

    <div class="sticky-budget-bar">
        <div class="budget-details">
            <div>Selected Items: <strong id="sticky-items-count">0</strong></div>
            <div style="color: #e2e8f0; font-size: 20px;">|</div>
            <div>Total Price: <strong id="sticky-total-price">RM 0.00</strong></div>
            <div style="color: #e2e8f0; font-size: 20px;">|</div>

            <div class="remaining-box" id="remaining-wrapper">
                <span class="remaining-label" id="remaining-label-text">Remaining Budget</span>
                <span id="sticky-remaining-budget" class="remaining-large-amount">RM {{ number_format($budget, 2) }}</span>
            </div>
        </div>

        <div id="budget-warning-msg" class="budget-warning-badge" style="display: none;">
            Budget Exceeded! Please adjust your items.
        </div>

        <div>
            <button type="submit" id="checkout-action-btn" class="btn-continue-checkout">Continue to Checkout</button>
        </div>
    </div>
</form>

<script>
    const MAX_USER_BUDGET = parseFloat("{{ $budget }}");

    function calculateLiveMenuBudget() {
        let currentTotal = 0;
        let totalItems = 0;

        document.querySelectorAll('.menu-checkbox:checked').forEach(box => {
            currentTotal += parseFloat(box.dataset.price || 0);
            totalItems++;
        });

        let remainingBudget = MAX_USER_BUDGET - currentTotal;

        document.getElementById('sticky-items-count').innerText = totalItems;
        document.getElementById('sticky-total-price').innerText = 'RM ' + currentTotal.toFixed(2);

        const remainingDisplay = document.getElementById('sticky-remaining-budget');
        const remainingWrapper = document.getElementById('remaining-wrapper');
        const remainingLabel = document.getElementById('remaining-label-text');
        const warningAlert = document.getElementById('budget-warning-msg');
        const checkoutBtn = document.getElementById('checkout-action-btn');

        remainingDisplay.innerText = 'RM ' + remainingBudget.toFixed(2);

        if (remainingBudget < 0) {
            remainingWrapper.classList.add('bg-over-budget');
            remainingDisplay.classList.add('text-over-budget');
            remainingLabel.innerText = "Over Budget";
            remainingLabel.style.color = "#9b2c2c";
            warningAlert.style.display = 'block';

            checkoutBtn.disabled = true;
            checkoutBtn.style.backgroundColor = '#cbd5e1';
            checkoutBtn.style.color = '#94a3b8';
            checkoutBtn.style.boxShadow = 'none';
            checkoutBtn.style.cursor = 'not-allowed';
        } else {
            remainingWrapper.classList.remove('bg-over-budget');
            remainingDisplay.classList.remove('text-over-budget');
            remainingLabel.innerText = "Remaining";
            remainingLabel.style.color = "#1a202c";
            warningAlert.style.display = 'none';

            checkoutBtn.disabled = false;
            checkoutBtn.style.backgroundColor = '#00a859';
            checkoutBtn.style.color = 'white';
            checkoutBtn.style.boxShadow = '0 4px 12px rgba(0, 168, 89, 0.2)';
            checkoutBtn.style.cursor = 'pointer';
        }

    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.menu-checkbox').forEach(box => {
            box.addEventListener('change', calculateLiveMenuBudget);
        });
        calculateLiveMenuBudget();
    });
</script>

</body>
</html>
