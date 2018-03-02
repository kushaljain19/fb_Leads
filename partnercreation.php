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
                error_log($val);
                $status_code_value = $val;
                $arr1 = (json_decode($val, true));
                foreach ( $arr1 as $key=>$val ){
                  if(strpos($key, $users_id_param)!== false){
                    error_log($val);
                    $users_id = $val;
                  }
                }
              }
            }
          
?>
