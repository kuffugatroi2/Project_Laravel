<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Social;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginFacebook extends Controller
{
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(Request $request){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri
            $account_name = Login::where('customer_id',$account->user)->first();
            $request->session()->put('customer_login',$account_name->customer_name);
            $request->session()->put('customer_id',$account_name->customer_id);
            return redirect('/')->with('message', 'Đăng nhập thành công');
        } else {
            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('customer_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'customer_name' => $provider->getName(),
                    'customer_email' => $provider->getEmail(),
                    'customer_password' => '',
                    'customer_phone' => ''
                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('customer_id',$account->user)->first();

            $request->session()->put('customer_login',$account_name->customer_name);
            $request->session()->put('customer_id',$account_name->customer_id);
            return redirect('/')->with('message', 'Đăng nhập thành công');
        }
    }

}
