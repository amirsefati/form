<?php

namespace App\Http\Controllers;

use App\Jobs\Sendsms;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class UserController extends Controller
{
    public function account_user(Request $request){
        $name = $request->data['name'];
        $brand = $request->data['brand'];
        $history = $request->data['history'];
        $insta = $request->data['insta'];
        $phone = $request->data['phone'];
        $home = $request->data['home'];
        $website = $request->data['website'];

        if(User::where('phone',$phone)->first()){
            
            return '102';
        }else{
            $code = rand(123123,989778);
            //Smsirlaravel::ultraFastSend(['name'=>$name,'phone'=>$phone,'code'=>$code],26866,$phone);
            dispatch(new Sendsms($name,$phone,$code));

            User::create([
                'name' => $name,
                'brand' => $brand,
                'history' => $history,
                'insta' => $insta,
                'phone' => $phone,
                'home' => $home,
                'website' => $website,
                'code' => $code,
            ]);
            $user_id = User::where('phone',$phone)->first()->id;
            Auth::loginUsingId($user_id);
            return '100';
        }
    }
    public function getuser_phone(Request $request){
        if(Auth::check()){
            if(Auth::user()->verify < 1){
                $id = Auth::user()->id;
                $phone = User::where('id',$id)->first('phone');
                return $phone;
            }else{
                //تایید شده احراز هویت
                return ['phone'=>1];

            }
            
        }else{
            return ['phone'=>0];
        }
        
    }

    public function check_code(Request $request){
        $pass = $request->data['pass'];
        $phone = $request->data['phone'];

        if(User::where('phone',$phone)->where('code',$pass)->first()){
            User::where('phone',$phone)->update([
                'verify' => 1
            ]);
            return '100';
            //send sms thank you
        }else{
            return '106';
        }
    } 
    
    public function logout_system(Request $request){
        Auth::logout();
    }

    public function login_system(Request $request){
        $phone = $request->data['phone'];
        $pass = $request->data['pass'];

        if(User::where('phone',$phone)->where('code',$pass)->first()){
            $data  = User::where('phone',$phone)->where('code',$pass)->first();
            return ['status' => 100 , 'data' => $data];
        }else{
            return ['status' => 101];
        }

    }

    public function change_data_update(Request $request){
        $name = $request->data['name'];
        $brand = $request->data['brand'];
        $history = $request->data['history'];
        $insta = $request->data['insta'];
        $phone = $request->data['phone'];
        $home = $request->data['home'];
        $website = $request->data['website'];

        User::where('phone',$phone)->update([
                'name' => $name,
                'brand' => $brand,
                'history' => $history,
                'insta' => $insta,
                'home' => $home,
                'website' => $website,
        ]);
        return ['status' => 100];
    }

    public function send_again_sms(Request $request){
        $phone = $request->data['phone'];
        $name = User::where('phone',$phone)->first()->name;
        $code = rand(123123,989778);
        User::where('phone',$phone)->update([
            'code' => $code
        ]);
        dispatch(new Sendsms($name,$phone,$code));
        return 100;
    }
}
