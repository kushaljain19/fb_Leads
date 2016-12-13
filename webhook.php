<?php
use FacebookAds\Object\Lead;

$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

if ($verify_token === 'abc123') {
  echo $challenge;
}

$input = json_decode(file_get_contents('php://input'), true);
error_log(print_r($input, true));

$leadgen_id = $input["entry"][0]["changes"][0]["value"]["leadgen_id"];
error_log(print("LeadGen Id".$leadgen_id,true));
//
//$form = new Lead(<LEAD_ID>);
//$form->read();
//error_log(print("LeadGen Details".$form));
