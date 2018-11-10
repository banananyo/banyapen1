<?php 
if(!isset($_SESSION)) {
    session_start();
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>บ้านยาเป็นหนึ่ง</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.11.1.min.js"></script>
</head>
<body>
<div style="width: 100%"><center><h1>กำลังออกจากระบบ . . .</h1></center></div>
<?php if($_SESSION['login_user']['facebook_token']){ ?>
<script>
(function(){

    window.fbAsyncInit = function() {
    FB.init({
    appId      : '844401802388467',
    cookie     : true,
    xfbml      : true,
    version    : 'v2.11'
    });
    
    FB.AppEvents.logPageView();   
    // Facebook = FB;
    FB.getLoginStatus(function(response) {
        console.log(response);
        if(response.status === 'connected'){
            FB.api('/'+response.authResponse.userID, function (userInfo) {
                // console.log(userInfo);
                FB.logout();
                window.location.href="logout_PHP.php";
                // $('<form action="loginSubmit.php" method="POST" id="facebook_login_form"><input type="hidden" value="'+userInfo.id+'" name="facebook_login" /></form>').appendTo('body').submit();
                // sessionStorage.setItem("user_name", userInfo.name);
                // sessionStorage.setItem("user_id", userInfo.id);
            });
        } else {
            // sessionStorage.removeItem("user_name");
            // sessionStorage.removeItem("user_id");
        }
    }); 
    
    };


    $("#fb-logout-button").on('click', function(){
        Facebook.logout();
        window.location.href=window.location.href;
    });

    (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
})();


</script>
<?php 
}
else {
    echo '<script>window.location.href="logout_PHP.php";</script>';
}
?>
</body>
</html>