<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationCodeRequest;
use App\Http\Services\VerificationServices;

class VerificationCodeController extends Controller
{

    public $services ;

    public function __construct(VerificationServices $services){
        $this->services = $services;
    }

    public function verify(VerificationCodeRequest $request){

        $check = $this->services->checkOTPCode($request->code);

        if (!$check){
            return redirect()->back()->withErrors(['code' => __('site/messages.error code')]);
        }else{
            $this->services->removeOTPCode($request->code);
            return redirect()->route('home');
        }
    }

    public function getVerifyPage(){
        return view('auth.verification');
    }

}
