@extends('back.layouts.pages-layout')

@section('pageTitle', 'Licences')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Components</h2>
            <a href="{{ route('components.create') }}" class="btn btn-primary mb-3">Create Component</a>
            <form action="{{ route('components.index') }}" method="GET" class="mb-3">
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
                    @forelse($components as $component)
                    <tr>
                        <td>{{ $component->name }}</td>
                        <td>{{ $component->serial }}</td>
                        <td>{{ $component->category->name  }}</td>
                        <td>{{ $component->model_no }}</td>
                        <td>{{ $component->min_quantity }}</td>
                        <td>{{ $component->model_no }}</td>
                        <td>{{ $component->purchase_date }}</td>
                        <td>{{ $component->purchase_cost }}</td>
                        <td>
                            <a href="{{ route('components.edit', $component->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('licences.destroy', $component->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No Component Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
