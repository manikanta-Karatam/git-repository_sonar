@extends('layouts.app')
@push('title')
<title>USERS</title>
@endpush
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <table class="table table-info">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--Here by using the for each loop we are looping the iterations, number of users will be there that many times the iterations will be performed -->
                        @foreach ($usersinfos as $userinfo)
                            <tr>
                                <td><a href = "{{route('user.info',['id'=>@encrypt($userinfo->id)])}}">{{$userinfo->user_name}}</a></td>
                                <!--Here based on the user status in the database the status will be printed-->
                                <td>
                                     @if($userinfo->status=="active")
                                        <span class="badge bg-primary">{{ucwords($userinfo->status)}}</span>
                                    @elseif($userinfo->status=="inprogress")
                                        <span  class="badge bg-warning">{{ucwords($userinfo->status)}}</span>
                                    @else
                                        <span class="badge bg-danger">{{ucwords($userinfo->status)}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection