<?php

//Verify your webhook using $verify_token mentions while create a subscription for the app
$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];
if ($verify_token === 'abc123') {
  echo $challenge;
}

//Get response of lead realtime
$input = json_decode(file_get_contents('php://input'), true);
echo file_get_contents('php://input');


$leadgen_id = $input["entry"][0]["changes"][0]["value"]["leadgen_id"]; //get lead id
$form_id = $input["entry"][0]["changes"][0]["value"]["form_id"]; //get form id

$leadiderror = "Lead id="+$leadgen_id;
$formiderror = "Form id="+$form_id;
echo $leadiderror;
echo $formiderror;

//Fetch Lead Data using graph api while accesing the lead id as a node and access token as a parameter(This access token never expires)
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
//error_log(print_r("Facebook Response="+$st, true));
$result=json_decode($st,TRUE);
$FieldData = $result["field_data"];

//Traversing through each field and getting individual values
foreach ( $FieldData as $key=>$val ){
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


//Fetching Form Name using Form Id to use as a campaign name
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

$campaign = $FormDetails["name"]; //store form name as campaign name
$LeadProduct = "Equity"; //Set default product as Equity

//Finding Lead Product from the campign name itself
if( strpos( $campaign, "Equity" ) !== false ) {
    $LeadProduct = "Equity";
}else if( strpos( $campaign, "Mutual" ) !== false ) {
    $LeadProduct = "Mutual Fund";
}else if( strpos( $campaign, "Health" ) !== false ) {
    $LeadProduct = "Health Insurance";
}else if( strpos( $campaign, "Motor" ) !== false ) {
    $LeadProduct = "Motor Insurance";
}else if( strpos( $campaign, "Term" ) !== false ) {
    $LeadProduct = "Term Insurance";
}

//Calling CRM API to create Lead
$strCrmApiUrl = "api.5paisa.com/crmapi/api/preregister";
$crmapi_post_fields="IsReg=N&LName=".urlencode($name)."&Mobile=".urlencode($phone_number)."&Email=".urlencode($email)."&LeadSource=Facebook&LeadCampaign=".urlencode($campaign)."&LeadProduct=".urlencode($LeadProduct)."&UrlParam=Description%3D".urlencode($description)."%26Unbounce_ID%3D".urlencode($leadgen_id);
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch2, CURLOPT_URL, $strCrmApiUrl."?".$crmapi_post_fields);
$crmApiResponse=curl_exec($ch2);
curl_close($ch2);

$decodedCrmApiResponse=json_decode($crmApiResponse,true);
//echo $zohoResponse2;
$LeadID =  $decodedCrmApiResponse["LeadId"]; //LeadId from the CRM API response

//Update the description, to prevent loss when a related lead is created
$UpdateZohoUrl = "https://crm.zoho.com/crm/private/xml/Leads/updateRecords";
$updateZoho_post_fields = "scope=crmapi&newFormat=1&version=2&wfTrigger=true&authtoken=b01ef977ae5d658b4368ebe181cf5bd9&id={$LeadID}&xmlData=<Leads><row no='1'><FL val='Description'>".urlencode($description)."</FL></row></Leads>";
$ch3 = curl_init();
curl_setopt($ch3, CURLOPT_URL, $UpdateZohoUrl);
curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, true);  
curl_setopt($ch3, CURLOPT_TIMEOUT, 60);
curl_setopt($ch3, CURLOPT_POST, 1);
curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch3, CURLOPT_POSTFIELDS, $updateZoho_post_fields);
$UpdateResponse=curl_exec($ch3);
curl_close($ch3);
error_log(print_r($zohoResponse, true));
