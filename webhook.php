<?php
//use FacebookAds\Object\Lead;

$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

if ($verify_token === 'abc123') {
  echo $challenge;
}

$input = json_decode(file_get_contents('php://input'), true);
error_log(print_r($input, true));

$leadgen_id = $input["entry"][0]["changes"][0]["value"]["leadgen_id"];
$form_id = $input["entry"][0]["changes"][0]["value"]["form_id"];

$url = "https://graph.facebook.com/v2.8/{$leadgen_id}?access_token=EAARrtz2GsKUBALd8MakhGAQprYKeucW9nZC1oXbohk1pl8V3TZBP9GAN8VIBeI1NGdPCjyRWnOIGSnBcNh7DlBVGkoGvwOoRuwdmPqhcJEZBzPAJxi65l5LaVNHsOVOler89vXylk6iBahVdFTSFh0np1jHRgrDlzx7p9qZAxgZDZD";
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
      $phone_number = str_replace(' ', '', $val["values"][0]);
      $phone_number = substr($phone_number,-10);
   }elseif($val["name"] == "city")
   {
      $city = $val["values"][0];
   }else{
      $description .= $val["name"]." ".$val["values"][0]." ";
   }
}

$FormDetailUrl = "https://graph.facebook.com/v2.8/{$form_id}?access_token=EAARrtz2GsKUBALd8MakhGAQprYKeucW9nZC1oXbohk1pl8V3TZBP9GAN8VIBeI1NGdPCjyRWnOIGSnBcNh7DlBVGkoGvwOoRuwdmPqhcJEZBzPAJxi65l5LaVNHsOVOler89vXylk6iBahVdFTSFh0np1jHRgrDlzx7p9qZAxgZDZD";
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

$campaign = $FormDetails["name"];
$strZohoUrl = "api.5paisa.com/crmapi/api/preregister";
$zoho_post_fields="IsReg=N&LName=".urlencode($name)."&Mobile=".urlencode($phone_number)."&Email=".urlencode($email)."&LeadSource=Facebook&LeadCampaign=".urlencode($campaign)."&UrlParam=Description%3D".urlencode($description);
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch2, CURLOPT_URL, $strZohoUrl."?".$zoho_post_fields);
$zohoResponse=curl_exec($ch2);
curl_close($ch2);

error_log(print_r($zohoResponse, true));
