<!-- here we are sending these details to the user through mail -->
<h1>Hello {{$user['user_name']}}</h1>
<!-- based on the user status the verification link will be shared to the user through mail wheather to activate or deactivate the user -->
@if($user['status']=='inprogress')
<p>Welcome to Covalense Digital</p>
<a href="{{$verificationLink}}">Click Here To Activate Your Account</a>
<p>
    Once again, welcome aboard! If you have any questions or need assistance, don't hesitate to reach out. We value your participation and look forward to achieving great milestones together.
</p>
<p>
    Best regards,
    The Covalense Digital Team
</p>
@endif
