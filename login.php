<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Facebook Login page</title>
</head>

<body>
	<a href="javascript:void(0)" rel="facebook-connect" class="facebook-connect"><img src="loginwithfacebook.png"></a>


<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : 'Insert-your-app-id',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.2',
	  cookie		   : true,
	  oauth		       : true,
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
	$( ".facebook-connect" ).click(function() {
		FB.login(function(response){
		   if(response.status=='connected') {
			   window.location.href='process.php';	                       
		   }
		}, {scope: "email"});
	});
</script>

</body>
</html>
