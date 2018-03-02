<?php
$access_token = "1000.f39c97afd70070d1fe8b2bc7be1a620b.1b36a4797c7715274a3e2ec8c6c16a82";
$movies = array(
  array("user_Id" => "1699841000340851001","reporting_id" => "1699841000334764098"),
  array("user_Id" => "1699841000340851041","reporting_id" => "1699841000311564490")
);
foreach ( $movies as $movie ) {
  foreach ( $movie as $key => $value ) {
    echo "<dt>$key</dt><dd>$value</dd>";
  }
}
?>
