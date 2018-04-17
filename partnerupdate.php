<?php
$access_token = "1000.1436d889b5c5ad99df44dc0bcccf3d2d.4f8bf95d4e7722022ff2964ccbfa798d";
$movies = array(
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=Siddharth&LName=LName&Mobile=9937518233&Email=0852siddharthjain@gmail.com&Gclid=NULL&LeadProduct=Equity&UnbouceId=NULL&PageUrl=NULL&LeadSource=NULL&LeadCampaign=NULL&UrlParam=%26ResultURL%3Dhttps%3A%2F%2Fwww.5paisa.com%2Flandingpage%2Ftrade-with-best-share-trading-company-with-lowest-fee%26Unbounce_ID%3Dundefined%26state%3DOdisha%26city%3DPatnagarh%26SouthIndianCustomer%3DNo&InsertionTime=43207.4359811343"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=NULL&LName=????? ???? ??????&Mobile=9027220333&Email=100nu.mittal@gmail.com&Gclid=NULL&LeadProduct=Equity&UnbouceId=NULL&PageUrl=NULL&LeadSource=Facebook&LeadCampaign=5Paisa_Broking_HINDI_18/12/17&UrlParam=Description%3D%26Unbounce_ID%3D2017118924972510%26Gender%3D%26City%3DMuzaffarnagar%26State%3Dup%26SumAssured%3D%26Individual%2FFamily%3D%26DateOfBirth%3D%26NewToMarket%3D%26ExpectedBusiness%3D0_-_10%2C000_rs%26PreferredLanguage%3DHindi%26Pincode%3D%26Education%3D%26Profession%3D%26OnlineBuyer%3D%26HowSoon%3D%26Phone%3D9027220333&InsertionTime=43118.8579519676"));
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
      $url = $value;
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
