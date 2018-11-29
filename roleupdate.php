<?php
$access_token = "1000.77e4da35e0e1eb58f2d20b44b85de6e7.7f5d800b2beefa987d1bbde903e3d971";
$movies = array(
array("partner_Id"=>"54802082","emp_id"=>"A202155","ccode"=>"51677566"),
array("partner_Id"=>"54802082","emp_id"=>"A202155","ccode"=>"56057945"));
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
  $url = "http://internaladmin.5paisa.in/RegistrationAPI/api/ClientRegistration/UpdateLeadOwner?ClientCode=".$Emp_Code."&NewOwner=".$role_id."&PartnerCode=".$recordId;
  error_log($url);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
  $st=curl_exec($ch);
  error_log("first response");
  error_log($st);  
}
?>
