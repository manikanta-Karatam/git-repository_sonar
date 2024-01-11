@extends('layouts.app')
@Push('title')
<title>User login </title>
@endpush
@section('content')
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Login</h4>
                    </div>
                    @if($errors->any())
                        <div class="alert alert-danger">
                         @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="post" action={{route('login')}}>
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit"  class="btn btn-outline-info">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
