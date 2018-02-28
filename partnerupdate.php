<?php

$headers = array("Content-type: application/json");
$headers = array("Authorization: Zoho-oauthtoken 1000.2db5bbc39a635ef4aed9f295b5c7a75a.70c5121754b0c11d29487f69825f0171");
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
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
$findHealthInsuranceCover="health_insurance_cover";
$Pincode="pin_code";
$Pincode2="post_code";
$findHealthInsuranceCover_2="health_cover";
$findHealthInsuranceFor="health_insurance";
$findHealthInsuranceForWhom="for_whom";
$findDateofBirth="date_of_birth";
$findDateofBirth2="Date of birth";
$EducationalQ="educational_qualification";
$Profession="employment_type";
$Online="day-to-day_stuffs_online";
$Soon="soon_would_you";
$findNewToStockMarket="invested";
$findInvestmentAmount="start_investing";
$upto3lakh="upto";
$to5lakh="to_5";
$to5lakh2="to_rs_5";
$morethan5lakh="more_than";
$morethan5lakh2="more than";
$yes="Yes";
$no="No";
$yessmall="yes";
$nosmall="no";
$AlternatePhoneNumber="_phone_number_alternate";
$AlternateNumber="";
      
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
   }elseif($val["name"] == "state")
   {      
      $state = $val["values"][0];
   }elseif($val["name"] == "gender")
   {      
      $gender = $val["values"][0];
   }elseif(strpos($val["name"], $findHealthInsuranceCover)!== false)
   {
      $HealthInsuranceCovertext = $val["values"][0];
      error_log($findHealthInsuranceCover);
      if((strpos($HealthInsuranceCovertext, $upto3lakh)!== false) ||(strpos($HealthInsuranceCovertext, $upto3lakh)!== false))
      {
         $HealthInsuranceCover = 'Up To Rs 3 Lakh';
         error_log($HealthInsuranceCovertext);
      }elseif((strpos($HealthInsuranceCovertext, $morethan5lakh)!== false) || (strpos($HealthInsuranceCovertext, $morethan5lakh2)!== false))
      {
         $HealthInsuranceCover = 'More Than Rs 5 Lakh';
         error_log($HealthInsuranceCovertext);
      }elseif((strpos($HealthInsuranceCovertext, $to5lakh)!== false) || (strpos($HealthInsuranceCovertext, $to5lakh2)!== false))
      {
         $HealthInsuranceCover = '3 To 5 Lakh Rupees';
         error_log($HealthInsuranceCovertext);
      }
   }elseif(strpos($val["name"], $AlternatePhoneNumber)!== false)
   {
      $AlternateNumber = $val["values"][0];
      error_log("$AlternatePhoneNumber");
      error_log($AlternateNumber);
   }elseif(strpos($val["name"], $findHealthInsuranceFor)!== false)
   {
      $HealthInsuranceFor = $val["values"][0];
      error_log("$findHealthInsuranceFor");
      error_log($findHealthInsuranceFor);
   }elseif(strpos($val["name"], $findHealthInsuranceForWhom)!== false)
   {
      $HealthInsuranceFor = $val["values"][0];
      error_log("$findHealthInsuranceForWhom");
      error_log($findHealthInsuranceForWhom);
   }elseif(strpos($val["name"], $findDateofBirth)!== false)
   {
      $DateofBirth = $val["values"][0];
      error_log($findDateofBirth);
   }elseif(strpos($val["name"], $findDateofBirth2)!== false)
   {
      $DateofBirth = $val["values"][0];
      error_log($findDateofBirth2);
   }elseif(strpos($val["name"], $findNewToStockMarket)!== false)
   {
      $NewToStockMarkettext = $val["values"][0];
      if(strpos($NewToStockMarkettext, $yes)!== false)
      {
         $NewToStockMarket = "No";
      }elseif(strpos($NewToStockMarkettext, $yessmall)!== false)
      {
         $NewToStockMarket = "No";
      }elseif(strpos($NewToStockMarkettext, $no)!== false)
      {
         $NewToStockMarket = "Yes";
      }elseif(strpos($NewToStockMarkettext, $nosmall)!== false)
      {
         $NewToStockMarket = "Yes";
      }
   }elseif(strpos($val["name"], $findInvestmentAmount)!== false)
   {
      $InvestmentAmount = $val["values"][0];
   }elseif(strpos($val["name"], $Pincode)!== false)
   {      
      $PincodeValue = $val["values"][0];
      error_log($Pincode);
   }elseif(strpos($val["name"], $Pincode2)!== false)
   {      
      $PincodeValue = $val["values"][0];
      error_log($Pincode2);
   }elseif(strpos($val["name"], $EducationalQ)!== false)
   {
      $Education = $val["values"][0];
      error_log($EducationalQ);
   }elseif(strpos($val["name"], $Profession)!== false)
   {
      $Professional = $val["values"][0];
      error_log($Profession);
   }elseif(strpos($val["name"], $Online)!== false)
   {
      $OnlineBuyer = $val["values"][0];
      error_log($Online);
   }elseif(strpos($val["name"], $Soon)!== false)
   {
      $HowSoon = $val["values"][0];
      error_log($Soon);
   }else{
      $description .= $val["name"]." ".$val["values"][0]." ";
   }
}  

