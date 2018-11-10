<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>บ้านยาเป็นหนึ่ง</title>
<meta name="Keywords" content="บ้านยาเป็นหนึ่ง">
<link rel="icon" href="logo-1.png" type="image/x-icon">
<?php
    if(isset($_POST['normal_login'])){
        require_once('connect.php');
        $query_user = "SELECT id, username, email, level, name, facebook_token, image, status FROM `member` AS `m` WHERE `m`.`username`=? AND `m`.`password`=?";
        $stmt = $conn->prepare($query_user);
        $stmt->bind_param('ss', $_POST['username'],  md5($_POST['password']));
        $stmt->execute();
        $stmt->store_result();
        $numrows = $stmt->num_rows;
        $stmt->bind_result($id, $username, $email, $level, $name, $facebook_token, $image, $status);
        $stmt->fetch();
        if($numrows > 0 && $id != null && $status==0) {
            echo "<script type='text/javascript'>alert('คุณได้ทำการสมัครสมาชิกแล้ว แต่ยังไม่ได้รับการอนุมัติ กรุณารอการยืนยันตัวตนจากแอดมินค่ะ');window.location.href='index.php';</script>";
        }
        else if ($numrows > 0 && $id != null && $status==1) {
            //echo 'found';
            $_SESSION['login_user']['id'] = $id;
            $_SESSION['login_user']['username'] = $username;
            $_SESSION['login_user']['email'] = $email;
            $_SESSION['login_user']['level'] = $level;
            $_SESSION['login_user']['name'] = $name;
            // $_SESSION['login_user']['facebook_token'] = $facebook_token;
            $_SESSION['login_user']['image'] = $image;
            echo "<script type='text/javascript'>window.location.href='home.php';</script>";
        }
        else {
            //echo 'null';
            echo "<script type='text/javascript'>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');window.location.href='index.php';</script>";
        }
        
        $stmt->close();
        $conn->close();
    } else if(isset($_POST['facebook_login'])){
        require_once('connect.php');
        // facebook_token = facebook user id
        $query_user = "SELECT id, username, email, level, name, facebook_token, image, status FROM `member` AS `m` WHERE `m`.`facebook_token`=?";
        $stmt = $conn->prepare($query_user);
        $stmt->bind_param('s',  $_POST['facebook_login']);
        $stmt->execute();
        $stmt->store_result();
        $numrows = $stmt->num_rows;
        $stmt->bind_result($id, $username, $email, $level, $name, $facebook_token, $image, $status);
        $stmt->fetch();
        if($numrows > 0 && $id != null && $status==0) {
            echo "<script type='text/javascript'>alert('คุณได้ทำการสมัครสมาชิกแล้ว แต่ยังไม่ได้รับการอนุมัติ กรุณารอการยืนยันตัวตนจากแอดมินค่ะ');window.location.href='index.php';</script>";
        }
        else if ($numrows > 0 && $id != null && $status==1) {
            //echo 'found';
            $_SESSION['login_user']['id'] = $id;
            $_SESSION['login_user']['username'] = $username;
            $_SESSION['login_user']['email'] = $email;
            $_SESSION['login_user']['level'] = $level;
            $_SESSION['login_user']['name'] = $name;
            $_SESSION['login_user']['facebook_token'] = $id;
            $_SESSION['login_user']['image'] = $image;
            echo "<script type='text/javascript'>window.location.href='home.php';</script>";
        }else {
            //echo 'null';
            echo "<script type='text/javascript'>alert('บัญชี Facebook ของท่านยังไม่เชื่อมต่อเข้ากับเว็บไซต์ กรุณาทำการสมัครสมาชิกก่อนค่ะ');window.location.href='register_facebook.php';</script>";
        }
        
        $stmt->close();
        $conn->close();
    } else {
        // print_r($_POST);
        echo '<script type="text/javascript">window.location.href="index.php"</script>';
    }
?>
<body></body>
</html>