<?php

use App\Models\Product;
?>
@extends('products.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="container mt-5">
            <h2 class="mb-4">Product List</h2>
            @if(session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible">{{ session('success') }}</div>
            @endif

            @if(session('failed'))
            <div id="failedAlert" class="alert alert-danger alert-dismissible">{{ session('failed') }}</div>
            @endif

            <a href="/create/product" class="btn btn-primary mb-3 float-right">Add Product</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Product ID</th>
                        <th scope="col">Available Stocks</th>
                        <th scope="col">Price</th>
                        <th scope="col">Tax Percentage</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($products))
                    <tr>
                        <td colspan="6" class="text-center">No products available</td>
                    </tr>
                    @else
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['product_id'] }}</td>
                        <td>{{ $product['available_stocks'] }}</td>
                        <td>{{ '₹ ' . number_format($product['price'], 2) }}</td>
                        <td>{{ $product['tax_percentage'] . ' %' }}</td>
                        <td>
                            <div>
                                <button type="button" onclick="return updatePopup('{{ $product['id'] }}')" class="btn btn-primary btn-sm edit-product-btn" data-toggle="modal">
                                    Edit
                                </button>
                                <form action="{{ route('product.delete', ['id' => $product['id']]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Label">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('product.update') }}" method="POST">
                @csrf
                @method('POST
                ')
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="mod_id" name="id" value="">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="mod_name" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label for="product_id">Product ID:</label>
                        <input type="text" class="form-control" id="mod_product_id" readonly name="product_id" value="">
                    </div>
                    <div class="form-group">
                        <label for="available_stocks">Available Stocks:</label>
                        <input type="text" class="form-control" id="mod_available_stocks" name="available_stocks" value="">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="mod_price" name="price" value="">
                    </div>
                    <div class="form-group">
                        <label for="tax_percentage">Tax Percentage:</label>
                        <input type="text" class="form-control" id="mod_tax_percentage" name="tax_percentage" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updatePopup(productid) {
        let products = <?php echo json_encode($products); ?>;
        let updateProd = products.filter(obj => obj.id == productid);
        let ids = ['mod_id', 'mod_tax_percentage', 'mod_price', 'mod_available_stocks', 'mod_product_id', 'mod_name'];
        for (let key in updateProd[0]) {
            if (ids.includes(`mod_${key}`) && updateProd[0].hasOwnProperty(key)) {
                $(`#mod_${key}`).val(updateProd[0][key]);
            }
        }
        $('#editProductModal').modal('show');
    }
</script>

@endsection