//Fetching Form Name using Form Id to use as a campaign name
$FormDetailUrl = "https://graph.facebook.com/v2.8/{$form_id}?access_token=EAADmDVFtzhgBANi9ePToQFPL0CNrzDGg24SDtw1YdyqfITXNLtyL4jur6zPN6lKCIeyTu5vY1o40YYRzZCAiLCxKHqkZCm5VHb4noM8wZB51nx92ypfj6LdEb0WyVt9CdD5v4dGILK0C3xydUWlH0Fm1LGI66IZD";
//EAADmDVFtzhgBANi9ePToQFPL0CNrzDGg24SDtw1YdyqfITXNLtyL4jur6zPN6lKCIeyTu5vY1o40YYRzZCAiLCxKHqkZCm5VHb4noM8wZB51nx92ypfj6LdEb0WyVt9CdD5v4dGILK0C3xydUWlH0Fm1LGI66IZD
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

$PrefLang = "English"; //Set default Language as English

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
}else if( strpos( $campaign, "HEALTH" ) !== false ) {
    $LeadProduct = "Health Insurance";
}else if( strpos( $campaign, "TERM" ) !== false ) {
    $LeadProduct = "Term Insurance";
}else if( strpos( $campaign, "MOTOR" ) !== false ) {
    $LeadProduct = "Motor Insurance";
}else if( strpos( $campaign, "MUTUAL" ) !== false ) {
    $LeadProduct = "Mutual Fund";
}else if( strpos( $campaign, "health" ) !== false ) {
    $LeadProduct = "Health Insurance";
}else if( strpos( $campaign, "Health" ) !== false ) {
    $LeadProduct = "Health Insurance";
}

