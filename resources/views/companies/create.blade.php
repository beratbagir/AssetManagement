@extends('back.layouts.pages-layout')

@section('pageTitle', 'Create Company')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Company</div>
                <div class="card-body">
                    <form action="{{ route('companies.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Company Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Company</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
