@extends('back.layouts.pages-layout')

@section('pageTitle', 'Create Company')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Department</div>
                <div class="card-body">
                    <form action="{{ route('departments.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Department Name:</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="company_id">Company:</label>
                            <select name="company_id" class="form-control" id="company_id" required>
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Department</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
