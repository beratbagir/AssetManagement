@extends('back.layouts.pages-layout')
@section('pageTitle', 'Kullanıcı Listesi')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="page-body">
                <div class="container-xl">
                    <h2 class="mb-4">Users</h2>
                    <div class="row row-cards">
                        @foreach($users as $user)
                            <div class="col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body p-4 text-center">
                                        <span class="avatar avatar-xl mb-3 rounded"
                                              style="background-image: url('/path/to/default/avatar.jpg')"></span>
                                        <h3 class="m-0 mb-1">
                                            <a href="#">{{ $user->name }}</a>
                                        </h3>
                                        <div class="text-secondary">{{ $user->tittle }}</div>
                                        <div class="mt-3">
                                            <span class="badge bg-purple-lt">Online</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-2">
                                        <!-- Assign Role Button -->
                                        <form id="roleForm-{{ $user->id }}" action="{{ route('postuser', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="button" class="btn btn-outline-success btn-assign-role" id="openModalButton-{{ $user->id }}">
                                                <i class="fas fa-user-tag"></i> Assign Role
                                            </button>
                                        </form>

                                        <!-- Modal -->
                                        <div class="modal fade" id="rolesModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="rolesModalLabel-{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rolesModalLabel-{{ $user->id }}">Assign Role</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Please select a role for the user:</p>

                                                        <form action="{{ route('postuser') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                            <div class="form-group">
                                                                <label for="role">Select Role:</label>
                                                                <select name="role" id="role" class="form-control">
                                                                    @foreach ($roles as $role)
                                                                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-success">Assign Role</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="fas fa-trash"></i> Delete Account
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            @foreach($users as $user)
            $('#openModalButton-{{ $user->id }}').click(function () {
                $('#rolesModal-{{ $user->id }}').modal('show');
            });

            $('#confirmRoleButton-{{ $user->id }}').click(function () {

                var selectedRole = $('#roleSelect-{{ $user->id }}').val();

                $('<input>').attr({
                    type: 'hidden',
                    name: 'role',
                    value: selectedRole
                }).appendTo('#roleForm-{{ $user->id }}');

                $('#roleForm-{{ $user->id }}').submit();

                $('#rolesModal-{{ $user->id }}').modal('hide');
            });
            @endforeach
        });
    </script>
@endsection
