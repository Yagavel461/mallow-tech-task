@extends('products.layouts')


@section('content')
<div class="container">
    <h4 class="mb-5">Purchased Product Details</h4>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer Email</th>
                    <th>Purchase ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                    <th>Total Tax</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product['customer_email'] }}</td>
                    <td>{{ $product['purchase_id'] }}</td>
                    <td>{{ $product['product_id'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td> {{ '₹ ' . number_format($product['unit_price'], 2) }} </td>
                    <td> {{ '₹ ' . number_format($product['total_price'], 2) }}</td>
                    <td>{{ '₹ ' . number_format($product['total_tax'], 2) }} </td>
                    <td>{{ (new DateTime($product['created_at']))->format('Y-m-d h:i A') }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12 float-right">
            <h6>Total Tax: {{ '₹ ' . number_format($overallTax, 2) }}</h6>
            <h6>Net Total: {{ '₹ ' . number_format($overallTotalPrice, 2) }} </h6>
        </div>
    </div>
</div>
@endsection
