<?php
$access_token = "1000.1436d889b5c5ad99df44dc0bcccf3d2d.4f8bf95d4e7722022ff2964ccbfa798d";
$movies = array(
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=Y&FName=sunil&LName=kumar&Mobile=9799726638&Email=000sunnyverma.sv@gmail.com&Gclid=NULL&LeadProduct=Equity&UnbouceId=NULL&PageUrl=www.5paisa.com&LeadSource=Google Play&LeadCampaign=NULL&UrlParam=campaigntype=a&network=g&campaignid=977318541&loc_physical_ms=9061778&adsplayload=CAAgAQ&ai=CNvTMwL6nWqvoEZGXrAGTuphA5Pjh1FDx9t6D5gbmy_OligsIABABINzX1SEoAmDl8ueD1A6gAZbAib0DyAEBqQIcyCVzt4hQPqoEQ0_Q5pIGdEK8QeSbSTvswZzZcPPuWyORJCGj9gOhS3m0A-0IV34FcrCIz0NhAOPuPjftFdTFPxHeriTtGb1YEaOpWzzABPiVus61AYgFjeWC0gOgBhqwBgHYBgKAB9K_9kKIBwGQBwGoB6a-G6gHoQHYBwGgCJKLqQSwCAGxCXsSXe_YCsNDuQl7El3v2ArDQ4IUJwhoEiNGOnBla2VhOmFwcGlkPTI6Y29tLmZpdmVwYWlzYS50cmFkZQ&gclid=Cj0KCQjw7Z3VBRC-ARIsAEQifZRlIWGlLAxPSGReRu_Nm36vzxslq9GgbKlQgPGb6nLHnODM6EDltj8aAv6LEALw_wcB&conv=933388310&state=Rajasthan&city=Jaipur&InsertionTime=43207.2530628472"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=NULL&LName=santosh kumar&Mobile=8795090214&Email=0819santosh@gmail.com&Gclid=NULL&LeadProduct=Equity&UnbouceId=NULL&PageUrl=NULL&LeadSource=Facebook&LeadCampaign=5Paisa_Broking_HINDI_18/12/17&UrlParam=Description=&Unbounce_ID=2022696317748104&Gender=&City=nautanwa&State=nautanwa&SumAssured=&Individual/Family=&DateOfBirth=&NewToMarket=&ExpectedBusiness=0_-_10,000_rs&PreferredLanguage=Hindi&Pincode=&Education=&Profession=&OnlineBuyer=&HowSoon=&Phone=8795090214&InsertionTime=43122.8989209491"));
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
