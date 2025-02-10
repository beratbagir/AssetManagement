@extends('back.layouts.pages-layout')

@section('pageTitle', 'Create Accessory')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Create Accessory</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('accessories.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Accessory Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="serial" class="form-label">Serial Number</label>
                    <input type="text" name="serial" id="serial" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="model_no" class="form-label">Model Number</label>
                    <input type="text" name="model_no" id="model_no" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="min_quantity" class="form-label">Minimum Quantity</label>
                    <input type="number" name="min_quantity" id="min_quantity" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="order_number" class="form-label">Order Number</label>
                    <input type="text" name="order_number" id="order_number" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="purchase_date" class="form-label">Purchase Date</label>
                    <input type="date" name="purchase_date" id="purchase_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="purchase_cost" class="form-label">Purchase Cost</label>
                    <input type="number" name="purchase_cost" id="purchase_cost" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="supplier_id" class="form-label">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control">
                        <option value="">Select Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="manufacturer_id" class="form-label">Manufacturer</label>
                    <select name="manufacturer_id" id="manufacturer_id" class="form-control">
                        <option value="">Select Manufacturer</option>
                        @foreach ($manufacturers as $manufacturer)
                            <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="company_id" class="form-label">Company</label>
                    <select name="company_id" id="company_id" class="form-control">
                        <option value="">Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create Accessory</button>
                <a href="{{ route('accessories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
