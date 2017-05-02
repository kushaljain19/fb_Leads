<?php

error_log("calling once");

//Verify your webhook using $verify_token mentions while create a subscription for the app
$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];
if ($verify_token === 'abc123') {
   echo $challenge;
}

error_log("challenge");
error_log($challenge);
error_log("verify_token");
error_log($verify_token);

//Get response of lead realtime
$input = json_decode(file_get_contents('php://input'), true);

$leadgen_id = $input["entry"][0]["changes"][0]["value"]["leadgen_id"]; //get lead id
$form_id = $input["entry"][0]["changes"][0]["value"]["form_id"]; //get form id

error_log($leadgen_id);
error_log($form_id);

//Fetch Lead Data using graph api while accesing the lead id as a node and access token as a parameter(This access token never expires)
$url = "https://graph.facebook.com/v2.8/{$leadgen_id}?access_token=EAADmDVFtzhgBABmCC5FgwbpmldaWRnaxFYMQQuIr4kFP1BgfPvk82qZBsnQZB1avTwOg8Ta1AlCpdHGWgSmYSaaGtXG1ZCiuYuIXZAp1qYCvDlReZA2ZBdeinwSL4M3iTDYIsrYMZAkjqjLgrdvq7OZCpzoN9ZCCiIosZD";
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
error_log("first response");
error_log($st);
$result=json_decode($st,TRUE);
$FieldData = $result["field_data"];

$findHealthInsuranceCover="Health Insurance Cover";
$findHealthInsuranceFor="Health Insurance";
$findDateofBirth="date_of_birth";
$findNewToStockMarket="Prev Exp";
$findInvestmentAmount="Portfolio Size";

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
   }elseif($val["name"] == "gender")
   {
      
      $gender = $val["values"][0];
      error_log("gender");
      error_log($gender);
   }elseif(strpos($val["name"], $findHealthInsuranceCover)!== false)
   {
      $HealthInsuranceCover = $val["values"][0];
      error_log("$HealthInsuranceCover");
      error_log($HealthInsuranceCover);
   }elseif(strpos($val["name"], $findHealthInsuranceFor)!== false)
   {
      $HealthInsuranceFor = $val["values"][0];
      error_log("$HealthInsuranceFor");
      error_log($HealthInsuranceFor);
   }elseif(strpos($val["name"], $findDateofBirth)!== false)
   {
      $DateofBirth = $val["values"][0];
      error_log("$DateofBirth");
      error_log($DateofBirth);
   }elseif(strpos($val["name"], $findNewToStockMarket)!== false)
   {
      $NewToStockMarket = $val["values"][0];
      error_log("$NewToStockMarket");
      error_log($NewToStockMarket);
   }elseif(strpos($val["name"], $findInvestmentAmount)!== false)
   {
      $InvestmentAmount = $val["values"][0];
      error_log("$InvestmentAmount");
      error_log($InvestmentAmount);
   }else{
      $description .= $val["name"]." ".$val["values"][0]." ";
   }
}  

//Fetching Form Name using Form Id to use as a campaign name
$FormDetailUrl = "https://graph.facebook.com/v2.8/{$form_id}?access_token=EAADmDVFtzhgBABmCC5FgwbpmldaWRnaxFYMQQuIr4kFP1BgfPvk82qZBsnQZB1avTwOg8Ta1AlCpdHGWgSmYSaaGtXG1ZCiuYuIXZAp1qYCvDlReZA2ZBdeinwSL4M3iTDYIsrYMZAkjqjLgrdvq7OZCpzoN9ZCCiIosZD";
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
error_log("second response");
error_log($st);
$FormDetails=json_decode($st,TRUE);

$campaign = $FormDetails["name"]; //store form name as campaign name
$LeadProduct = "Equity"; //Set default product as Equity

error_log("campaign name");
error_log($campaign);

//Finding Lead Product from the campign name itself
if( strpos( $campaign, "Equity" ) !== false ) {
    $LeadProduct = "Equity";
}else if( strpos( $campaign, "Mutual" ) !== false ) {
    $LeadProduct = "Mutual Fund";
}else if( strpos( $campaign, "health" ) !== false ) {
    $LeadProduct = "Health Insurance";
}else if( strpos( $campaign, "Health" ) !== false ) {
    $LeadProduct = "Health Insurance";
}else if( strpos( $campaign, "motor" ) !== false ) {
    $LeadProduct = "Motor Insurance";
}else if( strpos( $campaign, "Motor" ) !== false ) {
    $LeadProduct = "Motor Insurance";
}else if( strpos( $campaign, "term" ) !== false ) {
    $LeadProduct = "Term Insurance";
}else if( strpos( $campaign, "Term" ) !== false ) {
    $LeadProduct = "Term Insurance";
}

//Calling CRM API to create Lead
$strCrmApiUrl = "api.5paisa.com/crmapi/api/preregister";
$crmapi_post_fields="IsReg=N&LName=".urlencode($name)."&Mobile=".urlencode($phone_number)."&Email=".urlencode($email)."&LeadSource=Facebook&LeadCampaign=".urlencode($campaign)."&LeadProduct=".urlencode($LeadProduct)."&UrlParam=Description%3D".urlencode($description)."%26Unbounce_ID%3D".urlencode($leadgen_id);
error_log("post url");
error_log($strCrmApiUrl."?".$crmapi_post_fields);
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch2, CURLOPT_URL, $strCrmApiUrl."?".$crmapi_post_fields);
$crmApiResponse=curl_exec($ch2);
error_log("third response");
error_log($crmApiResponse);
curl_close($ch2);

$decodedCrmApiResponse=json_decode($crmApiResponse,true);
//echo $zohoResponse2;
$LeadID =  $decodedCrmApiResponse["LeadId"]; //LeadId from the CRM API response

//Update the description, to prevent loss when a related lead is created
$UpdateZohoUrl = "https://crm.zoho.com/crm/private/xml/Leads/updateRecords";
$updateZoho_post_fields = "scope=crmapi&newFormat=1&version=2&wfTrigger=true&authtoken=b01ef977ae5d658b4368ebe181cf5bd9&id={$LeadID}&xmlData=<Leads><row no='1'><FL val='Description'>".urlencode($description)."</FL><FL val='Gender'>".urlencode($gender)."</FL></row></Leads>";
$ch3 = curl_init();
curl_setopt($ch3, CURLOPT_URL, $UpdateZohoUrl);
curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, true);  
curl_setopt($ch3, CURLOPT_TIMEOUT, 60);
curl_setopt($ch3, CURLOPT_POST, 1);
curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch3, CURLOPT_POSTFIELDS, $updateZoho_post_fields);
$UpdateResponse=curl_exec($ch3);
error_log("fourth response");
error_log($UpdateResponse);
curl_close($ch3);
error_log(print_r($zohoResponse, true));
