<?php 
$url = "https://graph.facebook.com/v2.8/245520369242837?access_token=EAARrtz2GsKUBALd8MakhGAQprYKeucW9nZC1oXbohk1pl8V3TZBP9GAN8VIBeI1NGdPCjyRWnOIGSnBcNh7DlBVGkoGvwOoRuwdmPqhcJEZBzPAJxi65l5LaVNHsOVOler89vXylk6iBahVdFTSFh0np1jHRgrDlzx7p9qZAxgZDZD";
$headers = array("Content-type: application/json");
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
$st=curl_exec($ch); 
$result=json_decode($st,TRUE);
//echo print_r($result,true);

$FieldData = $result["field_data"];
foreach ( $FieldData as $key=>$val ){
   //print "$key = ".print_r($val,true)."<br>";
   //print $val["name"]."<br>";
   if($val["name"] == "full_name")
   {
      $name = $val["values"][0];
   }elseif($val["name"] == "email")
   {
      $email = $val["values"][0];
   }elseif($val["name"] == "phone_number")
   {
      $phone_number = substr($val["values"][0],-10);
   }elseif($val["name"] == "city")
   {
      $city = $val["values"][0];
   }else{
      $description .= $val["name"]." ".$val["values"][0]." ";
   }
}

$FormDetailUrl = "https://graph.facebook.com/v2.8/1188529894570882?access_token=EAARrtz2GsKUBALd8MakhGAQprYKeucW9nZC1oXbohk1pl8V3TZBP9GAN8VIBeI1NGdPCjyRWnOIGSnBcNh7DlBVGkoGvwOoRuwdmPqhcJEZBzPAJxi65l5LaVNHsOVOler89vXylk6iBahVdFTSFh0np1jHRgrDlzx7p9qZAxgZDZD";
$FormHeaders = array("Content-type: application/json");
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $FormHeaders);
curl_setopt($ch, CURLOPT_URL, $FormDetailUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
$st=curl_exec($ch); 
$FormDetails=json_decode($st,TRUE);
//echo print_r($FormDetails,true);
$campaign = $FormDetails["name"];
//$strZohoUrl = "https://crm.zoho.com/crm/private/xml/Leads/insertRecords";
$strZohoUrl = "api.5paisa.com/crmapi/api/preregister";
//$zoho_post_fields="scope=crmapi&newFormat=1&version=2&wfTrigger=true&authtoken=b01ef977ae5d658b4368ebe181cf5bd9&xmlData=<Leads><row no='1'><FL val='Last Name'>".$name."</FL><FL val='Email'>".$email."</FL><FL val='City'>".$city."</FL><FL val='Lead Source'>Facebook</FL><FL val='Campaign'>".$campaign."</FL><FL val='Mobile'>".$phone_number."</FL><FL val='Description'>".$description."</FL></row></Leads>";
//$zoho_post_fields="IsReg=N&LName=".$name."&Mobile=".$phone_number."&Email=".$email."&LeadSource=Facebook&LeadCampaign=".$campaign."&UrlParam=Description%3D".$description;
$zoho_post_fields="IsReg=N&LName=".urlencode($name)."&Mobile=".urlencode($phone_number)."&Email=".urlencode($email)."&LeadSource=Facebook&LeadCampaign=".urlencode($campaign)."&UrlParam=Description%3D".urlencode($description);
print $strZohoUrl."?".$zoho_post_fields;

$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch2, CURLOPT_URL, $strZohoUrl."?".$zoho_post_fields);
//curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);  
//curl_setopt($ch2, CURLOPT_TIMEOUT, 100);
//curl_setopt($ch2, CURLOPT_POST, 1);
//curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, true);
//curl_setopt($ch2, CURLOPT_POSTFIELDS, $zoho_post_fields);
$zohoResponse=curl_exec($ch2);
curl_close($ch2);

echo $zohoResponse;
$zohoResponse2=json_decode($zohoResponse,true);
//echo $zohoResponse2;
$LeadID =  $zohoResponse2["LeadId"];
$UpdateZohoUrl = "https://crm.zoho.com/crm/private/xml/Leads/updateRecords";
$updateZoho_post_fields = "scope=crmapi&newFormat=1&version=2&wfTrigger=true&authtoken=b01ef977ae5d658b4368ebe181cf5bd9&id={$LeadID}&xmlData=<Leads><row no='1'><FL val='Description'>".urlencode($description)."</FL></row></Leads>";
echo $UpdateZohoUrl;
echo $updateZoho_post_fields;
$ch3 = curl_init();
curl_setopt($ch3, CURLOPT_URL, $UpdateZohoUrl);
curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, true);  
curl_setopt($ch3, CURLOPT_TIMEOUT, 60);
curl_setopt($ch3, CURLOPT_POST, 1);
curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch3, CURLOPT_POSTFIELDS, $updateZoho_post_fields);
$UpdateResponse=curl_exec($ch3);
curl_close($ch3);
echo $UpdateResponse;

