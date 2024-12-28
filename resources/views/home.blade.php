@extends('back.layouts.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Assets')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('create_asset')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAssetModal">
                Create Asset
            </button>
            @endcan
        </div>
    </div>
     <div class="modal fade" id="createAssetModal" tabindex="-1" aria-labelledby="createAssetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    @
                    <h5 class="modal-title" id="createAssetModalLabel">Create New Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="product">Product</label>
                            <input type="text" class="form-control" id="product" name="product" placeholder="Product name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Deploy">Deploy</option>
                                <option value="Ready to Deploy">Ready to Deploy</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="asset_name">Asset Name</label>
                            <input type="text" class="form-control" id="asset_name" name="asset_name" placeholder="Asset name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="serial">Serial Number</label>
                            <input type="text" class="form-control" id="serial" name="serial" placeholder="Serial number" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="assigned_user">Assign to User</label>
                            <select class="form-control" id="assigned_user" name="assigned_user" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
                        </div>

                        <div class="mb-3">
                            <label for="pdf" class="form-label">Upload PDF</label>
                            <input type="file" class="form-control" name="pdf" accept="application/pdf">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Asset</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Asset Name</th>
                        <th>Serial Number</th>
                        <th>Quantity</th>
                        <th>Assigned User</th>
                        @role('admin')
                        <th> Agreement Terms</th>
                        @endrole
                        @role('admin')
                        <th>Actions</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($assets as $asset)
                    <tr>
                        <td>{{ $asset->id }}</td>
                        <td>{{ $asset->product }}</td>
                        <td>{{ $asset->status }}</td>
                        <td>{{ $asset->asset_name }}</td>
                        <td>{{ $asset->serial }}</td>
                        <td>{{ $asset->quantity }}</td>
                        <td>{{ $asset->assigned_user }}</td>
                        @role('admin')
                        <td>
                            <a href="{{ asset('storage/' . $asset->pdf) }}" target="_blank">View PDF</a>
                        </td>
                        @endrole
                            <td>
                                <!-- Edit Button -->
                                @can('edit_asset')
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editAssetModal{{ $asset->id }}">
                                    Edit
                                </button>
                                @endcan
                                <!-- Edit Modal -->
                        <div class="modal fade" id="editAssetModal{{ $asset->id }}" tabindex="-1" aria-labelledby="editAssetModalLabel{{ $asset->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editAssetModalLabel{{ $asset->id }}">Edit Asset #{{ $asset->product }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('assets.update', $asset->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group mb-3">
                                                <label for="product">Product</label>
                                                <input type="text" class="form-control" name="product" value="{{ $asset->product }}" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="status">Status</label>
                                                <select class="form-select" name="status" required>
                                                    <option value="Deploy" {{ $asset->status == 'Deploy' ? 'selected' : '' }}>Deploy</option>
                                                    <option value="Ready to Deploy" {{ $asset->status == 'Ready to Deploy' ? 'selected' : '' }}>Ready to Deploy</option>
                                                    <option value="Pending" {{ $asset->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="asset_name">Asset Name</label>
                                                <input type="text" class="form-control" name="asset_name" value="{{ $asset->asset_name }}" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="serial">Serial Number</label>
                                                <input type="text" class="form-control" name="serial" value="{{ $asset->serial }}" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="quantity">Quantity</label>
                                                <input type="number" class="form-control" name="quantity" value="{{ $asset->quantity }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="pdf" class="form-label">Upload PDF</label>
                                                <input type="file" class="form-control" name="pdf" accept="application/pdf">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="assigned_user">Assigned User</label>
                                                <select class="form-control" name="assigned_user" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->name }}" {{ $asset->assigned_user == $user->name ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update Asset</button>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('delete_asset')
                            <form action="{{ route('delete.asset', $asset->id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                                @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
