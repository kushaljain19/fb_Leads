<?php

error_log("calling Zoho bulk response once");

error_log("testing deployment");


//Get response of lead realtime
$input = json_decode(file_get_contents('php://input'), true);
error_log("Input : ");
error_log($input);
?>
