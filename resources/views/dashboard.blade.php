@extends('layouts.app')
@Push('title')
<title>DashBoard</title>
@section('content')

    <!-- Page Content -->
    <div class="container mt-5">
        <h2>Welcome, Covalense Digital!</h2>
        <div class="row mt-4 content-text">
            <p>
                We're thrilled to have you as part of our vibrant community. Covalense Digital takes pride in being a leading software company committed to delivering cutting-edge solutions that redefine innovation. Our dedicated team strives to create impactful and forward-thinking software to meet the evolving needs of our clients.
            </p>
            <p>
                Once again, welcome aboard! If you have any questions or need assistance, don't hesitate to reach out. We value your participation and look forward to achieving great milestones together.
            </p>
            <p>
                Best regards,
                The Covalense Digital Team
            </p>
        </div>
        <a href={{route('allusers.info')}} class="btn btn-outline-primary mt-3">Start Exploring</a>
    </div>
@endsection
