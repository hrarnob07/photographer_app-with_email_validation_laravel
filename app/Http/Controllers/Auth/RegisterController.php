<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use App\Mail\verifyEmail;
use Session;

class RegisterController extends Controller
{

    use RegistersUsers;

 
    protected $redirectTo = '/home';

 
    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);


    }




    protected function create(array $data)
    {
        Session::flash('status','Register! but verify your email account to activate ');
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'verifyToken'=>Str::random(40),
            'address'=>$data['address'],
            'mobile'=>$data['mobile'],
        ]);
        $thisUser=User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }

    public function verifyEmailFirst()
    {
        return view('email.verifyEmailFirst');
    }
     public function sendEmail($thisUser){
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));

    }

    public function sendEmailDone($email,$verifyToken)
    {
        $user=User::where(['email'=>$email,'verifyToken'=>$verifyToken])->first();
        if($user)
        {
            return user::where(['email'=>$email,'verifyToken'=>$verifyToken])->update(['status'=>1,'verifyToken'=>NULL]);
        }
        else{
            return "user not found";
        }

    }
}
