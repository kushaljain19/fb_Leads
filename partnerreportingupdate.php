<?php
$access_token = "1000.1436d889b5c5ad99df44dc0bcccf3d2d.4f8bf95d4e7722022ff2964ccbfa798d";
$movies = array(
array("user_Id" => "1699841000340963453","reporting_id" => "1699841000311501787","Emp_Code" => "53666866","last_name" => "LAKSHAY YADAV","state" => "Partner Program"),
array("user_Id" => "1699841000341171805","reporting_id" => "1699841000285812943","Emp_Code" => "56965299","last_name" => "RADHE SHYAM","state" => "Partner Program"),
array("user_Id" => "1699841000341171105","reporting_id" => "1699841000311501787","Emp_Code" => "55301991","last_name" => "DEVANG BHARAT","state" => "Partner Program"));
$userd_id_param="user_Id";
$reporting_id_param="reporting_id";
$Emp_Code_param="Emp_Code";
$last_name_param="last_name";
$state_param="state";
foreach ( $movies as $movie ) {
  foreach ( $movie as $key => $value ) {
    error_log ("<dt>$key</dt><dd>$value</dd>");
    if(strpos($key, $userd_id_param)!== false){
      $recordId = $value;
    }
    if(strpos($key, $reporting_id_param)!== false){
      $reporting_id = '"'.$value.'"';
    }
    if(strpos($key, $Emp_Code_param)!== false){
      $Emp_Code = '"'.$value.'"';
    }
    if(strpos($key, $state_param)!== false){
      $state = '"'.$value.'"';
    }
    if(strpos($key, $last_name_param)!== false){
      $last_name = '"'.$value.'"';
    }
  }
  $url = "https://www.zohoapis.com/crm/v2/users/{$recordId}";
  error_log($url);
  $accesstokenparam = "Zoho-oauthtoken"." ".$access_token;
  $headers = array("Authorization: $accesstokenparam");
  $content_type = "application/json";
  //$headers->Content-type = $content_type;
  //$headers->Authorization = $accesstokenparam;
  error_log(json_encode($headers));
  $ch = curl_init();
  $param1 = '{"users":[{"reporting_to_id":';
  //$param10 = ',"reporting_to_id":';
  $reportingid = $reporting_id;
  //$param2 = ', "Emp_Code":';
  //$param3 = ', "state":';
  $param4 = ',}]}'; 
  $json = $param1.$reportingid.$param4;
  //$json = $param1.$last_name.$param10.$reportingid.$param2.$Emp_Code.$param3.$state.$param4;
  //$json = $param1.$last_name.$param2.$Emp_Code.$param3.$state.$param4;
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
            $url = "https://www.zohoapis.com/crm/v2/users/{$recordId}";
            error_log($url);
            $accesstokenparam = "Zoho-oauthtoken"." ".$access_token;
            $headers = array("Authorization: $accesstokenparam");
            $content_type = "application/json";
            error_log(json_encode($headers));
            $ch = curl_init();
            $result = json_decode ($json);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
            curl_setopt($ch, CURLOPT_URL, $url);
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
