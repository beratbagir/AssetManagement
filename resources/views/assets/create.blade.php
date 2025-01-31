@extends('back.layouts.pages-layout')

@section('pageTitle', 'Create Asset')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Asset</div>

                <div class="card-body">
                    <form action="{{ route('assets.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="asset_name">Asset Name</label>
                            <input type="text" class="form-control" id="asset_name" name="asset_name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="product_id">Product</label>
                            <select class="form-control" id="product_id" name="product_id" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}">{{ $product->product_name }} ({{ $product->brand }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="licence_id">License</label>
                            <select class="form-control" id="licence_id" name="licence_id" required>
                                <option value="">Select Product First</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="serial_number">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number">
                        </div>

                        <div class="form-group mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="assigned_to">Assigned To</label>
                            <select class="form-control" id="assigned_to" name="assigned_to">
                                <option value="">Select User</option>
                                @foreach($usersProducts as $usersProduct)
                                    <option value="{{ $usersProduct->name }}">{{ $usersProduct->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="form-group mb-3">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Asset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#product_id').change(function() {
        var productId = $(this).val();
        var licenceSelect = $('#licence_id');
        
        licenceSelect.empty();
        licenceSelect.append('<option value="">Select License</option>');
        
        if(productId) {
            $.ajax({
                url: "{{ url('assets/licences') }}/" + productId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(key, licence) {
                        licenceSelect.append(
                            $('<option></option>')
                                .val(licence.licence_id)
                                .text(licence.licence_key)
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching licences:', error);
                    alert('Error loading licences. Please try again.');
                }
            });
        }
    });
});
</script>
@endpush

@endsection 