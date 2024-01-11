@extends('layouts.app')
@Push('title')
<title>User Registration </title>
@endpush

@section('content')
@if(Session('alert'))
<script>
    alert("{{Session('alert')}}");
    </script>
    @endif
    <div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="text-center">Sign Up</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action={{route('register')}} enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label"><b>Username</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="username" name="user_name" value="{{ old('user_name') }}" required>
                                <span class="text-danger">
                                    @error('user_name')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label"><b>Email</b><span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                <span class="text-danger">
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label"><b>Password</b><span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <span class="text-danger">
                                    @error('password')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label"><b>Profile Picture</b><span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture" >
                                <span class="text-danger">
                                    @error('profile_picture')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label"><b>First Name</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                    <span class="text-danger">
                                        @error('first_name')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label"><b>Last Name</b></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name">
                                    <span class="text-danger">
                                        @error('last_name')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label"><b>Role</b><span class="text-danger">*</span></label>
                                <select class="form-select" id="role" name="role" value="{{ old('role') }}" required>
                                    <option disabled selected>Select Your Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="partner">Partner</option>
                                    <option value="customer">Customer</option>
                                </select>
                                <span class="text-danger">
                                    @error('role')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-info mt-1">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection