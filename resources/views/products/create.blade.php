@extends('products.layouts')

@section('content')

<!-- <div class="container mt-5"> -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Product') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_id" class="col-md-4 col-form-label text-md-right">{{ __('Product ID') }}</label>
                            <div class="col-md-6">
                                <input id="product_id" type="text" class="form-control @error('product_id') is-invalid @enderror" name="product_id" value="{{ old('product_id') }}" required>
                                @error('product_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="available_stocks" class="col-md-4 col-form-label text-md-right">{{ __('Available Stocks') }}</label>
                            <div class="col-md-6">
                                <input id="available_stocks" type="number" class="form-control @error('available_stocks') is-invalid @enderror" name="available_stocks" value="{{ old('available_stocks') }}" required>
                                @error('available_stocks')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tax_percentage" class="col-md-4 col-form-label text-md-right">{{ __('Tax Percentage') }}</label>
                            <div class="col-md-6">
                                <input id="tax_percentage" type="text" class="form-control @error('tax_percentage') is-invalid @enderror" name="tax_percentage" value="{{ old('tax_percentage') }}" required>
                                @error('tax_percentage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Product') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

@endsection
