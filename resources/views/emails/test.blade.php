<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Calculation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .customer-info {
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot th,
        tfoot td {
            background-color: #e0e0e0;
        }

        tfoot td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Bill Calculation</h2>
            <div class="customer-info">
                <p><strong>Customer Email:</strong> {{$bill['customer_email']}}</p>
            </div>
        </div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Purchase Price</th>
                        <th>Tax %</th>
                        <th>Tax Payable</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_price_without_tax = 0;
                    $total_tax_payable = 0;
                    @endphp
                    @foreach ($bill['product'] as $item)
                    @php
                    $purchase_price = $item['quantity'] * $item['details']['price'];
                    $tax_payable = ($item['details']['tax_percentage'] / 100) * $purchase_price;
                    $total_price_without_tax += $purchase_price;
                    $total_tax_payable += $tax_payable;
                    @endphp
                    <tr>
                        <td>{{ $item['details']['product_id'] }}</td>
                        <td>{{ $item['details']['price'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ '₹ ' . number_format($purchase_price, 2) }}</td>
                        <td>{{ $item['details']['tax_percentage'].'%' }}</td>
                        <td>{{ '₹ ' . number_format($tax_payable, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total Price Without Tax:</th>
                        <td colspan="3">{{ '₹ ' . number_format($total_price_without_tax, 2) }}</td>
                    </tr>
                    <tr>
                        <th colspan="3">Total Tax Payable:</th>
                        <td colspan="3">{{ '₹ ' . number_format($total_tax_payable, 2) }}</td>
                    </tr>
                    <tr>
                        <th colspan="3">Net Price of the Purchased Item:</th>
                        <td colspan="3">{{ '₹ ' . number_format($total_price_without_tax + $total_tax_payable, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>
