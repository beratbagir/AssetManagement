@extends('back.layouts.pages-layout')

@section('pageTitle', 'Licences')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Licences</h2>
            <a href="{{ route('licences.create') }}" class="btn btn-primary mb-3">Create Licence</a>
            
            <!-- Search Form -->
<form action="{{ route('licences.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <!-- Arama için Text Input -->
        <input type="text" name="search" class="form-control" placeholder="Search by Licence Key, Product Name" value="{{ request('search') }}">

        <!-- Licence ID Selectbox -->
        <select 
                        name="licence_id" 
                        id="licence_id" 
                        class="form-control"
                    >
                        <option value="">-- Select Licence --</option>
                        @foreach($licences as $licence)
                            <option value="{{ $licence->licence_key }}" {{ request()->licence_key == $licence->licence_key ? 'selected' : '' }}>
                                {{ $licence->licence_key }}
                            </option>
                        @endforeach
                    </select>

        <!-- Status Filtre -->
        <select name="status" class="form-control">
            <option value="">Select Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        <button type="submit" class="btn btn-secondary">Search</button>
    </div>
</form>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'licence_id' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'licence_id' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('licences.index', array_merge(request()->all(), ['sort' => 'licence_id', 'direction' => $nextDirection])) }}">
                                ID
                                @if(request('sort') === 'licence_id')
                                    @if(request('direction') === 'asc') ▲
                                    @elseif(request('direction') === 'desc') ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            Product
                        </th>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'licence_key' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'licence_key' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('licences.index', array_merge(request()->all(), ['sort' => 'licence_key', 'direction' => $nextDirection])) }}">
                                Licence Key
                                @if(request('sort') === 'licence_key')
                                    @if(request('direction') === 'asc') ▲
                                    @elseif(request('direction') === 'desc') ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'expiration_date' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'expiration_date' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('licences.index', array_merge(request()->all(), ['sort' => 'expiration_date', 'direction' => $nextDirection])) }}">
                                Expiration Date
                                @if(request('sort') === 'expiration_date')
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
                            <a href="{{ route('licences.index', array_merge(request()->all(), ['sort' => 'cost', 'direction' => $nextDirection])) }}">
                                Cost
                                @if(request('sort') === 'cost')
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
                            <a href="{{ route('licences.index', array_merge(request()->all(), ['sort' => 'status', 'direction' => $nextDirection])) }}">
                                Status
                                @if(request('sort') === 'status')
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
                    @forelse($licences as $licence)
                    <tr>
                        <td>{{ $licence->licence_id }}</td>
                        <td>{{ $licence->product->product_name ?? 'N/A' }}</td>
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
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No Licences Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            {{ $licences->links() }}
        </div>
    </div>
</div>
@endsection
