<?php

//Verify your webhook using $verify_token mentions while create a subscription for the app
$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];
if ($verify_token === 'abc123') {
  echo $challenge;
}
