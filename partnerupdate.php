<?php
$access_token = "1000.1436d889b5c5ad99df44dc0bcccf3d2d.4f8bf95d4e7722022ff2964ccbfa798d";
$movies = array(
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=&LName=SAURABH KATIYAR&Mobile=9911584762&Email=100RABH.DTU@GMAIL.COM&Gclid=&LeadProduct=SIP&UnbouceId=&PageUrl=&LeadSource=CleverTAP&LeadCampaign=&UrlParam=Campaign%3DCTP_inaction&InsertionTime=43207.2108844907"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=&LName=VIKRAM SINGH&Mobile=9462283258&Email=10EJIEE063@GMAIL.COM&Gclid=&LeadProduct=SIP&UnbouceId=&PageUrl=&LeadSource=CleverTAP&LeadCampaign=&UrlParam=Campaign%3DCTP_inaction&InsertionTime=43207.2149221875"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=NAVEEN&LName=LName&Mobile=9896385505&Email=1234@GMAIL.COM&Gclid=&LeadProduct=Equity&UnbouceId=&PageUrl=&LeadSource=&LeadCampaign=&UrlParam=%2526ResultURL%253Dhttps%253A%252F%252Fwww.5paisa.com%252Flanding%252Fself-research%2526Unbounce_ID%253D89ace44b-9263-43b1-a1cf-584c67b4786a%2526state%253D%2526city%253D%2526OwnerEmpCode%253DC156934%26ResultURL%3Dhttps%3A%2F%2Fwww.5paisa.com%2Flanding%2Fself-research%26Unbounce_ID%3D89ace44b-9263-43b1-a1cf-584c67b4786a%26state%3D%26city%3D%26OwnerEmpCode%3DC156934&InsertionTime=43207.4409226852"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=NAVEEN&LName=LName&Mobile=9896385505&Email=1234@TEST.COM&Gclid=&LeadProduct=Equity&UnbouceId=&PageUrl=&LeadSource=&LeadCampaign=&UrlParam=%26ResultURL%3Dhttps%3A%2F%2Fwww.5paisa.com%2Flanding%2Fself-research%26Unbounce_ID%3D89ace44b-9263-43b1-a1cf-584c67b4786a%26state%3D%26city%3D%26OwnerEmpCode%3DC156934&InsertionTime=43207.4406193287"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=&LName=Vijaysingh Thakur&Mobile=9765996112&Email=123vijaythakur@gmail.com&Gclid=&LeadProduct=Equity&UnbouceId=&PageUrl=&LeadSource=Facebook&LeadCampaign=5paisa_Broking_MARATHI_27/12/17&UrlParam=Description%3D%3F%3F%3F%3F%3F_%3F%3F%3F%3F%3F%3F_%3F%3F%3F%3F%3F%3F_%3F%3F%3F%3F%3F%3F_%3F%3F%3F%3F%3F%3F_%3F%3F%3F%3F%3F%3F_%3F%3F%3F_%28please_reconfirm_your_mobile_number%29%3A%209765996112%20%26Unbounce_ID%3D1747314415575285%26Gender%3D%26City%3DYavatmal%26State%3Dmaharashtra%26SumAssured%3D%26Individual%2FFamily%3D%26DateOfBirth%3D%26NewToMarket%3D%26ExpectedBusiness%3D1_rs_-_10%2C000_rs%26PreferredLanguage%3DMarathi%26Pincode%3D%26Education%3D%26Profession%3D%26OnlineBuyer%3D%26HowSoon%3D%26Phone%3D&InsertionTime=43117.7463951389"));
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
