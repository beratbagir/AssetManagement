@extends('back.layouts.pages-layout')

@section('pageTitle', 'Suppliers')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Suppliers</h2>
            <a href="{{ route('supplier.create') }}" class="btn btn-primary mb-3">Create Supplier</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Supplier Adress</th>
                        <th>Contact Name</th>
                        <th>E-Mail</th>
                        <th>Phone</th>
                        <th>Products</th>
                        <th>Licences</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->name}}</td>
                        <td>{{ $supplier->contact_person }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->products_count }}</td>
                        <td>{{ $supplier->licences_count }}</td>
                        
                        <td>
                            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No Supplier Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
        </div>
    </div>
</div>
@endsection
