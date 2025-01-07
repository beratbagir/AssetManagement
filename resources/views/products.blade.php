@extends('back.layouts.pages-layout')

@section('pageTitle', 'Products and Licences')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Products</h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Support Expire Date</th>
                        <th>Purchase Date</th>
                        <th>Cost</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>{{ $product->type }}</td>
                        <td>{{ $product->support_expire_date }}</td>
                        <td>{{ $product->purchase_date }}</td>
                        <td>{{ $product->cost }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-warning">Edit</a>
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
        </div>

        <div class="col-md-6">
            <h2>Licences</h2>
            <a href="{{ route('licences.create') }}" class="btn btn-primary mb-3">Create Licence</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Licence Key</th>
                        <th>Expiration Date</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($licences as $licence)
                    <tr>
                        <td>{{ $licence->id }}</td>
                        <td>{{ $licence->product->name }}</td>
                        <td>{{ $licence->licence_key }}</td>
                        <td>{{ $licence->expiration_date }}</td>
                        <td>{{ $licence->cost }}</td>
                        <td>{{ $licence->status }}</td>
                        <td>
                            <a href="{{ route('licences.edit', $licence->licence_id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('licences.destroy', $licence->licence_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection