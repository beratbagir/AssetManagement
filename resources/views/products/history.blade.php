@extends('back.layouts.pages-layout')

@section('pageTitle', 'Product History')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Product History for {{ $product->name }}</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Asset ID</th>
                        <th>User Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($product->assets as $asset)
                    <tr>
                        <td>{{ $asset->asset_id }}</td>
                        <td>{{ $asset->assigned_to }}</td>
                        <td>{{ $asset->status ?? 'No Department' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No history available for this product.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 