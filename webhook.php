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
//error_log(print("LeadGen Id".$leadgen_id));

// $form = new Lead(<LEAD_ID>);
// $form->read();
// error_log(print("LeadGen Details".$form));

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
//error_log(print_r($result,true));
$name = $result["field_data"][3]["values"][0];
$email = $result["field_data"][2]["values"][0];
$mobile = $result["field_data"][4]["values"][0];
$city = $result["field_data"][5]["values"][0];
error_log(print("Name = {$name}, Email = {$email}, Mobile = {$mobile}, City = {$city}"));
