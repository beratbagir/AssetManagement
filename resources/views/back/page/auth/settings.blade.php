@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $paegTitle : 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="page-body">
            <div class="page-wrapper">
                <!-- Page header -->
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <h2 class="page-title">
                                    Account Settings
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page body -->
                <div class="page-body">
                    <div class="container-xl">
                        <div class="card">
                            <div class="row g-0">
                                <!-- Sidebar for navigation -->
                                <div class="col-12 col-md-3 border-end">
                                    <div class="card-body">
                                        <h4 class="subheader">Business settings</h4>
                                        <div class="list-group list-group-transparent">
                                            <a href="{{ route('author.settings') }}" class="list-group-item list-group-item-action d-flex align-items-center active">
                                                My Account
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Main content for profile update -->
                                <div class="col-12 col-md-9 d-flex flex-column">
                                    <div class="card-body">
                                        <h2 class="mb-4">My Account</h2>
                                        <h3 class="card-title mt-4">Business Profile</h3>

                                        <!-- Profile Update Form -->
                                        
                                        <div class="row g-3">
                                            <!-- Update Profile Form -->
                                            <form action="{{ route('updateprofile') }}" method="POST" class="row g-3">
                                                @csrf
                                                <!-- Name Input -->
                                                <div class="col-md">
                                                    <div class="form-label">Change Name</div>
                                                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Enter your name">
                                                </div>
                                        
                                                <!-- Email Input -->
                                                <div class="col-md">
                                                    <div class="form-label">Change Email</div>
                                                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Enter your email">
                                                </div>
                                        
                                                <!-- Title Input -->
                                                <div class="col-md">
                                                    <div class="form-label">Change Title</div>
                                                    <input type="text" name="tittle" class="form-control" value="{{ Auth::user()->tittle }}" placeholder="Enter your title">
                                                </div>
                                        
                                                <!-- Submit Button -->
                                                <div class="card-footer bg-transparent mt-auto text-end">
                                                    <a href="/home" class="btn">Cancel</a>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>

                                            <h3 class="card-title mt-4">Delete Account</h3>
                                            <p class="card-subtitle">You can delete your account by clicking this button.</p>
                                            
                                          
                                            <form action="{{ route('deleteaccount') }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete Account</button>
                                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection