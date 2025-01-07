@extends('back.layouts.pages-layout')

@section('pageTitle', 'Assets')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Assets</h4>
                    <a href="{{ route('assets.create') }}" class="btn btn-primary">Create New Asset</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Asset Name</th>
                                    <th>Product - Licence</th>
                                    <th>Brand</th>
                                    <th>Serial Number</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assets as $asset)
                                <tr>
                                    <td>{{ $asset->asset_id }}</td>
                                    <td>{{ $asset->asset_name }}</td>
                                    <td>{{ $asset->full_name }}</td>
                                    <td>{{ $asset->product->brand }}</td>
                                    <td>{{ $asset->serial_number }}</td>
                                    <td>{{ $asset->quantity }}</td>
                                    <td>{{ $asset->status }}</td>
                                    <td>{{ $asset->assigned_to }}</td>
                                    <td>
                                        <a href="{{ route('assets.edit', $asset->asset_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('assets.destroy', $asset->asset_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 