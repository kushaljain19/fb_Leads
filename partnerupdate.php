<?php
$arr = array(1699841000340851681,1699841000340851689,1699841000340851697,1699841000340851705,1699841000340851709,1699841000340851717,1699841000340851721,1699841000340851729,1699841000340851733,1699841000340851737,1699841000340851753,1699841000340851757,1699841000340851761,1699841000340851765,1699841000340851769,1699841000340851773,1699841000340851777,1699841000340851781,1699841000340851785,1699841000340851789,1699841000340851793,1699841000340851797,1699841000340851805,1699841000340851809,1699841000340851813,1699841000340851817,1699841000340851821,1699841000340851825,1699841000340851833,1699841000340851837,1699841000340851845,1699841000340851893,1699841000362305936);
foreach ($arr as $recordId) {
  $url = "https://www.zohoapis.com/crm/v2/users/{$recordId}";
  error_log($url);
  $headers = array("Content-type: application/json");
  $headers = array("Authorization: Zoho-oauthtoken 1000.091a3842c892761a06e6cea9b55651c2.56d54394d89a7e7e9103d56794150af1");
  $ch = curl_init();
  $json = '{"users":[{"reporting_to_id":"1699841000311564761",}]}';
  $result = json_decode ($json);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
  $st=curl_exec($ch);
  error_log("first response");
  error_log($st);
}
$arr = array(1699841000340851853,1699841000340851857,1699841000340851861,1699841000340851865,1699841000340851869,1699841000340851877,1699841000340851881,1699841000340851885,1699841000340851889,1699841000340851897,1699841000340851905,1699841000340851909,1699841000340851917,1699841000340851921,1699841000340851925,1699841000340851937,1699841000340851941,1699841000340851945,1699841000340851949,1699841000340851957,1699841000340851961,1699841000340851969,1699841000340851973,1699841000340851977,1699841000340851981,1699841000340851985,1699841000340851989,1699841000340851993,1699841000341305477,1699841000341305481,1699841000341305497,1699841000341305533,1699841000341305573,1699841000341305585,1699841000341305601,1699841000341305605,1699841000363517902,1699841000363653248,1699841000364435738);
foreach ($arr as $recordId) {
  $url = "https://www.zohoapis.com/crm/v2/users/{$recordId}";
  error_log($url);
  $headers = array("Content-type: application/json");
  $headers = array("Authorization: Zoho-oauthtoken 1000.091a3842c892761a06e6cea9b55651c2.56d54394d89a7e7e9103d56794150af1");
  $ch = curl_init();
  $json = '{"users":[{"reporting_to_id":"1699841000334620401",}]}';
  $result = json_decode ($json);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
  $st=curl_exec($ch);
  error_log("first response");
  error_log($st);
}
?>
