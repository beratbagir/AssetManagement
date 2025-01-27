@extends('back.layouts.pages-layout')

@section('pageTitle', 'Create Supplier')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Supplier</div>
                <div class="card-body">
                    <form action="{{ route('supplier.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Supplier Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email: <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Phone: <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Address: <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" id="address" rows="3" required>{{ old('address') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="city">City: <span class="text-danger">*</span></label>
                            <input type="text" name="city" class="form-control" id="city" value="{{ old('city') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="state">State: <span class="text-danger">*</span></label>
                            <input type="text" name="state" class="form-control" id="state" value="{{ old('state') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="zip">ZIP Code: <span class="text-danger">*</span></label>
                            <input type="text" name="zip" class="form-control" id="zip" value="{{ old('zip') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="country">Country: <span class="text-danger">*</span></label>
                            <input type="text" name="country" class="form-control" id="country" value="{{ old('country') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="contact_person">Contact Person: <span class="text-danger">*</span></label>
                            <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ old('contact_person') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Supplier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
