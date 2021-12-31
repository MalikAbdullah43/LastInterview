<?php
namespace App\Service;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SmsService{    
    
 /// If User Login Then This Function Call Response Send On User Email

    public static function SendSms($number,$code){
      $APIKey = '499ef1b34232c932f298a9eb9341d818';

      $receiver = $number;
      $sender = '8583';
      $textmessage = 'Here is Your Authencation Code'.$code;
      
      $url = "https://api.veevotech.com/sendsms?hash=".$APIKey. "&receivenum=" .$receiver. "&sendernum=" .urlencode($sender)."&textmessage=" .urlencode($textmessage);
      
      #----CURL Request Start
      $ch = curl_init();
      $timeout = 30;
      curl_setopt ($ch,CURLOPT_URL, $url) ;
      curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
      curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
      $response = curl_exec($ch) ;
      curl_close($ch) ;
      #----CURL Request End, Output Response
      return $response ;
   
    }


}
