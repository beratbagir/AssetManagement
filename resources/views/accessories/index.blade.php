@extends('back.layouts.pages-layout')

@section('pageTitle', 'Accessories')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Accessories</h2>
            <a href="{{ route('accessories.create') }}" class="btn btn-primary mb-3">Create Accessory</a>
            <form action="{{ route('accessories.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <!-- Arama için Company Name Input -->
                    <input type="text" name="search" class="form-control" placeholder="Search by Accessory Name" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Serial</th>
                        <th>Category</th>
                        <th>Model No.</th>
                        <th>Min. QTY</th>
                        <th>Order Number</th>
                        <th>Purchase Date</th>
                        <th>Purchase Cost</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse($accessories as $accessory)
                    <tr>
                        <td>{{ $accessory->name }}</td>
                        <td>{{ $accessory->serial }}</td>
                        <td>{{ $accessory->category ? $accessory->category->name : 'N/A' }}</td>
                        <td>{{ $accessory->model_no }}</td>
                        <td>{{ $accessory->min_quantity }}</td>
                        <td>{{ $accessory->order_number }}</td>
                        <td>{{ $accessory->purchase_date }}</td>
                        <td>{{ $accessory->purchase_cost }}</td>
                        <td>
                            <a href="{{ route('accessories.edit', $accessory->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('accessories.destroy', $accessory->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this accessory?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No Accessories Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
