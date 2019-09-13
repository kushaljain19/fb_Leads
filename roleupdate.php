<?php
$access_token = "1000.77e4da35e0e1eb58f2d20b44b85de6e7.7f5d800b2beefa987d1bbde903e3d971";
$final_response= "";
$movies = array(
array("partner_Id"=>"600075","emp_id"=>"C165039","ccode"=>"58899117"),
array("partner_Id"=>"641025","emp_id"=>"","ccode"=>"54019008"));
$userd_id_param="partner_Id";
$role_id_param="emp_id";
$Emp_Code_param="ccode";
$reporting_id_param="reporting_id";
$last_name_param="last_name";
$state_param="state";
foreach ( $movies as $movie ) {
  foreach ( $movie as $key => $value ) {
    error_log ("<dt>$key</dt><dd>$value</dd>");
    if(strpos($key, $userd_id_param)!== false){
      $recordId = $value;
    }
    if(strpos($key, $role_id_param)!== false){
      $role_id = $value;
    }
    if(strpos($key, $Emp_Code_param)!== false){
      $Emp_Code = $value;
    }
    if(strpos($key, $state_param)!== false){
      $state = '"'.$value.'"';
    }
    if(strpos($key, $last_name_param)!== false){
      $last_name = '"'.$value.'"';
    }
    if(strpos($key, $reporting_id_param)!== false){
      $reporting_id = '"'.$value.'"';
    }
  }
$Url='https://maps.googleapis.com/maps/api/geocode/json?address='.$recordId.'&key=AIzaSyAIXeT8zui_Q_9HxCMkwQUVMYEZuSuaNTo';
if (!function_exists('curl_init')){
    die('Sorry cURL is not installed!');
}
error_log($Url);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $Url);
curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$output = curl_exec($ch);
curl_close($ch);
$search_data = json_decode($output);
$lat =  $search_data->results[0]->geometry->location->lat;
$lng =  $search_data->results[0]->geometry->location->lng;
$final_response = $final_response.'\n'.$recordId&"_".$lat."_".$lng;
}
error_log($final_response);
?>
