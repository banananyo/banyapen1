var fb_login;
var Facebook;
(function(){
    $('#custom-fb-login-button').hide();
window.fbAsyncInit = function() {
FB.init({
  appId      : '844401802388467',
  cookie     : false,
  xfbml      : true,
  version    : 'v2.11'
});
  
FB.AppEvents.logPageView(); 
Facebook = FB;  
FB.getLoginStatus(function(response) {
    console.log(response);
    if(response.status === 'connected'){
        FB.api('/'+response.authResponse.userID, function (userInfo) {
            $('#facebook_id').val(userInfo.id);
            $('#custom-fb-login-button').show();
            $('#init_login_fb').hide();
        });
    } else {
        
    }
}); 
  
};

fb_login = function (){
  FB.login();
  FB.getLoginStatus(function(response) {
    console.log(response);
    if(response.status === 'connected'){
        FB.api('/'+response.authResponse.userID, function (userInfo) {
            $('<form action="loginSubmit.php" method="POST" id="facebook_login_form"><input type="hidden" value="'+userInfo.id+'" name="facebook_login" /></form>').appendTo('body').submit();
        });
    } else {
    }
}); 
}

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