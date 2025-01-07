@extends('back.layouts.pages-layout')

@section('pageTitle', 'Create Product')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Product</div>

                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="brand">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand">
                        </div>

                        <div class="form-group mb-3">
                            <label for="type">Type</label>
                            <input type="text" class="form-control" id="type" name="type">
                        </div>

                        <div class="form-group mb-3">
                            <label for="support_expire_date">Support Expiration Date</label>
                            <input type="date" class="form-control" id="support_expire_date" name="support_expire_date" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="purchase_date">Purchase Date</label>
                            <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="cost">Cost</label>
                            <input type="number" class="form-control" id="cost" name="cost" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 