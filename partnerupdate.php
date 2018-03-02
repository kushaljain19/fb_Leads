<?php
$arr = array(1699841000340851729,1699841000340851733);
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
  $AlternatePhoneNumber = "invalid";
  $AlternatePhoneNumber2 = "FAILURE";
  $result=json_decode($st,TRUE);
  error_log($result);
  $FieldData = $result["field_data"];
  error_log($FieldData);
  foreach ( $FieldData as $key=>$val ){
    if($val["name"] == "full_name"){
    }
    elseif(strpos($val["name"], $AlternatePhoneNumber)!== false){
      error_log($AlternateNumber);
    }
    elseif(strpos($val["name"], $AlternatePhoneNumber2)!== false){
      error_log($AlternatePhoneNumber2);
    }
  }
}
?>
