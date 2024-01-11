@extends('layouts.app')
@push('title')
<title>User Info</title>
@endpush
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5>User Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset('uploads/user_image/'.$userinfo->profile_picture)}}" alt="User Avatar" class="img-fluid rounded">
                </div>
                <div class="col-md-8">
                    <h4 class="card-title">{{ucwords($userinfo->user_name)}}</h4>
                    <p class="card-text"><strong>First Name:</strong> {{ucwords($userinfo->first_name)}}</p>
                    <p class="card-text"><strong>Last Name:</strong> {{ucwords($userinfo->last_name)}}</p>
                    <p class="card-text"><strong>Email:</strong> {{$userinfo->email}}</p>
                    @if($userinfo->role_id==1)
                    <p class="card-text"><strong>Role:</strong> Admin</p>
                    @elseif($userinfo->role_id==2)
                    <p class="card-text"><strong>Role:</strong> Partner</p>
                    @else
                    <p class="card-text"><strong>Role:</strong> Customer</p>
                    @endif
                    <div class="d-flex justify-content-between align-items-center">
                    @if($userinfo->status=='active')
                    <p class="card-text"><strong>Status:</strong> <span class="badge bg-primary">{{ucwords($userinfo->status)}}</p>
                    @elseif($userinfo->status=='inprogress')
                    <p class="card-text"><strong>Status:</strong> <span class="badge bg-warning">{{ucwords($userinfo->status)}}</p>
                    {{-- <a href="{{route('usermail.send',['id'=>@encrypt($userinfo['user_id'])])}}" class="btn btn-outline-success">Activate</a> --}}
                    @else
                    <p class="card-text"><strong>Status:</strong> <span class="badge bg-danger">{{ucwords($userinfo->status)}}</p>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection