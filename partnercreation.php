<?php
            $st = '{"status_code":201,"resource_name":"users","message":"User has been added successfully.","users":{"password":"pBE5p[nHpIEn","mail_id":"55929351@5paisa.com","href":"https://one.zoho.com/api/v1/orgs/655853087/users/663482604","zuid":"663482604"}}';
            error_log($st);          
            $arr = (json_decode($st, true));
            $status_code_param = "status_code";
            $users_param = "users";
            $users_id_param = "zuid";
            foreach ( $arr as $key=>$val ){
              if(strpos($key, $status_code_param)!== false){
                error_log($val);
                $status_code_value = $val;
              }
              if(strpos($key, $users_param)!== false){
                foreach ( $val as $key1=>$val1 ){
                  if(strpos($key1, $users_id_param)!== false){
                    error_log($val1);
                    $users_id = $val1;
                  }
                }
              }
            }
$access_token = "1000.321c4dc22d30b09b4012db1451de7e75.7e64542eb893772940061113b86b67a3";
$zohocrmurl = "https://one.zoho.com/api/v1/orgs/655853087/appaccounts/62042541/members";
$accesstokenparam = "Zoho-oauthtoken"." ".$access_token;
$headers = array("Authorization: $accesstokenparam");
$content_type = "application/json";
//$headers->Content-type = $content_type;
//$headers->Authorization = $accesstokenparam;
error_log(json_encode($headers));
$ch = curl_init();  
$param4 = '{"members" : {"role_id" : "1699841000000026008","profile_id" : "1699841000336610025","zaaid" : "62047589","zuid" :';
$param5 = '}}';
$param1 = '{"users" : {"first_name" : "5P Partner","last_name" :';
$param2 = ',"emails" : [{"email_id" : ';
$param3 = ',}],"generate_password" : true,}}';
$json = $param1.$last_name.$param2.$email_id.$param3;
$json2 = $param4.$users_id.$param5;
error_log($json2);
$result = json_decode ($json);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS,$json2);
curl_setopt($ch, CURLOPT_URL, $zohocrmurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
$st=curl_exec($ch);
error_log("first response");
error_log($st);          
?>
