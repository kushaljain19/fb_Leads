<?php
$arr = array(1699841000340851729);
foreach ($arr as $recordId) {
  $url = "https://www.zohoapis.com/crm/v2/users/{$recordId}";
  error_log($url);
  $access_token = "1000.f39c97afd70070d1fe8b2bc7be1a620b.1b36a4797c7715274a3e2ec8c6c16a82";
  $accesstokenparam = "Zoho-oauthtoken"." ".$access_token;
  $content_type = "application/json";
  //$headers->Content-type = $content_type;
  $headers->Authorization = $accesstokenparam;
  error_log(json_encode($headers));
  $ch = curl_init();
  $param1 = '{"users":[{"reporting_to_id":';
  $reportingid = '"1699841000311564761"';
  $param2 = '}]}';
  $json = $param1.$reportingid.$param2;
  error_log($json);
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
        $REFRESH_TOKEN_ID = '1000.e6c1444c8dfe5be81e2071d68c92e76b.0442c58394e29dde316f5be4057484ec';
        $CLIENT_ID = '1000.KCRJ9GWGPIJZ56008726DSCMDAUI8U';
        $CLIENT_SECRET = '034bc2464c3093c42b6605b6297af733557ffcc3cb';
        $accesstokenurl = "https://accounts.zoho.com/oauth/v2/token?refresh_token=1000.e6c1444c8dfe5be81e2071d68c92e76b.0442c58394e29dde316f5be4057484ec&client_id=1000.KCRJ9GWGPIJZ56008726DSCMDAUI8U&client_secret=034bc2464c3093c42b6605b6297af733557ffcc3cb&grant_type=refresh_token";
        //$grant_type = 'refresh_token';
        //error_log($accesstokenurl);
        $tokench = curl_init();
        $myObj->grant_type = $grant_type;
        $myObj->refresh_token = $REFRESH_TOKEN_ID;
        $myObj->client_id = $CLIENT_ID;
        $myObj->client_secret=$CLIENT_SECRET;
        $tokenjson = json_encode($myObj);
        //error_log($tokenjson);
        //$tokenjson = '{"grant_type":$grant_type,"refresh_token":$REFRESH_TOKEN_ID,"client_id":$CLIENT_ID,"client_secret":$CLIENT_SECRET}';
        curl_setopt($tokench, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($tokench, CURLOPT_URL, $accesstokenurl);
        curl_setopt($tokench, CURLOPT_RETURNTRANSFER, 1);  
        //$tokenst=curl_exec($tokench);
        //error_log("token response");
        //error_log($tokenst);
        $access_token_param="access_token";
        $tokenst = '{"access_token":"1000.f39c97afd70070d1fe8b2bc7be1a620b.1b36a4797c7715274a3e2ec8c6c16a82","expires_in_sec":3600,"api_domain":"https://www.zohoapis.com","token_type":"Bearer","expires_in":3600000}';
        $arr = (json_decode($tokenst, true));
        foreach ( $arr as $key=>$val ){
          if(strpos($key, $access_token_param)!== false){
             error_log($val);
             $access_token=$val;
          }
        }
      }
    }
  }
}
?>