//Finding Language from the campign name itself
if( strpos( $campaign, "Hindi" ) !== false ) {
    $PrefLang = "Hindi";
}else if( strpos( $campaign, "Marathi" ) !== false ) {
    $PrefLang = "Marathi";
}else if( strpos( $campaign, "Bengali" ) !== false ) {
    $PrefLang = "Bengali";
}else if( strpos( $campaign, "Kannada" ) !== false ) {
    $PrefLang = "Kannada";
}else if( strpos( $campaign, "hindi" ) !== false ) {
    $PrefLang = "Hindi";
}else if( strpos( $campaign, "Gujarati" ) !== false ) {
    $PrefLang = "Gujarati";
}else if( strpos( $campaign, "BENGALI" ) !== false ) {
    $PrefLang = "Bengali";
}else if( strpos( $campaign, "KANNADA" ) !== false ) {
    $PrefLang = "Kannada";
}else if( strpos( $campaign, "MARATHI" ) !== false ) {
    $PrefLang = "Marathi";
}else if( strpos( $campaign, "GUJARATI" ) !== false ) {
    $PrefLang = "Gujarati";
}else if( strpos( $campaign, "HINDI" ) !== false ) {
    $PrefLang = "Hindi";
}else if( strpos( $campaign, "TAMIL" ) !== false ) {
    $PrefLang = "Tamil";
}else if( strpos( $campaign, "Tamil" ) !== false ) {
    $PrefLang = "Tamil";
}else if( strpos( $campaign, "TAMIL" ) !== false ) {
    $PrefLang = "Tamil";
}else if( strpos( $campaign, "tamil" ) !== false ) {
    $PrefLang = "Tamil";
}else if( strpos( $campaign, "kannada" ) !== false ) {
    $PrefLang = "Kannada";
}else if( strpos( $campaign, "Telugu" ) !== false ) {
    $PrefLang = "Telugu";
}else if( strpos( $campaign, "telugu" ) !== false ) {
    $PrefLang = "Telugu";
}else if( strpos( $campaign, "TELUGU" ) !== false ) {
    $PrefLang = "Telugu";
}

if(strpos($LeadProduct, "Health" ) !== false){
   error_log("Inside Health API");
   $url = "https://www.5paisainsurance.com/WCFResult/PolicyResult.svc/WebJson/GetQuoteByLead";
   $fields = array(
      'sumInsured' => $HealthInsuranceCover,
      'insuredMember' => $HealthInsuranceFor,
      'email' => $email,
      'fullName' => $name,
      'mobileNumber' => $phone_number,
      'pincode' => $PincodeValue,
      'city' => $city,
      'state' => $state,
      'DOB' => $DateofBirth,
      'gender' => $gender,
      'utm_Source' => 'Facebook'
   );
//url-ify the data for the POST
//foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
//rtrim($fields_string, '&');
//open connection
   error_log(implode(',', $fields));
}else{
   //Calling CRM API to create Lead
   $strCrmApiUrl = "api.5paisa.com/crmapi/api/preregister";
   $crmapi_post_fields="IsReg=N&LName=".urlencode($name)."&Mobile=".urlencode($phone_number)."&Email=".urlencode($email)."&LeadSource=Facebook&LeadCampaign=".urlencode($campaign)."&LeadProduct=".urlencode($LeadProduct)."&UrlParam=Description%3D".urlencode($description)."%26Unbounce_ID%3D".urlencode($leadgen_id)."%26Gender%3D".urlencode($gender)."%26City%3D".urlencode($city)."%26State%3D".urlencode($state)."%26SumAssured%3D".urlencode($HealthInsuranceCover)."%26Individual/Family%3D".urlencode($HealthInsuranceFor)."%26DateOfBirth%3D".urlencode($DateofBirth)."%26NewToMarket%3D".urlencode($NewToStockMarket)."%26PreferredLanguage%3D".urlencode($PrefLang)."%26Pincode%3D".urlencode($PincodeValue)."%26Education%3D".urlencode($Education)."%26Profession%3D".urlencode($Professional)."%26OnlineBuyer%3D".urlencode($OnlineBuyer)."%26HowSoon%3D".urlencode($HowSoon)."%26Phone%3D".urlencode($AlternateNumber);
   error_log("api url");
   error_log($strCrmApiUrl."?".$crmapi_post_fields);
   $ch2 = curl_init();
   curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
   curl_setopt($ch2, CURLOPT_URL, $strCrmApiUrl."?".$crmapi_post_fields);
   $crmApiResponse=curl_exec($ch2);
   error_log("third response");
   error_log($crmApiResponse);
   curl_close($ch2);
   $decodedCrmApiResponse=json_decode($crmApiResponse,true);
   $LeadID =  $decodedCrmApiResponse["LeadId"]; //LeadId from the CRM API response   
}
