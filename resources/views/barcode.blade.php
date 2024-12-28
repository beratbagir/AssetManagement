@extends('back.layouts.pages-layout')

@section('pageTitle', 'Barcodes')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="page-body">
            <div class="container-xl">
                <h2 class="mb-4 text-center" style="font-size: 1.5rem; font-weight: bold; color: black; margin-top: 30px;">Asset Barcodes</h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($assets as $asset)
                    <div class="col">
                        <div class="card shadow-lg h-100 border-light">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <img src="{{ route('asset.barcode', $asset->id) }}" alt="Barcode" class="img-fluid" style="max-width: 180px;">
                                </div>

                                <h5 class="fw-bold text-dark mb-2" style="font-size: 1.1rem;">{{ $asset->product }}</h5>

                                <div class="text-muted mb-2" style="font-size: 0.9rem;">
                                    <small>Serial: {{ $asset->serial }}</small>
                                </div>

                                <div class="mt-2">
                                    <span class="badge
                                        {{ $asset->status == 'Deploy' ? 'bg-success' : ($asset->status == 'Pending' ? 'bg-warning text-dark' : ($asset->status == 'Ready to Deploy' ? 'bg-info text-dark' : 'bg-secondary')) }}">
                                        {{ $asset->status == 'Deploy' ? 'Deploy' : ($asset->status == 'Ready to Deploy' ? 'Ready to Deploy' : $asset->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-light text-center">
                                <small class="text-muted">Assigned: {{ $asset->assigned_user }}</small>
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
@endsection
