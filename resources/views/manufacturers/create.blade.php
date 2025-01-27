@extends('back.layouts.pages-layout')

@section('pageTitle', 'Create Manufacturer')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Manufacturer</div>

                <div class="card-body">
                    <form action="{{ route('manufacturer.store') }}" method="POST">
                        @csrf

                        <!-- Manufacturer Name -->
                        <div class="form-group mb-3">
                            <label for="name">Manufacturer Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter manufacturer name" required>
                        </div>

                        <!-- Support Email -->
                        <div class="form-group mb-3">
                            <label for="support_email">Support Email</label>
                            <input type="email" class="form-control" id="support_email" name="support_email" placeholder="Enter support email" required>
                        </div>

                        <!-- Support Phone -->
                        <div class="form-group mb-3">
                            <label for="support_phone">Support Phone</label>
                            <input type="text" class="form-control" id="support_phone" name="support_phone" placeholder="Enter support phone" required>
                        </div>

                        <!-- Website URL -->
                        <div class="form-group mb-3">
                            <label for="url">Website URL</label>
                            <input type="url" class="form-control" id="url" name="url" placeholder="Enter website URL" required>
                        </div>

                        <!-- Support URL -->
                        <div class="form-group mb-3">
                            <label for="support_url">Support URL</label>
                            <input type="url" class="form-control" id="support_url" name="support_url" placeholder="Enter support URL" required>
                        </div>

                        <!-- Warranty Lookup URL -->
                        <div class="form-group mb-3">
                            <label for="warranty_lookup_url">Warranty Lookup URL</label>
                            <input type="url" class="form-control" id="warranty_lookup_url" name="warranty_lookup_url" placeholder="Enter warranty lookup URL" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Create Manufacturer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
