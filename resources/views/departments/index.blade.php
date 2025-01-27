@extends('back.layouts.pages-layout')

@section('pageTitle', 'Departments')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Departments</h2>
            <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Create Department</a>
            <form action="{{ route('departments.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <!-- Arama için Text Input -->
        <input type="text" name="search" class="form-control" placeholder="Search by Department Name" value="{{ request('search') }}">

        <!-- Şirket seçimi için Selectbox -->
        <select name="company_id" class="form-control">
            <option value="">Select Company</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-secondary">Search</button>
    </div>
</form>

            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'name' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'name' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('departments.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => $nextDirection])) }}">
                                Departments
                                @if(request('sort') === 'name')
                                    @if(request('direction') === 'asc') ▲
                                    @elseif(request('direction') === 'desc') ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'company_id' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'company_id' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('departments.index', array_merge(request()->all(), ['sort' => 'company_id', 'direction' => $nextDirection])) }}">
                                Companies
                                @if(request('sort') === 'company_id')
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
                    @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->company->name }}</td>
                        <td>
                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
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