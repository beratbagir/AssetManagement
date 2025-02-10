@extends('back.layouts.pages-layout')

@section('pageTitle', 'Edit Component')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Component</div>
                <div class="card-body">
                    <form action="{{ route('components.update', $component->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name">Component Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" 
                                   value="{{ old('name', $component->name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="serial">Serial: <span class="text-danger">*</span></label>
                            <input type="text" name="serial" class="form-control" id="serial" 
                                   value="{{ old('serial', $component->serial) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="category_id">Category: <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control" id="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ $category->id == $component->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="model_no">Model No.: <span class="text-danger">*</span></label>
                            <input type="text" name="model_no" class="form-control" id="model_no" 
                                   value="{{ old('model_no', $component->model_no) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="min_quantity">Min. QTY: <span class="text-danger">*</span></label>
                            <input type="number" name="min_quantity" class="form-control" id="min_quantity" 
                                   value="{{ old('min_quantity', $component->min_quantity) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="order_number">Order Number: <span class="text-danger">*</span></label>
                            <input type="text" name="order_number" class="form-control" id="order_number" 
                                   value="{{ old('order_number', $component->order_number) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="purchase_date">Purchase Date: <span class="text-danger">*</span></label>
                            <input type="date" name="purchase_date" class="form-control" id="purchase_date" 
                                   value="{{ old('purchase_date', $component->purchase_date) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="purchase_cost">Purchase Cost: <span class="text-danger">*</span></label>
                            <input type="number" name="purchase_cost" class="form-control" id="purchase_cost" 
                                   value="{{ old('purchase_cost', $component->purchase_cost) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="supplier_id">Supplier: <span class="text-danger">*</span></label>
                            <select name="supplier_id" class="form-control" id="supplier_id" required>
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" 
                                        {{ $supplier->id == $component->supplier_id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="manufacturer_id">Manufacturer: <span class="text-danger">*</span></label>
                            <select name="manufacturer_id" class="form-control" id="manufacturer_id" required>
                                <option value="">Select Manufacturer</option>
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}" 
                                        {{ $manufacturer->id == $component->manufacturer_id ? 'selected' : '' }}>
                                        {{ $manufacturer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Component</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
