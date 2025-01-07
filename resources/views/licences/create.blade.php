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
                            <label for="product_id">Product</label>
                            <select class="form-control" id="product_id" name="product_id" required>
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="licence_key">Licence Key</label>
                            <input type="text" class="form-control" id="licence_key" name="licence_key" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="expiration_date">Expiration Date</label>
                            <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="cost">Cost</label>
                            <input type="number" class="form-control" id="cost" name="cost" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Licence</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 