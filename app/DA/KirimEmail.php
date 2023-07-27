<?php
namespace App\DA;
use Illuminate\Support\Facades\DB;
class KirimEmail
{
  public static function send($to_email,$subject,$html_content)
  {
    $ch = curl_init();
    $datanya = ["sender"=>["name"=>"Riswandi Adha", "email"=>"riswandiadha.e03100141@gmail.com"], "to"=>[["email"=>$to_email,"name"=>$to_email]],"subject"=>$subject,"htmlContent"=>$html_content];
    curl_setopt($ch, CURLOPT_URL,"https://api.brevo.com/v3/smtp/email");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datanya));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //get api key from https://app.brevo.com/settings/keys/api
    $headers = [
        'accept: application/json',
        'api-key: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',
        'content-type: application/json',
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
  }
}