@extends('back.layouts.pages-layout')

@section('pageTitle', 'Create Licence')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Licence</div>
                <div class="card-body">
                    <form action="{{ route('licences.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="product_id">Product: <span class="text-danger">*</span></label>
                            <select name="product_id" class="form-control" id="product_id" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="licence_key">Licence Key: <span class="text-danger">*</span></label>
                            <input type="text" name="licence_key" class="form-control" id="licence_key" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="expiration_date">Expiration Date: <span class="text-danger">*</span></label>
                            <input type="date" name="expiration_date" class="form-control" id="expiration_date" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="cost">Cost: <span class="text-danger">*</span></label>
                            <input type="number" name="cost" class="form-control" id="cost" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="supplier_id">Supplier:</label>
                            <select name="supplier_id" class="form-control" id="supplier_id" required>
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status: <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" id="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Licence</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 