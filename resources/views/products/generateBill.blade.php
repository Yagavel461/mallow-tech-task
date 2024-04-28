@extends('products.layouts')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible">{{ session('success') }}</div>
            @endif


            @if(session('failed'))
            <div id="failedAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('failed') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Billing Calculation') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('billing.calculate') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="customer_email" class="col-md-4 col-form-label text-md-right">{{ __('Customer Email') }}</label>
                            <div class="col-md-6">
                                <input id="customer_email" type="email" class="form-control @error('customer_email') is-invalid @enderror" name="customer_email" value="{{ old('customer_email') }}" required>
                                @error('customer_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="productFields">
                            <label for="products" class="col-md-4 col-form-label text-md-right">{{ __('Products') }}</label>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-success" onClick="appendInput()" id="addProductBtn">Add</button>
                                <div class="row addnew mt-3">
                                    <div class="col-md-6">
                                        <input type="text" placeholder="ProductID" name="product[0][product_id]" class="form-control" id="usr" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" placeholder="Quantity" name="product[0][quantity]" class="form-control" id="usr" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <label for="amount_given" class="col-md-4 col-form-label text-md-right">{{ __('Amount Paid By Customer') }}</label>

                        @php
                        $denominations = [500, 200, 100, 50, 20, 10, 5,2,1];
                        @endphp

                        @foreach ($denominations as $denomination)
                        <div class="form-group row">
                            <div class="col-md-2 offset-md-4">
                                <label for="products" class="col-form-label text-md-right">{{ __($denomination) }}</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" step="1" placeholder="Enter quantity of {{ $denomination }}" name="denominations[{{ $denomination }}]" class="form-control denomination-input" onkeyup="return calculateTotal()">
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group row">
                            <label for="amount_given" class="col-md-4 col-form-label text-md-right">{{ __('Amount Paid By Customer') }}</label>
                            <div class="col-md-6">
                                <input id="amount_given" type="text" class="form-control @error('amount_given') is-invalid @enderror" name="amount_given" value="{{ old('amount_given') }}" required readonly>
                                @error('amount_given')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Calculate Bill') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#successAlert, #failedAlert').delay(5000).fadeOut();
    });

    let counter = 1; // Initialize counter for unique identifiers
    function appendInput() {
        // Append HTML for new input fields
        var newRow = $('<div class="row mt-3">' +
            '<div class="col-md-5">' +
            '<input type="text" placeholder="ProductID" name="product[' + counter + '][product_id]" class="form-control" required>' +
            '</div>' +
            '<div class="col-md-5">' +
            '<input type="number" placeholder="Quantity" name="product[' + counter + '][quantity]" class="form-control" required>' +
            '</div>' +
            '<div class="col-md-2">' +
            '<button type="button" class="btn btn-danger remove-btn">X</button>' +
            '</div>' +
            '</div>');

        // Append the new row to the container
        $('.addnew').append(newRow);

        // Increment counter
        counter++;

        // Add click event handler to remove button
        newRow.find('.remove-btn').click(function() {
            $(this).closest('.row').remove();
        });
    }

    function calculateTotal() {
        var total = 0;

        $('.denomination-input').each(function() {
            var denomination = parseFloat($(this).attr('placeholder').split(' ')[3]);
            var quantity = parseFloat($(this).val());
            if (!isNaN(quantity)) {
                total += denomination * quantity;
            }
        });
        // Display total value
        $('#amount_given').val(total.toFixed(2)); // Adjust the number of decimal places as needed
    }

    // Call the calculateTotal function when any input field changes
    $('.denomination-input').on('keypress', function() {
        alert('ddd');
        calculateTotal();
    });
</script>
