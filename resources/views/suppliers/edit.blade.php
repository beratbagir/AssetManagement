@extends('back.layouts.pages-layout')

@section('pageTitle', 'Edit Supplier')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Supplier</div>

                <div class="card-body">
                    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Update işlemi için PUT metodu -->
                        
                        <div class="form-group mb-3">
                            <label for="name">Supplier Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $supplier->name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email: <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $supplier->email) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address: <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $supplier->address) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="city">City: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $supplier->city) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="state">State: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $supplier->state) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="zip">ZIP Code: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip', $supplier->zip) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="country">Country: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $supplier->country) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="contact_person">Contact Person: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ old('contact_person', $supplier->contact_person) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Supplier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
