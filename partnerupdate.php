<?php
$arr = array(1699841000340851729);
foreach ($arr as $recordId) {
  $url = "https://www.zohoapis.com/crm/v2/users/{$recordId}";
  error_log($url);
  $headers = array("Content-type: application/json");
  $headers = array("Authorization: Zoho-oauthtoken 1000.f1b0655637abf45aa08f92820f8b418d.737629ca1181e9f0b9c99d292dccb2f5");
  $ch = curl_init();
  $json = '{"users":[{"reporting_to_id":"1699841000311564761",}]}';
  $result = json_decode ($json);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
  $st=curl_exec($ch);
  error_log("first response");
  error_log($st);
  $Code = "code";
  $Message = "message";
  $AlternatePhoneNumber = "invalid";
  $AlternatePhoneNumber2 = "FAILURE";
  $arr = (json_decode($st, true));
  foreach ( $arr as $key=>$val ){
    if(strpos($key, $Message)!== false){
      if(strpos($val, $AlternatePhoneNumber)!== false){
        REFRESH_TOKEN_ID = "1000.e6c1444c8dfe5be81e2071d68c92e76b.0442c58394e29dde316f5be4057484ec";
        CLIENT_ID = "1000.KCRJ9GWGPIJZ56008726DSCMDAUI8U";
        CLIENT_SECRET = "034bc2464c3093c42b6605b6297af733557ffcc3cb";
        $accesstokenurl = "https://accounts.zoho.com/oauth/v2/token";
        error_log($accesstokenurl);
        $tokench = curl_init();
        $tokenjson = '{"grant_type":"refresh_token","refresh_token":REFRESH_TOKEN_ID,"client_id":CLIENT_ID,"client_secret":CLIENT_SECRET}';
        curl_setopt($tokench, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($tokench, CURLOPT_POSTFIELDS,$tokenjson);
        curl_setopt($tokench, CURLOPT_URL, $accesstokenurl);
        curl_setopt($tokench, CURLOPT_RETURNTRANSFER, 1);  
        $tokenst=curl_exec($tokench);
        error_log("token response");
        error_log($tokenst);
      }
    }
  }
}
?>
