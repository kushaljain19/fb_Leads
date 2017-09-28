<?php
//Fetch Lead Data using graph api while accesing the lead id as a node and access token as a parameter(This access token never expires)
$url = "https://api.5paisa.com/crmapi/api/Notification/SendSurvilinceNotification?ClientCode=59140179&msgContent=Send your friend 50 FREE trades. You also get 50 FREE trades. Refer & Earn! Check offer details here http://m.onelink.me/a42a3df9";
$headers = array("Content-type: application/json");
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL, $url);
$st=curl_exec($ch);
error_log("first response");
error_log($st);
?>
