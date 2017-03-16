<?php 
session_start();
require_once __DIR__ . '/Facebook/autoload.php';
$fb = new \Facebook\Facebook([
  'app_id' => '1244334662267045',
  'app_secret' => 'd47dc67891dd5960e433dc29876f8c51',
  'default_graph_version' => 'v2.8',
]);
   $permissions = []; // optional
   $helper = $fb->getRedirectLoginHelper();
   $accessToken = $helper->getAccessToken();

$request = new FacebookRequest(
  $session,
  'GET',
  '/1288988521191685'
);

$response = $request->execute();
$graphObject = $response->getGraphObject();
/* handle the result */
		 $result=json_decode($graphObject,TRUE);
		 echo $result;
		
} else {
	$loginUrl = $helper->getLoginUrl('https://leadgenyog.herokuapp.com/', $permissions);
	echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
}
