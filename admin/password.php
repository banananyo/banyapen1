
<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>แก้ไขรหัสผ่าน - ระบบจัดการบ้านยา</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/angular.min.js"></script>


    <link rel="stylesheet" href="css/app.css" />
    <script src="js/app.js"></script>

    
    
</head>

<body ng-controller="content as controller">
  
 
    <nav class="navbar navbar-default navbar-static-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				ระบบจัดการบ้านยา
			</a>
		</div>
        <?php 
            require_once "header.php";
        ?>
    
	</nav>
    <script src="module/page/core.js"></script>
	<div class="container main-container" ng-controller="password as controller">
		<div class="col-md-5 col-md-offset-3 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    แก้ไขหน้ารหัสผ่าน
                </div>
                <div class="panel-body">
                <?php if(!isset($_POST['oldpassword']) && !isset($_POST['password'])&& !isset($_POST['repassword'])) { ?>
                    <form action="" method="post">

                    <div class="form-group">
                        <label>รหัสผ่านเดิม</label>
                        <input type="password" name="oldpassword" class="form-control" id="name" placeholder="รหัสผ่าน" ng-model="controller.field.oldpassword" required>
                    </div>
                    
                    <div class="form-group">
                        <label>รหัสผ่านใหม่</label>
                        <input type="password" name="password" class="form-control" id="name" placeholder="รหัสผ่าน" ng-model="controller.field.password" required>
                    </div>


                    <div class="form-group">
                        <label>ยืนยันรหัสผ่าน</label>
                        <input type="password" name="repassword" class="form-control" id="name" placeholder="รหัสผ่าน" ng-model="controller.field.repassword" required>
                    </div>

                   
                    <button type="submit" ng-disabled="controller.check() == false" class="btn btn-default">ตกลง</button>
                    <div class="alert alert-danger is-hidden" id="LOGIN_ERR" style="margin-top: 2rem;" role="alert">
                        กรอกข้อมูลให้ครบถ้วน
                    </div>
                    </form>
    
                        <?php } else  { 
                            $username = $_SESSION['BANYA_ADMIN_USERNAME'];
                            $password = md5($_POST['password']);
                            $repassword = md5($_POST['repassword']);
                            $oldpassword = md5($_POST['oldpassword']);

                            $sql = "SELECT * FROM `member` WHERE `username` LIKE '$username' AND `password` LIKE '$oldpassword'";

                            $result = $conn->query($sql);
                            if($result->num_rows == 1) {
                                if($password != $repassword) {
                                    $resultTxt = "รหัสผ่านใหม่ไม่ตรงกัน";
                                }else {
                                    $sql = "UPDATE `member` SET `password` = '$password' WHERE `member`.`username` = '$username';";
                                    $result = $conn->query($sql);
                                    if($result) {
                                        $resultTxt = "สำเร็จ";
                                    }else {
                                        $resultTxt = "ไม่สำเร็จ";
                                    }
                                }
                            }else {
                                $resultTxt = "รหัสผ่านใหม่ไม่ถูกต้อง";
                            }

                            
                            
                        ?>
    
                        <div class="is-center">
                            <h4>แก้ไขรหัสผ่าน <?php echo $resultTxt; ?> </h4>
                              <a href="index.php?mode=password">คลิกเพื่อกลับไปยังหน้าจัดการ</a>
                        </div>
    
                        <?php }  ?>
                </div>
            </div>
		</div>
	
	</div>
</body>

</html>