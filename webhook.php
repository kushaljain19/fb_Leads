<?php

error_log("calling once");

error_log("testing deployment");

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
$url = "https://graph.facebook.com/v2.8/{$leadgen_id}?access_token=EAADmDVFtzhgBAIgCQ1h5xRKQiRzgi4pcbKzivZCJRGj8xq1dEioMMy2vSE6ZCZAQyEigexqDlknd6Pr0H7xjOy1pyXQ6d6eI1leUq9125autpLpa3aRjQBEIDzpqU2A12ZBVIIe3jdaTly9F5rFMjahUP5zcOdQZD";
//EAADmDVFtzhgBANi9ePToQFPL0CNrzDGg24SDtw1YdyqfITXNLtyL4jur6zPN6lKCIeyTu5vY1o40YYRzZCAiLCxKHqkZCm5VHb4noM8wZB51nx92ypfj6LdEb0WyVt9CdD5v4dGILK0C3xydUWlH0Fm1LGI66IZD";
//EAADmDVFtzhgBANi9ePToQFPL0CNrzDGg24SDtw1YdyqfITXNLtyL4jur6zPN6lKCIeyTu5vY1o40YYRzZCAiLCxKHqkZCm5VHb4noM8wZB51nx92ypfj6LdEb0WyVt9CdD5v4dGILK0C3xydUWlH0Fm1LGI66IZD
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
$findHealthInsuranceCover="health_insurance_cover";
$Pincode="pin_code";
$findHealthInsuranceCover_2="health_cover";
$findHealthInsuranceFor="health_insurance";
$findHealthInsuranceForWhom="health_insurance_for";
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
$to5lakh2="to 5";
$morethan5lakh="more_than";
$morethan5lakh2="more than";
$yes="Yes";
$no="No";
$yessmall="yes";
$nosmall="no";
      
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
      if(strpos($HealthInsuranceCovertext, $upto3lakh)!== false)
      {
         $HealthInsuranceCover = 'Up To Rs 3 Lakh';
         error_log($HealthInsuranceCovertext);
      }elseif(strpos($HealthInsuranceCovertext, $morethan5lakh)!== false)
      {
         $HealthInsuranceCover = 'More Than Rs 5 Lakh';
         error_log($HealthInsuranceCovertext);
      }elseif(strpos($HealthInsuranceCovertext, $to5lakh)!== false)
      {
         $HealthInsuranceCover = '3 To 5 Lakh Rupees';
         error_log($HealthInsuranceCovertext);
      }
   }elseif(strpos($val["name"], $findHealthInsuranceFor)!== false)
   {
      $HealthInsuranceFor = $val["values"][0];
      error_log($findHealthInsuranceFor);
   }elseif(strpos($val["name"], $findHealthInsuranceForWhom)!== false)
   {
      $HealthInsuranceFor = $val["values"][0];
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
}

//if(strpos($LeadProduct, "Health" ) !== false){
   error_log("Inside Health API");
   $url = "https://www.5paisainsurance.com/WCFResult/PolicyResult.svc/WebJson/GetQuoteByLead";
   $fields = array(
      'sumInsured' => $HealthInsuranceCover,
      'insuredMember' => $HealthInsuranceFor,
      'email' => 'revokedlord@gmail.com'/*$email*/,
      'fullName' => $name,
      'mobileNumber' => '9742934449'/*$phone_number*/,
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
   $headers = array('Content-type: application/json');
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//set the url, number of POST vars, POST data
   curl_setopt($ch,CURLOPT_URL, $url);
   curl_setopt($ch,CURLOPT_POST, 1);
   curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//execute post
   $result = curl_exec($ch);
   error_log("result9:");
   error_log($result);
   $responseData1 = new SimpleXMLElement($result);
//close connection
   curl_close($ch);
   error_log("result11:");
   error_log($responseData1);
//}else{
   //Calling CRM API to create Lead
   $strCrmApiUrl = "api.5paisa.com/crmapi/api/preregister";
   $crmapi_post_fields="IsReg=N&LName=".urlencode($name)."&Mobile=".urlencode($phone_number)."&Email=".urlencode($email)."&LeadSource=Facebook&LeadCampaign=".urlencode($campaign)."&LeadProduct=".urlencode($LeadProduct)."&UrlParam=Description%3D".urlencode($description)."%26Unbounce_ID%3D".urlencode($leadgen_id)."%26Gender%3D".urlencode($gender)."%26City%3D".urlencode($city)."%26State%3D".urlencode($state)."%26SumAssured%3D".urlencode($HealthInsuranceCover)."%26Individual/Family%3D".urlencode($HealthInsuranceFor)."%26DateOfBirth%3D".urlencode($DateofBirth)."%26NewToMarket%3D".urlencode($NewToStockMarket)."%26ExpectedBusiness%3D".urlencode($InvestmentAmount)."%26PreferredLanguage%3D".urlencode($PrefLang)."%26Pincode%3D".urlencode($PincodeValue)."%26Education%3D".urlencode($Education)."%26Profession%3D".urlencode($Professional)."%26OnlineBuyer%3D".urlencode($OnlineBuyer)."%26HowSoon%3D".urlencode($HowSoon);
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
//}
