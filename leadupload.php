<?php
$access_token = "1000.1436d889b5c5ad99df44dc0bcccf3d2d.4f8bf95d4e7722022ff2964ccbfa798d";
$movies = array(
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=&LName=Gunjan&Mobile=9723650102&Email=Gunjanpatel2748@gmail.com&Gclid=&LeadProduct=Equity&UnbouceId=&PageUrl=&LeadSource=Facebook&LeadCampaign=5paisa Broking_Leads Gen_English_05/04/17&UrlParam=Description%3Dplease_reconfirm_your_mobile_number.%3A%209723650102%20%26Unbounce_ID%3D272202839987594%26Gender%3D%26City%3DRajkot%26State%3D%26SumAssured%3D%26Individual%2FFamily%3D%26DateOfBirth%3D%26NewToMarket%3DYes%26PreferredLanguage%3DEnglish%26Pincode%3D%26Education%3D%26Profession%3D%26OnlineBuyer%3D%26HowSoon%3D%26Phone%3D");
$userd_id_param="user_Id";
$reporting_id_param="reporting_id";
$Emp_Code_param="Emp_Code";
$last_name_param="last_name";
$urlcode = "URL";
$state_param="state";
foreach ( $movies as $movie ) {
  foreach ( $movie as $key => $value ) {
    error_log ("<dt>$key</dt><dd>$value</dd>");
    if(strpos($key, $urlcode)!== false){
      $url = urlencode($value);
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
  error_log($url);
  $ch2 = curl_init();
  curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
  curl_setopt($ch2, CURLOPT_URL, $url);
  $crmApiResponse=curl_exec($ch2);
  error_log("first response");
  error_log($crmApiResponse);
}
?>
