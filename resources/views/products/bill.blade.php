@extends('products.layouts')

@section('content')
<?php

?>
<!-- <div class="container mt-5"> -->
<div class="row justify-content-center">

    <div class="col-md-8">
        <h6 class="mb-4 float-left">Bill Calculation</h6>
        <h6 class="mb-4 float-right">Customer Email: {{$bill['customer_email']}} </h6>

        <table class="table table-bordered">
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
                $billArr = [
                'total_price_without_tax'=> 0,
                'total_tax_payable' => 0,
                ];
                @endphp

                @foreach ($bill['product'] as $key => $item)
                @php
                $billArr['total_price_without_tax'] += ($item['quantity'] * $item['details']['price']);
                $billArr['total_tax_payable'] += ($item['details']['tax_percentage'] / 100) * ($item['quantity'] * $item['details']['price']);
                @endphp

                <tr>
                    <td>{{ $item['details']['product_id'] }}</td>
                    <td>{{ $item['details']['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ '₹ '.number_format($item['quantity'] * $item['details']['price'], 2) }}</td>
                    <td>{{ $item['details']['tax_percentage'].'%' }}</td>
                    <td>{{ '₹ '.number_format(($item['details']['tax_percentage']/100)*($item['quantity']*$item['details']['price']), 2) }}</td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                @php
                $net_price = $billArr['total_price_without_tax'] + $billArr['total_tax_payable'];
                $round_val = round($net_price);
                $balance_payable_to_customer = $bill['total_amount_paid_by_customer'] - $round_val;
                @endphp
                <tr>
                    <th colspan="4" class="text-right">Total Price Without Tax:</th>
                    <td colspan="2">{{ '₹ '.number_format($billArr['total_price_without_tax'], 2) }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Total Tax Payable:</th>
                    <td colspan="2">{{ '₹ '.number_format($billArr['total_tax_payable'], 2) }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Net Price of the Purchased Item:</th>
                    <td colspan="2">{{ '₹ '.number_format($net_price, 2) }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Rounded Down Value of the Purchased Items Net Price:</th>
                    <td colspan="2">{{ number_format($round_val, 2) }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Balance Payable to the Customer:</th>
                    <td colspan="2">{{ '₹ '.number_format($balance_payable_to_customer, 2) }}</td>
                </tr>
                <tr>
                    <th colspan="6">Balance Denomination:</th>
                </tr>
                <tr>
                    <th colspan="2">Denomination</th>
                    <th colspan="2">Qty</th>
                    <th colspan="2">Total</th>
                </tr>

                @php
                $val = 0;
                @endphp

                @foreach ($bill['denominations'] as $denomination => $quantity)
                @php
                $val += $denomination * $quantity;
                @endphp
                <tr>
                    <td colspan="2">{{ $denomination }}:</td>
                    <td colspan="2">{{ $quantity }}</td>
                    <td colspan="2">{{ '₹ '.number_format(($denomination * $quantity),2) }}</td>
                </tr>
                @endforeach

                <tr>
                    <th colspan="4" class="text-right">Total Paid By customer:</th>
                    <td colspan="2">{{ '₹ '.number_format($val,2) }}</td>
                </tr>

            </tfoot>
        </table>

    </div>
    <!-- </div> -->

    @endsection
