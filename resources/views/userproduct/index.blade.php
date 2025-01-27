@extends('back.layouts.pages-layout')

@section('pageTitle', 'Users Products')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Users Products</h2>
            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>

            <!-- Search Form -->
            <form action="{{ route('users.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by User or Department Name" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </div>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'id' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'id' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('users.index', array_merge(request()->all(), ['sort' => 'id', 'direction' => $nextDirection])) }}">
                                ID
                                @if(request('sort') === 'id')
                                    @if(request('direction') === 'asc') ▲
                                    @elseif(request('direction') === 'desc') ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            @php
                                $nextDirection = request('sort') === 'name' && request('direction') === 'asc' ? 'desc' : 
                                                 (request('sort') === 'name' && request('direction') === 'desc' ? null : 'asc');
                            @endphp
                            <a href="{{ route('users.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => $nextDirection])) }}">
                                User
                                @if(request('sort') === 'name')
                                    @if(request('direction') === 'asc') ▲
                                    @elseif(request('direction') === 'desc') ▼
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse($usersProducts as $usersProduct)
                    <tr>
                        <td>{{ $usersProduct->id }}</td>
                        <td>{{ $usersProduct->name }}</td>
                        <td>{{ $usersProduct->department->name ?? 'No Department' }}</td>
                        <td>
                            <a href="{{ route('users.edit', $usersProduct->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('users.destroy', $usersProduct->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No Users Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            {{ $usersProducts->links() }}
        </div>
    </div>
</div>
@endsection
