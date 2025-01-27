@extends('back.layouts.pages-layout')

@section('pageTitle', 'Companies')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Company</h2>
            <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Create Companies</a>
            
            <form action="{{ route('companies.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <!-- Arama için Company Name Input -->
                    <input type="text" name="search" class="form-control" placeholder="Search by Company Name" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </div>
            </form>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route('companies.index', array_merge(request()->all(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                ID
                                @if(request('sort') === 'id')
                                    @if(request('direction') === 'asc') ▲ @else ▼ @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'name' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'name' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('companies.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => $nextDirection])) }}">
                                Name
                                @if(request('sort') === 'name')
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
                    @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
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