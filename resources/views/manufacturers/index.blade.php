@extends('back.layouts.pages-layout')

@section('pageTitle', 'Manufacturers')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Manufacturers</h2>
            <a href="{{ route('manufacturer.create') }}" class="btn btn-primary mb-3">Create Manufacturer</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Manufacturer Name</th>
                        <th>Support Email</th>
                        <th>Support Phone</th>
                        <th>Website URL</th>
                        <th>Support URL</th>
                        <th>Warranty Lookup URL</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse($manufacturers as $manufacturer)
                    <tr>
                        <td>{{ $manufacturer->name }}</td>
                        <td>{{ $manufacturer->support_email }}</td>
                        <td>{{ $manufacturer->support_phone }}</td>
                        <td>
                            <a href="{{ $manufacturer->url }}" target="_blank">{{ $manufacturer->url }}</a>
                        </td>
                        <td>
                            <a href="{{ $manufacturer->support_url }}" target="_blank">{{ $manufacturer->support_url }}</a>
                        </td>
                        <td>
                            <a href="{{ $manufacturer->warranty_lookup_url }}" target="_blank">{{ $manufacturer->warranty_lookup_url }}</a>
                        </td>
                        <td>{{ $manufacturer->products_count }}</td>
                        
                        <td>
                            <a href="{{ route('manufacturer.edit', $manufacturer->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('manufacturer.destroy', $manufacturer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Manufacturers Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            
        </div>
    </div>
</div>
@endsection
