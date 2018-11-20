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
<body>
<?php 
    if(isset($_POST['register'])){
        require_once('connect.php');
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $certificate_1 = $_FILES['certificate_1'];
            
        // $avartar=$_POST['avartar'];
        $sqlString = "SELECT TRUE FROM `member` WHERE `username`='$username' OR `email`='$email'";
        $checkUserExists = $conn->query($sqlString);
        if($checkUserExists->fetch_assoc()){
            echo "<script type='text/javascript'>alert('ไม่สามารถใช้ชื่อผู้ใช้หรืออีเมลล์นี้ได้');</script>";
        } else {
            include('utils/image_upload.php');
            $cer_1_file = upload("admin/uploads/certificate/", $certificate_1);
            if ($cer_1_file != null && $cer_2_file != null) {
                // status = 0 -> non approved
                // status = 1 -> approved
                $registered = $conn->query("INSERT INTO `member`(`username`, `password`, `email`, `name`, `address`, `tel`, `image`, `level`, `status`, `certificate_1`) ".
                "VALUES ('$username', '$password', '$email', '$name', '$address', '$tel', '', 1, 0, '$cer_1_file')");
                if($registered) {
                    echo "<script type='text/javascript'>alert('ดำเนินการสมัครสมาชิกเรียบร้อย กรุณารอการยืนยันตัวตนจากแอดมินค่ะ');window.location.href=window.location.href;</script>";
                } else {
                    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาด โปรดแจ้งแอดมิน');window.location.href=window.location.href;</script>";
                }
            } else {
                echo '<script>alert("การสมัครไม่สำเร็จ ไม่สามารถอัพโหลดรูปภาพได้ กรุณาตรวจสอบอีกครั้ง หรือติดต่อเจ้าหน้าที่");</script>';
            }
        }
        
        $conn->close();
    }
?>
 <div class="container">
        <div class="card card-container">
            
            <div align="center"><img src="images/logo_new2.jpg" class="img-responsive"/></div>
            <h2>สมัครสมาชิก</h2>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="" method="POST" onsubmit="return validateForm()" id="registerForm" enctype="multipart/form-data">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="username" name="username" class="form-control" placeholder="ชื่อผู้ใช้ (ใช้เพื่อ login)" required autofocus>
                <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
                <input type="password" id="re_enter_password" name="re_enter_password" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
                <input type="text" id="name" name="name" class="form-control" placeholder="ชื่อ - สกุล" required>
                <input type="text" id="email" name="email" class="form-control" placeholder="อีเมล" required>
                <input type="text" id="tel" name="tel" class="form-control" placeholder="เบอร์โทรศัพท์" required>
                <textarea id="address" name="address" class="form-control" placeholder="ที่อยู่" required style="margin-bottom: 10px;"></textarea>

                <div class="input-group">
                    <label for="certificate_1"><b>อัพโหลดไฟล์รูป</b><br/>ใบอนุญาตขายยา, ใบประกอบวิชาชีพ, ใบอนุญาตประกอบกิจการสถานพยาบาล, ใบประกอบโรคศิลปะ (อย่างใดอย่างหนึ่ง)</label>
                    <input type="file" id="certificate_1" name="certificate_1" class="form-control" style="height: 45px; margin-bottom: 10px" placeholder="ใบอนุญาตขายยา" required />
                </div>
                
                <!-- <input type="file" id="avartar" name="avartar" class="form-control" placeholder="รูป" required> -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="48%">
                            <a href="index.php" class="btn btn-lg btn-primary clickable" style="width: 100%;margin-bottom: 10px;">ยกเลิก</a>
                        </td>
                        <td >
                            
                        </td>
                        <td  width="48%">
                            <button class="btn btn-lg btn-signin clickable" style="color: white;" type="submit" name="register">สมัครสมาชิก</button>
                        </td>
                    </tr>
                </table>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script>
        
        function validateForm() {
            var form = new Object();
            form.username = document.forms["registerForm"]["username"].value;
            form.password = document.forms["registerForm"]["password"].value;
            form.re_enter_password = document.forms["registerForm"]["re_enter_password"].value;
            form.name = document.forms["registerForm"]["name"].value;
            form.email = document.forms["registerForm"]["email"].value;
            form.tel = document.forms["registerForm"]["tel"].value;
            form.address = document.forms["registerForm"]["address"].value;
            form.certificate_1 = document.forms["registerForm"]["certificate_1"].value;
            console.log(form);
            Object.values(form).some(function(item) {
                console.log(item);
                if(isNullOrEmpty(item)) {
                    return false;
                }
            });

            var regex = /[^A-Za-z0-9_]/;

            if(form.username.match(regex)) {
                return false;
            }
            if(form.password !== form.re_enter_password) {
                return false;
            }

            // TODO check if username exitst

            return true;
        }

        function isNullOrEmpty(value) {
            return (value ==="" || !value);
        }
    </script>
</body>
</html>