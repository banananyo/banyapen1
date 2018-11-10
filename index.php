<?php 
    if(!isset($_SESSION)) {
        ob_start();
        session_start();
    } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>บ้านยาเป็นหนึ่ง</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="favicon.png" />
<script src="js/jquery-1.11.1.min.js"></script>
<style type="text/css">

body, html {
    height: 100%;
	background-color:#eaeaea;
}

.card-container.card {
    max-width: 450px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #FFFFFF;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputUsername,
.form-signin #inputPassword {
    direction: ltr;
    height: 35px;
    font-size: 14px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: #0c5d25;
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 400;
    font-size: 12px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

</style>
</head>
<?php if(isset($_SESSION['login_user'])) {
    header("Location: home.php");
    // unset($_SESSION['login_user']);
}?>
<body>
<?php 
    if(isset($_POST['username']) && isset($_POST['password'])){
        require_once('connect.php');
        $query_user = "SELECT `id`, `username`, `email`, `level`,`name`, `facebook_token`,`image`, `status` FROM `member` AS `m` WHERE `m`.`username`=? AND `m`.`password`=?";
        $stmt = $conn->prepare($query_user);
        $stmt->bind_param('ss', $_POST['username'],  md5($_POST['password']));
        $stmt->execute();
        $stmt->store_result();
        $numrows = $stmt->num_rows;
        $stmt->bind_result($id, $username, $email, $level, $name, $facebook_token, $image, $status);

        
        if ($stmt->fetch() && $numrows > 0 && $id != null && $status != 0) {
            //echo 'found';
            $_SESSION['login_user']['id'] = $id;
            $_SESSION['login_user']['username'] = $username;
            $_SESSION['login_user']['email'] = $email;
            $_SESSION['login_user']['level'] = $level;
            $_SESSION['login_user']['name'] = $name;
            $_SESSION['login_user']['facebook_token'] = $facebook_token;
            $_SESSION['login_user']['image'] = $image;
            echo "<script type='text/javascript'>window.location.href='home.php';</script>";
        }else if($status == 0) {
            echo "<script type='text/javascript'>alert('ชื่อผู้ใช้ยังไม่ได้รับการยืนยันจากแอดมิน');window.location.href=window.location.href;</script>";
        }else {
            //echo 'null';
            echo "<script type='text/javascript'>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');window.location.href=window.location.href;</script>";
        }
        
        $stmt->close();
        $conn->close();
    }
?>
 <div class="container">
        <div class="card card-container">
            
            <div align="center"><img src="images/logo_new2.jpg" class="img-responsive"/></div>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="loginSubmit.php" method="POST" >
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="padding-right:10px;">
                            <button class="btn btn-lg btn-primary btn-block btn-signin clickable" type="submit" name="normal_login">เข้าสู่ระบบ</button>
                        </td>
                        <td style="padding-left:10px;">
                            <a href="register.php"><button class="btn btn-lg btn-primary btn-block btn-signin clickable" type="button">สมัครสมาชิก</button></a>
                            <!-- <a href="register.php"><button class="btn btn-lg btn-primary btn-block btn-signin clickable" type="button">สมัครสมาชิก</button></a> -->
                        </td>
                    </tr>
                </table>
                <div align="center">
                    <a onclick="fb_login()" class="clickable" id="init_login_fb"><img src="images/fb-login-btn.png" class="img-responsive" /></a>
                    <div id="custom-fb-login-button" class="fb-login-button" data-max-rows="1" data-size="large" 
                    data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"
                    onlogin="fb_login()" ></div>
                </div>
                
            </form><!-- /form -->
            <input type="hidden" id="facebook_id" name="facebook_id" class="form-control" placeholder="facebokk_id">
        </div><!-- /card-container -->
    </div><!-- /container -->
    
<script type="text/javascript" src="js/fb_script.js"></script>
</body>
</html>