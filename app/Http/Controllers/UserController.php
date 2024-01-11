<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //user registration page
    public function register()
    {
        if(Auth::check()){
            return redirect("/index");
        }
        return view('register');
    }

    //dashboard page
    public function index(){
        return view('dashboard');
    }

    //user login form
    public function showLoginForm(){
        if(Auth::check()){
            return redirect("/index");
        }
        return view('login');
    }
    

    //user registration process by verifying the mail status will be activated by default it will stored as a inprogress
    public function userRegistration(Request $data)
    {
        $data->validate([
           'user_name' => 'required|max:30|min:3',
           'email' => 'required|email|unique:users,email|max:255',
           'password' => 'required|min:8|max:64',
           'first_name'=>"required|alpha|max:20|min:3",
           'last_name'=>"nullable|alpha|max:15",
           'profile_picture'=>"required|image|mimes:jpeg,png,jpg|max:2048",
           'role'=>'required|in:admin,customer,partner',
           ]);
           //if the user credintials are satisfied then it will create a user in users table with the default status as inprogress
           User::create([
           'user_name'=>$data['user_name'],
           'email'=>$data['email'],
           'password'=>bcrypt($data['password']),
           'first_name'=>$data['first_name'],
           'last_name'=>$data['last_name'],
           'role'=>$data['role'],
               $file=$data->file('profile_picture'), //The data in file format is stored in the  $file
               $extension = $file->getClientOriginalExtension(), //The extension for the file is appended
               $filename=time().'.'.$extension,     //Every particular file is stored in specific name with the time
               $file->move('uploads/user_image/',$filename),    //All the files are stored in our project with path public/uploads/lead_image/filename
               'profile_picture' => $filename   //At last the iamge is stored in the column lead_image column of leads table
           ]);
           // By using the email which is stored in the database will be fetched from the database for the userid
            $user= User::where('email', $data->email)->first();
           //Here this verification link will be send to the verificationMail.blade.php file this link will be shared to user through mail 
            $VerificationLink=url("verificationCompleted/".encrypt($user['id']));
           //By using the mail we are sending the user, verification link to verificationmail file, that blade file will be shared to user through mail. 
            Mail::send('mailVerification/verificationMail',['user'=>$user,'verificationLink'=>$VerificationLink], function($message) use ($user){
               $message->to($user['email']);
               $message->subject("Email Verification");
              });
              Session()->flash('alert','Your Account Activation Link Has Been Sent To Your Mail! Please Verify');
              return redirect()->back();
    }

    //after clicking the verification mail this method will be executed and user status will be activated from inprogress
    public function userActivation($userId){ 
        $userId=decrypt($userId);
        $user = User::find($userId);
        if($user != null) {
            if($user['status']!='active'){
                $user->status='active';
                $user->save();
            return view('mailVerification/mailActivationSuccess');
            }
        return redirect('/login')->withErrors(['error' => 'Invalid credintials']);
        }
    }


    //user login process 

    public function userLogin(Request $data){
        $data->validate(
            [
                'email'=>"required|email|max:255|exists:users,email,status,active",
                'password'=>"required|min:8",
            ]
            );

                $credentials=$data->only('email', 'password')+ ['status' => 'active'];
                // $loginhistory = loginHistory::where('session_id', $userinfo['id'])->latest()->first();
                // if($loginhistory==null || $loginhistory['logout_time'] !=null){
                    if (Auth::attempt($credentials)){
                    $userinfo = User::where('email', $data['email'])->first();
                    //here after logged all the details will be stored in the login history table
                    loginHistory::create([
                    'user_name'=>$userinfo['user_name'],
                    'session_id'=>$userinfo['id'],
                    'user_ip'=> request()->ip(),
                    'status'=>$userinfo['status'],
                    'login_time'=>now(),
                    ]);
                   session()->put('loginId',$userinfo->id);
                    return redirect('/index');
                } else {     //if the user has login history then the user will be get the logout current session error
                    return redirect()->back()->withErrors(['error' => 'Invalid credintials']);
                }
            // } else {
            //     return  redirect()->back()->withErrors(['error' => 'User Already LoggedIn']);  

            // }
        }


        public function showAllUsers(){
        $usersinfos=User::all();     //i'm initializing the user model here to get all users from database
        return view('allUsers')->with('usersinfos',$usersinfos);
        }

        public function showSingleUser($id){
            $userId=decrypt($id);
            $userinfo=User::find($userId);
           return view('userDetails')->with('userinfo',$userinfo);

        }

        public function logOut($id){
            $session_Id=decrypt($id);
              $updateData = [         //The data you want to update
               'logout_time' => now(),
              ];
           loginHistory::where('session_id', $session_Id)->latest()->first()->update($updateData);
            Auth::logout();
            Session::flush();
            return redirect("/login");
          }

    }
    