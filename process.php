<?php
session_start();
include "class.database.php";
include 'lib/Facebook/autoload.php';

$fb = new Facebook\Facebook([
	'app_id' => 'Insert-Your-App-Id',
	'app_secret' => 'Insert-app-secret',
	'default_graph_version' => 'v2.2',
]);


$helper = $fb->getJavaScriptHelper();

try {
	$accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}	


//get current user's profile information using open graph
$response = $fb->get('/me?fields=id,first_name,last_name,name,email',$accessToken); 


$user = $response->getGraphUser();

$auth_id = $user['id'];
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$email = $user['email'];


$db = Database::getInstance();
$mysqli = $db->getConnection(); 
$sql_query = "SELECT *  FROM facebook_users WHERE email='$email'";
$result = $mysqli->query($sql_query);
$total_records = $result->num_rows;

if($total_records==0) {
	//No user so add the user
	$sql = "INSERT INTO facebook_users (auth_id, first_name, last_name, email)
VALUES ('$auth_id', '$first_name', '$last_name','$email')";
	$mysqli->query($sql);
}
else {
	//user existing update the user
	$sql = "UPDATE facebook_users SET auth_id='$auth_id', first_name='$first_name', last_name='$last_name' WHERE email='$email'";
	$mysqli->query($sql);
}

$_SESSION['first_name'] = $first_name;

header("location:dashboard.php");


