# Facebook-Login
This is a simple Facebook login using php sdk and javascript SDK.

# Setting Up
Update your database details in the class.database.php 

<pre>
private $_host = "DB_HOST";
private $_username = "DB_USER";
private $_password = "DB_PASS";
private $_database = "DB_NAME";
</pre>

Import the sql file facebook_users.sql to your database.

Update the Facebook API in the login.php and process.php

<pre>
appId            : 'Insert-your-app-id',
</pre>

<pre>
$fb = new Facebook\Facebook([
	'app_id' => 'Insert-Your-App-Id',
	'app_secret' => 'Insert-app-secret',
	'default_graph_version' => 'v2.2',
]);
</pre>
