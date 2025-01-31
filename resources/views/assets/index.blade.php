@extends('back.layouts.pages-layout')

@section('pageTitle', 'Assets')

@section('content')
<div class="container">
    <div class="row">
        <div class="mb-3">
            <form action="{{ route('assets.index') }}" method="GET" class="form-inline d-flex align-items-center">
                <!-- Search -->
                <div class="form-group mr-2">
                    <label for="search" class="mr-2">Search:</label>
                    <input 
                        type="text" 
                        name="search" 
                        id="search" 
                        class="form-control" 
                        value="{{ request()->search }}" 
                        placeholder="Search assets..."
                    >
                </div>
        
                <!-- Status -->
                <div class="form-group mr-2">
                    <label for="status" class="mr-2">Status:</label>
                    <select 
                        name="status" 
                        id="status" 
                        class="form-control"
                    >
                        <option value="">-- Select Status --</option>
                        <option value="active" {{ request()->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request()->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
        
                <!-- Product -->
                <div class="form-group mr-2">
                    <label for="product_id" class="mr-2">Product:</label>
                    <select 
                        name="product_id" 
                        id="product_id" 
                        class="form-control"
                    >
                        <option value="">-- Select Product --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->product_id }}" {{ request()->product_id == $product->product_id ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <!-- Assigned To -->
                <div class="form-group mr-2">
                    <label for="product_id" class="mr-2">Assigned To:</label>
                    <select 
                        name="assigned_to" 
                        id="assigned_to" 
                        class="form-control"
                    >
                        <option value="">-- Select Assigned --</option>
                        @foreach($assets as $asset)
                            <option value="{{ $asset->assigned_to }}" {{ request()->assigned_to == $asset->assignet_to ? 'selected' : '' }}>
                                {{ $asset->assigned_to }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Filter</button>
                <div class="form-group mr-2">
                    <a href="{{ route('assets.index') }}" class="btn btn-secondary">Clear</a>
                </div>
            </form>
        </div>
        
        
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
                                    <!-- Sortable Table Headers -->
                                    <th>
                                        @php
                                            $nextDirection = request('sort') === 'asset_id' && request('direction') === 'asc' ? 'desc' : 
                                                             (request('sort') === 'asset_id' && request('direction') === 'desc' ? null : 'asc');
                                        @endphp
                                        <a href="{{ route('assets.index', array_merge(request()->all(), ['sort' => 'asset_id', 'direction' => $nextDirection])) }}">
                                            ID
                                            @if(request('sort') === 'asset_id')
                                                @if(request('direction') === 'asc') ▲
                                                @elseif(request('direction') === 'desc') ▼
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                            
                                    <th>
                                        @php
                                            $nextDirection = request('sort') === 'asset_name' && request('direction') === 'asc' ? 'desc' : 
                                                             (request('sort') === 'asset_name' && request('direction') === 'desc' ? null : 'asc');
                                        @endphp
                                        <a href="{{ route('assets.index', array_merge(request()->all(), ['sort' => 'asset_name', 'direction' => $nextDirection])) }}">
                                            Asset Name
                                            @if(request('sort') === 'asset_name')
                                                @if(request('direction') === 'asc') ▲
                                                @elseif(request('direction') === 'desc') ▼
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                            
                                    <th>Product - Licence</th>
                            
                                    <th>
                                        @php
                                            $nextDirection = request('sort') === 'serial_number' && request('direction') === 'asc' ? 'desc' : 
                                                             (request('sort') === 'serial_number' && request('direction') === 'desc' ? null : 'asc');
                                        @endphp
                                        <a href="{{ route('assets.index', array_merge(request()->all(), ['sort' => 'serial_number', 'direction' => $nextDirection])) }}">
                                            Serial Number
                                            @if(request('sort') === 'serial_number')
                                                @if(request('direction') === 'asc') ▲
                                                @elseif(request('direction') === 'desc') ▼
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                            
                                    <th>
                                        @php
                                            $nextDirection = request('sort') === 'quantity' && request('direction') === 'asc' ? 'desc' : 
                                                             (request('sort') === 'quantity' && request('direction') === 'desc' ? null : 'asc');
                                        @endphp
                                        <a href="{{ route('assets.index', array_merge(request()->all(), ['sort' => 'quantity', 'direction' => $nextDirection])) }}">
                                            Quantity
                                            @if(request('sort') === 'quantity')
                                                @if(request('direction') === 'asc') ▲
                                                @elseif(request('direction') === 'desc') ▼
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                            
                                    <th>
                                        @php
                                            $nextDirection = request('sort') === 'status' && request('direction') === 'asc' ? 'desc' : 
                                                             (request('sort') === 'status' && request('direction') === 'desc' ? null : 'asc');
                                        @endphp
                                        <a href="{{ route('assets.index', array_merge(request()->all(), ['sort' => 'status', 'direction' => $nextDirection])) }}">
                                            Status
                                            @if(request('sort') === 'status')
                                                @if(request('direction') === 'asc') ▲
                                                @elseif(request('direction') === 'desc') ▼
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                            
                                    <th>Assigned To</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                            
                            <tbody>
                                @foreach($assets as $asset)
                                <tr>
                                    <td>{{ $asset->asset_id }}</td>
                                    <td>{{ $asset->asset_name }}</td>
                                    <td>{{ $asset->product->product_name }}</td>
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
                        {{ $assets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 