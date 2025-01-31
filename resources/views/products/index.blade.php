@extends('back.layouts.pages-layout')

@section('pageTitle', 'Products')

@section('content')
<div class="container">
    <div class="row">
        <div class="mb-3">
            <form action="{{ route('products.index') }}" method="GET" class="form-inline d-flex align-items-center">
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
        
                <!-- Category -->
                <div class="form-group mr-2">
                    <label for="category_id" class="mr-2">Category:</label>
                    <select 
                        name="category_id" 
                        id="category_id" 
                        class="form-control"
                    >
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


            <div class="form-group mr-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="form-group mr-2">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Clear</a>
            </div>
        </div>
    </form>
        

        <div class="col-md-12">
            <h2>Products</h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'name' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'name' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('products.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => $nextDirection])) }}">
                                Name
                                @if(request('sort') === 'name')
                                    @if(request('direction') === 'asc') ▲
                                    @elseif(request('direction') === 'desc') ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'support_expire_date' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'support_expire_date' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('products.index', array_merge(request()->all(), ['sort' => 'support_expire_date', 'direction' => $nextDirection])) }}">
                                Support Expiry Date
                                @if(request('sort') === 'support_expire_date')
                                    @if(request('direction') === 'asc') ▲
                                    @elseif(request('direction') === 'desc') ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'purchase_date' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'purchase_date' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('products.index', array_merge(request()->all(), ['sort' => 'purchase_date', 'direction' => $nextDirection])) }}">
                                Purchase Date
                                @if(request('sort') === 'purchase_date')
                                    @if(request('direction') === 'asc') ▲
                                    @elseif(request('direction') === 'desc') ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'cost' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'cost' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('products.index', array_merge(request()->all(), ['sort' => 'cost', 'direction' => $nextDirection])) }}">
                                Cost
                                @if(request('sort') === 'cost')
                                    @if(request('direction') === 'asc') ▲
                                    @elseif(request('direction') === 'desc') ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->support_expire_date }}</td>
                        <td>{{ $product->purchase_date }}</td>
                        <td>{{ $product->cost }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('products.history', $product->product_id) }}" class="btn btn-info">History</a>
                            <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection 