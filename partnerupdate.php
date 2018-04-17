<?php
$access_token = "1000.1436d889b5c5ad99df44dc0bcccf3d2d.4f8bf95d4e7722022ff2964ccbfa798d";
$movies = array(
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=&LName=ROCKEY KUMAR&Mobile=7814077263&Email=127ROCKEY@GMAIL.COM&Gclid=&LeadProduct=SIP&UnbouceId=&PageUrl=&LeadSource=CleverTAP&LeadCampaign=&UrlParam=Campaign%3DCTP_inaction"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=&LName=Rakesh Patidar&Mobile=9617251047&Email=12rakesh123@gmail.com&Gclid=&LeadProduct=Equity&UnbouceId=&PageUrl=&LeadSource=Facebook&LeadCampaign=5Paisa_Broking_HINDI_18/12/17&UrlParam=Description%3D%26Unbounce_ID%3D2015619065122496%26Gender%3D%26City%3DBhopal%26State%3Dmp%26SumAssured%3D%26Individual%2FFamily%3D%26DateOfBirth%3D%26NewToMarket%3D%26ExpectedBusiness%3D0_-_10%2C000_rs%26PreferredLanguage%3DHindi%26Pincode%3D%26Education%3D%26Profession%3D%26OnlineBuyer%3D%26HowSoon%3D%26Phone%3D7987127736"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=&LName=Surendra Prasad Tiwari&Mobile=9503113208&Email=15srinfo@gmail.com&Gclid=&LeadProduct=Equity&UnbouceId=&PageUrl=&LeadSource=Facebook&LeadCampaign=5Paisa_Broking_HINDI_18/12/17&UrlParam=Description%3D%26Unbounce_ID%3D2017251781625891%26Gender%3D%26City%3DBoisar%26State%3DMaharashtra%26SumAssured%3D%26Individual%2FFamily%3D%26DateOfBirth%3D%26NewToMarket%3D%26ExpectedBusiness%3D10%2C000_-_25%2C000_rs%26PreferredLanguage%3DHindi%26Pincode%3D%26Education%3D%26Profession%3D%26OnlineBuyer%3D%26HowSoon%3D%26Phone%3D9503113208"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=P.SEETHARAMIREDDY&LName=LName&Mobile=9000666807&Email=17OCT1963@GMAIL.COM&Gclid=&LeadProduct=Equity&UnbouceId=&PageUrl=&LeadSource=&LeadCampaign=&UrlParam=utm_source%3Dgoogle%26utm_medium%3Dcpc%26utm_campaign%3DGDN_Broking_Managed_Placements%26utm_device%3Dc%26utm_term%3D%26network%3Dd%26campaignid%3D854993173%26adgroupid%3D42356648574%26keyword%3D%26matchtype%3D%26placement%3Dapnaplan.com%26device%3Dc%26creative%3D200231406916%26adposition%3Dnone%26targetid%3D%26random%3D6508574121826309313%26gclid%3DEAIaIQobChMItPLti6O72AIVR9OOCh1W8wAhEAEYASAAEgIl6vD_BwE%26ef_id%3DWkszFwAAALDOU2gV%3A20180103073048%3As%26ResultURL%3Dhttps%3A%2F%2Fwww.5paisa.com%2Flanding%2Fopen-online-trading-account-and-trade-in-one-hour%26Unbounce_ID%3D8bc448dc-2ad2-48d2-ac2a-8fb0ad64f365%26state%3DTelangana%26city%3DHyderabad"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=&LName=Binod Kumar&Mobile=9534053464&Email=1986binodkumar@gmail.com&Gclid=&LeadProduct=Equity&UnbouceId=&PageUrl=&LeadSource=Facebook&LeadCampaign=5Paisa_Broking_HINDI_03/01/18-Lookalike&UrlParam=Description%3Dq.3%29_please_reconfirm_your_mobile_no.%209534053464%20%26Unbounce_ID%3D110182463089876%26Gender%3D%26City%3Dmathura%26State%3Dbihar%26SumAssured%3D%26Individual%2FFamily%3D%26DateOfBirth%3D%26NewToMarket%3D%26ExpectedBusiness%3D0_-_10%2C000_rs%26PreferredLanguage%3DHindi%26Pincode%3D%26Education%3D%26Profession%3D%26OnlineBuyer%3D%26HowSoon%3D%26Phone%3D"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=&LName=Basant Kumar Bihari&Mobile=7970511911&Email=1990basant@gmail.com&Gclid=&LeadProduct=Equity&UnbouceId=&PageUrl=&LeadSource=Facebook&LeadCampaign=5paisa Broking_Leads Gen_Hindi_02/02/18&UrlParam=Description%3D%26Unbounce_ID%3D1886566611582823%26Gender%3D%26City%3Dgopalganj%26State%3DBihar%26SumAssured%3D%26Individual%2FFamily%3D%26DateOfBirth%3D%26NewToMarket%3D%26PreferredLanguage%3DHindi%26Pincode%3D%26Education%3D%26Profession%3D%26OnlineBuyer%3D%26HowSoon%3D%26Phone%3D"),
array("URL"=>"api.5paisa.com/crmapi/api/preregister?IsReg=N&FName=&LName=RAHUL OSCAR&Mobile=8981734051&Email=1995.RG18@GMAIL.COM&Gclid=&LeadProduct=mutual fund&UnbouceId=&PageUrl=&LeadSource=CleverTAP&LeadCampaign=&UrlParam=Campaign%3DCTP_inaction%26LeadSubStatus%3DLead%20Registration"));
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
