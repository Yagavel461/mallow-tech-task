@extends('products.layouts')

@section('content')

<div class="container mt-">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-4">Product List</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">S.no</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Purchase ID</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Total Tax</th>
                        <th scope="col">Net Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Purchased At</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $product['customer_email'] }}</td>
                        <td><a href="{{ route('purchase.details', ['id' => $product['purchase_id']]) }}">{{ $product['purchase_id'] }}</a></td>
                        <td>{{ '₹ ' . number_format($product['total_price'], 2) }}</td>
                        <td>{{ '₹ ' . number_format($product['total_tax'], 2) }}</td>
                        <td>{{ '₹ ' . number_format(($product['total_price']+$product['total_tax']), 2) }}</td>
                        <td>{{ ucfirst($product['status']) }}</td>
                        <td>{{ (new DateTime($product['created_at']))->format('Y-m-d h:i A') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
