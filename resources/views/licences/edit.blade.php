@extends('back.layouts.pages-layout')

@section('pageTitle', 'Edit Licence')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Licence</div>

                <div class="card-body">
                    <form action="{{ route('licences.update', ['id' => $licence->licence_id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="product_id">Product</label>
                            <select class="form-control" id="product_id" name="product_id" required>
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}" {{ $licence->product_id == $product->product_id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="licence_key">Licence Key</label>
                            <input type="text" class="form-control" id="licence_key" name="licence_key" value="{{ $licence->licence_key }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="expiration_date">Expiration Date</label>
                            <input type="date" class="form-control" id="expiration_date" name="expiration_date" value="{{ $licence->expiration_date->format('Y-m-d') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="cost">Cost</label>
                            <input type="number" class="form-control" id="cost" name="cost" value="{{ $licence->cost }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active" {{ $licence->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $licence->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="expired" {{ $licence->status == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Licence</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 