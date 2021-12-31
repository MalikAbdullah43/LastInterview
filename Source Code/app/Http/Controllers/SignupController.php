<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Service\MailService;
use App\Service\SmsService;
use App\Service\ImageDecode;
use Illuminate\Support\Facades\Storage;

class SignupController extends Controller
{
    function signUp(SignupRequest $request)
    {
        try {
            //Using Model
            $user = new User;
            $user->email     = $request->email;                        //get data from email
            $user->password  = Hash::make($request->password);  
            $user->mobile_n = $request->mobile_no;

            $sms_code   = rand(111111,999999);   //Here We Generated Sms Code 
            $email_code = rand(111111,999999);   //Here We Generated Email Code
            $auth_code  = rand(111111,999999);   //Here We Generated Auth Code
            $response   = $this->signUpMail($request->email,$email_code);

            //$response2   = SmsService::SendSms($request->mobile_no,$sms_code);
    
            //$arr = json_decode($response2);
           
            if ($response === true){   
                   //if Mail Send then Save Data in Database and Print message
                $user->save();  //Save Data in Database
                $id = $user["id"];
                $respons = $this->afterEmailSend($id,$sms_code,$email_code,$auth_code);
                if ($response === true)
                    return response()->json(["message" => "Your Account is Ready Kindly Verify Your Email", "status" => "201"], 201);
                else
                    return response()->json(["message" => "falses", "status" => "500"], 500);
            } else return response()->json(["message" => "false", "status" => "500"], 500);
        } catch (Exception $error) {
            return $error;
        };
    }



  //Send Mail to User
    public function signUpMail($email,$email_code){
      
        try {
            $response   = MailService::mail($email,$email_code);
    
            if ($response == true)
                return true;
            else
                return false;
        } catch (Exception $error) {
            return $error;
        };
    }

    //If Mail Send Then Add Data in Database
    public function afterEmailSend($id,$sms_code,$email_code,$auth_code){
        try {
            $time = now()->addMinutes(30)->__toString();
            $user = User::where(['id' => $id])
                ->update(['email_verified_at' => null, 'status' => 0, 'exp_time' => $time]);
            $auth = User::insert(['email_code' => $email_code, 'mobile_code' => $sms_code,'auth_code'=>$auth_code,'user_id'=>$id, 'exp_time' => $time]);
            return true;
        } catch (Exception $error) {
            return $error;
        };
    }
}
