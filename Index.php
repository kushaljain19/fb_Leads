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
echo print_r($result,true);
echo "<br/>";
$email='', $name='', $phone_number='',$city='',$description=''; 
//echo print_r($result["field_data"][0]["values"], true);
$FieldData = $result["field_data"];
foreach ( $FieldData as $key=>$val ){
   //print "$key = ".print_r($val,true)."<br>";
   //print $val["name"]."<br>";
   if($val["name"] == "full_name")
   {
      print "In Name";
      $name = $val["values"][0];
   }elseif($val["name"] == "email")
   {
      print "In Email";
      $email = $val["values"][0];
   }elseif($val["name"] == "phone_number")
   {
      print "In Number";
      $phone_number = $val["values"][0];
   }elseif($val["name"] == "city")
   {
      print "In City";
      $city = $val["values"][0];
   }else{
      print "In Description";
      $description .= $val["name"]."<br/>".$val["values"][0]."<br/>";
   }  
}
print "$name<br/>";
print "$email<br/>";
print "$phone_number<br/>";
print "$city<br/>";
print "$description<br/>";
