@extends('back.layouts.pages-layout')

@section('pageTitle', 'Edit Asset')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Asset</div>

                <div class="card-body">
                    <form action="{{ route('assets.update', ['id' => $asset->asset_id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label for="asset_name">Asset Name</label>
                            <input type="text" class="form-control" id="asset_name" name="asset_name" value="{{ $asset->asset_name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="product_id">Product</label>
                            <select class="form-control" id="product_id" name="product_id" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}" {{ $asset->product_id == $product->product_id ? 'selected' : '' }}>
                                        {{ $product->name }} ({{ $product->brand }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="licence_id">License</label>
                            <select class="form-control" id="licence_id" name="licence_id" required>
                                <option value="">Select Product First</option>
                                @foreach($licences as $licence)
                                    <option value="{{ $licence->licence_id }}" {{ $asset->licence_id == $licence->licence_id ? 'selected' : '' }}>
                                        {{ $licence->licence_key }} (Expires: {{ $licence->expiration_date }} - {{ $licence->status }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="serial_number">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ $asset->serial_number }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $asset->quantity }}" min="1" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active" {{ $asset->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $asset->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="maintenance" {{ $asset->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
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
                            <textarea class="form-control" id="notes" name="notes" rows="3">{{ $asset->notes }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Asset</button>
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
                    // Eğer önceden seçili bir licence varsa, onu seç
                    @if($asset->licence_id)
                        licenceSelect.val('{{ $asset->licence_id }}');
                    @endif
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