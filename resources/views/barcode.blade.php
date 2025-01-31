@extends('back.layouts.pages-layout')

@section('pageTitle', 'Barcodes')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="page-body">
            <div class="container-xl">
                <h2 class="mb-4 text-center" style="font-size: 1.5rem; font-weight: bold; color: #007bff; margin-top: 30px;">Asset Barcodes</h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($assets as $asset)
                    <div class="col">
                        <div class="card shadow-lg h-100 border-light">
                            <div class="card-body text-center">
                                <div class="mb-3 barcode-container" data-asset-id="{{ $asset->asset_id }}" data-serial="{{ $asset->serial_number }}">
                                    <img src="" alt="Barcode" class="img-fluid barcode-image" style="max-width: 180px;">
                                </div>

                                <h5 class="fw-bold text-dark mb-2" style="font-size: 1.1rem;">{{ $asset->product->name }}</h5>

                                <div class="text-muted mb-2" style="font-size: 0.9rem;">
                                    <small>Serial: {{ $asset->serial_number }}</small>
                                </div>

                                <div class="mt-2">
                                    <span class="badge
                                        {{ $asset->status == 'active' ? 'bg-success' : ($asset->status == 'inactive' ? 'bg-warning text-dark' : ($asset->status == 'maintenance' ? 'bg-info text-dark' : 'bg-secondary')) }}">
                                        {{ $asset->status }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-light text-center">
                                <small class="text-muted">Assigned: {{ $asset->assigned_to }}</small>
                            </div>
                            <div class="card-footer bg-light text-center">
                                <small class="text-muted">Quantity: {{ $asset->quantity }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const barcodeContainers = document.querySelectorAll('.barcode-container');
    
    barcodeContainers.forEach(container => {
        const assetId = container.dataset.assetId;
        const barcodeImage = container.querySelector('.barcode-image');
        
        fetch(`/barcode/${assetId}`)
            .then(response => response.json())
            .then(data => {
                barcodeImage.src = `data:image/png;base64,${data.barcode}`;
            })
            .catch(error => console.error('Error loading barcode:', error));
    });
});
</script>
@endpush

@endsection
