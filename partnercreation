<?php
$access_token = "1000.2dea94883a1347af570983bfa6942153.dcc4d483f0c46aa98e81d325112700b6";
$movies = array(
array("email_id" => "55929351@5paisa.com", "last_name" => "DHADGE KANIFNATH","reporting_id" => "1699841000207001877","Emp_Code" => "55929351","state" => "Partner Program")
);
$email_id_param = "email_id";
$last_name_param = "last_name";
$userd_id_param="user_Id";
$reporting_id_param="reporting_id";
$Emp_Code_param="Emp_Code";
$state_param="state";
foreach ( $movies as $movie ) {
  foreach ( $movie as $key => $value ) {
    error_log ("<dt>$key</dt><dd>$value</dd>");
    if(strpos($key, $userd_id_param)!== false){
      $recordId = $value;
    }
    if(strpos($key, $reporting_id_param)!== false){
      $reporting_id = $value;
    }
    if(strpos($key, $Emp_Code_param)!== false){
      $Emp_Code = '"'.$value.'"';
    }
    if(strpos($key, $state_param)!== false){
      $state = '"'.$value.'"';
    }
    if(strpos($key, $email_id_param)!== false){
      $email_id = '"'.$value.'"';
    }
    if(strpos($key, $last_name_param)!== false){
      $last_name = '"'.$value.'"';
    }
  }
  $zohooneurl = "https://one.zoho.com/api/v1/orgs/655853087/users";
  $zohocrmurl = "https://one.zoho.com/api/v1/orgs/655853087/appaccounts/62042541/members";
  //$url = "https://www.zohoapis.com/crm/v2/users/{$recordId}";
  //error_log($url);
  $accesstokenparam = "Zoho-oauthtoken"." ".$access_token;
  $headers = array("Authorization: $accesstokenparam");
  $content_type = "application/json";
  //$headers->Content-type = $content_type;
  //$headers->Authorization = $accesstokenparam;
  error_log(json_encode($headers));
  $ch = curl_init();  
  $param1 = '{"users" : {"first_name" : "5P Partner","last_name" :';
  $param2 = ',"emails" : [{"email_id" : ';
  $param3 = ',}],"generate_password" : true,}}';
  $json = $param1.$last_name.$param2.$email_id.$param3;
  error_log($json);
  $result = json_decode ($json);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
  curl_setopt($ch, CURLOPT_URL, $zohooneurl);
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
        $REFRESH_TOKEN_ID = '1000.75d23c87dbfd9bb6ce22e7d6284476fe.8c667a2ecd6233fb5877f015f905f0b0';
        $CLIENT_ID = '1000.EW29NAAKKZMJ44646D0JBLMX8R6EY1';
        $CLIENT_SECRET = 'bb4461932e7a8160b0f8a906b7daba456b6ce3ffbd';
        $accesstokenurl = "https://accounts.zoho.com/oauth/v2/token?refresh_token=1000.75d23c87dbfd9bb6ce22e7d6284476fe.8c667a2ecd6233fb5877f015f905f0b0&client_id=1000.EW29NAAKKZMJ44646D0JBLMX8R6EY1&client_secret=bb4461932e7a8160b0f8a906b7daba456b6ce3ffbd&grant_type=refresh_token";
        //$grant_type = 'refresh_token';
        //error_log($accesstokenurl);
        $tokench = curl_init();
        $myObj->grant_type = $grant_type;
        $myObj->refresh_token = $REFRESH_TOKEN_ID;
        $myObj->client_id = $CLIENT_ID;
        $myObj->client_secret=$CLIENT_SECRET;
        $tokenjson = json_encode($myObj);
        curl_setopt($tokench, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($tokench, CURLOPT_URL, $accesstokenurl);
        curl_setopt($tokench, CURLOPT_RETURNTRANSFER, 1);  
        $tokenst=curl_exec($tokench);
        error_log("token response");
        error_log($tokenst);
        $access_token_param="access_token";
        $arr = (json_decode($tokenst, true));
        foreach ( $arr as $key=>$val ){
          if(strpos($key, $access_token_param)!== false){
            error_log($val);
            $access_token=$val;
            $accesstokenparam = "Zoho-oauthtoken"." ".$access_token;
            $headers = array("Authorization: $accesstokenparam");
            $content_type = "application/json";
            error_log(json_encode($headers));
            $ch = curl_init();
            $result = json_decode ($json);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
            curl_setopt($ch, CURLOPT_URL, $zohooneurl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
            $st=curl_exec($ch);
            error_log("first response");
            error_log($st);          
          }
        }
      }
    }
  }
}
?>
