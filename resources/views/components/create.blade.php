@extends('back.layouts.pages-layout')

@section('pageTitle', 'Create Company')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Component</div>
                <div class="card-body">
                    <form action="{{ route('components.store') }}" method="POST">
                        @csrf
                        <div class="form-group
                                mb-3">
                                <label for="name">Component Name: <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group
                                mb-3">
                                <label for="serial">Serial: <span class="text-danger">*</span></label>
                                <input type="text" name="serial" class="form-control" id="serial" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="category_id">Category: <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control" id="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group
                                mb-3">
                                <label for="model_no">Model No.: <span class="text-danger">*</span></label>
                                <input type="text" name="model_no" class="form-control" id="model_no" required>
                            </div>
                            <div class="form-group
                                mb-3">
                                <label for="min_quantity">Min. QTY: <span class="text-danger">*</span></label>
                                <input type="number" name="min_quantity" class="form-control" id="min_quantity" required>
                            </div>
                            <div class="form-group
                                mb-3">
                                <label for="model_no">Order Number: <span class="text-danger">*</span></label>
                                <input type="text" name="model_no" class="form-control" id="model_no" required>
                            </div>
                            <div class="form-group
                                mb-3">
                                <label for="purchase_date">Purchase Date: <span class="text-danger">*</span></label>
                                <input type="date" name="purchase_date" class="form-control" id="purchase_date" required>
                            </div>
                            <div class="form-group
                                mb-3">
                                <label for="purchase_cost">Purchase Cost: <span class="text-danger">*</span></label>
                                <input type="number" name="purchase_cost" class="form-control" id="purchase_cost" required>
                            </div>
                            <div class="form-group
                                mb-3">
                                <label for="supplier_id">Supplier: <span class="text-danger">*</span></label>
                                <select name="supplier_id" class="form-control" id="supplier_id" required>
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group
                                mb-3">
                                <label for="manufacturer_id">Manufacturer: <span class="text-danger">*</span></label>
                                <select name="manufacturer_id" class="form-control" id="manufacturer_id" required>
                                    <option value="">Select Supplier</option>
                                    @foreach($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Component</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
