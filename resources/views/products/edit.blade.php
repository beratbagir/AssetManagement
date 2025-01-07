@extends('back.layouts.pages-layout')

@section('pageTitle', 'Edit Product')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                    <form action="{{ route('products.update', $product->product_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="type">Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ $product->type }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="support_expire_date">Support Expiration Date</label>
                            <input type="date" class="form-control" id="support_expire_date" name="support_expire_date" value="{{ $product->support_expire_date }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="purchase_date">Purchase Date</label>
                            <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="{{ $product->purchase_date }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="cost">Cost</label>
                            <input type="number" class="form-control" id="cost" name="cost" value="{{ $product->cost }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 