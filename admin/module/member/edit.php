
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `member` WHERE `id` = $id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>แก้ไขสมาชิก - ระบบจัดการบ้านยา</title>

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
    <script src="module/member/core.js"></script>
	<div class="container main-container" ng-controller="edit as controller">
    <div class="col-md-4 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    เมนู
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="index.php?module=member&mode=manage" class="list-group-item active">
                            จัดการสมาชิก
                        </a>
                        <a href="index.php?module=member&mode=add" class="list-group-item">เพิ่มสมาชิก</a>
                        <a href="index.php?module=member&mode=confirm" class="list-group-item">
                            ยันยันสมาชิก
                        </a>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-md-8 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    แก้ไขสมาชิก - <?php echo $row['name'] ?>
                </div>
                <div class="panel-body">
                <?php if(!isset($_POST['name']) && !isset($_POST['price']) && !isset($_POST['stock']) && !isset($_POST['category_id'])) { ?>
                    <form action="" method="post"  enctype="multipart/form-data">
                    <div ng-init="controller.field.name = '<?php echo $row['name'] ?>';
                    controller.field.username = '<?php echo $row['username'] ?>';
                    controller.field.email = '<?php echo $row['email'] ?>';
                    controller.field.tel = '<?php echo $row['tel'] ?>';
                    controller.field.address = '<?php echo $row['address'] ?>';
                    controller.field.level = '<?php echo $row['level'] ?>';
                    controller.field.status = '<?php echo $row['status'] ?>';
                    controller.field.image = '<?php echo $row['image'] ?>';
                    "></div>
                    <div class="form-group">
                    <label>ชื่อผู้ใช้</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="ชื่อผู้ใช้" ng-model="controller.field.username">
                </div>
                <div class="form-group">
                    <label>รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control" id="name" placeholder="รหัสผ่าน" ng-model="controller.field.password">
                </div>
                <div class="form-group">
                    <label>ชื่อ</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อ" ng-model="controller.field.name">
                </div>
                <div class="form-group">
                    <label>อีเมล์</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="อีเมล์" ng-model="controller.field.email">
                </div>
                <div class="form-group">
                    <label>เบอร์โทร</label>
                    <input type="text" name="tel" class="form-control" id="tel" placeholder="เบอร์โทร" ng-model="controller.field.tel">
                </div>
                <div class="form-group">
                    <label>ที่อยู่</label>
                    <textarea type="text" name="address" class="form-control" id="address" placeholder="ที่อยู่" ng-model="controller.field.address"></textarea>
                </div>
                <div class="form-group">
                    <label>ตำแหน่ง</label>
                    <select name="level" class="form-control" id="level" ng-model="controller.field.level">
                        <option value=""> -- เลือก --</option>
                        <option value="1"> แอดมิน </option>
                        <option value="2"> สมาชิก </option>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label>สถานะ</label>
                    <select name="status" class="form-control" id="status" ng-model="controller.field.status">
                        <option value=""> -- เลือก --</option>
                        <option value="0"> ยังไม่ยืนยัน </option>
                        <option value="1"> ยินยันแล้ว </option>
                        
                    </select>
                </div>
                <div class="form-group">
                     <label>รูป</label><br/>
                     <label>(คำแนะนำ ภาพควรมีขนาดกว้าง-ยาวเท่ากัน และไม่เกิน 800px | พื้นที่ไม่เกิน 2MB)</label>
                     <img ng-src="uploads/{{controller.field.image}}" class="img-responsive" alt=""><br />
                    <input type="file" accept="image/*" app-filereader name="image" id="image" ng-model="controller.field.image">
                </div>
                <button type="submit" ng-disabled="controller.check() == false" class="btn btn-default">ตกลง</button>
                <div class="alert alert-danger is-hidden" id="LOGIN_ERR" style="margin-top: 2rem;" role="alert">
                    กรอกข้อมูลให้ครบถ้วน
                </div>
                </form>
    
                        <?php } else  { 
        
                            $target_dir = "uploads/";
                            $newfilename= date('dmYHis').".jpg";                    
                            $target_file = $target_dir . basename($newfilename);
                            $uploadOk = 1;
                            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                            // Check if image file is a actual image or fake image
                            $name = $_POST['name'];
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $address = $_POST['address'];
                            $image =  basename($newfilename);
                            $tel = $_POST['tel'];
                            $email = $_POST['email'];
                            $level = (int)$_POST['level'];
                            $status = (int)$_POST['status'];
                            $newPassword = "";
                            if($password != "") {
                                $newPassword = "`password` = '".md5($password)."'";
                            }

                            if($_FILES['image']["name"] != "") {
                                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                                $image =  basename($newfilename);
                                $sql = "UPDATE `member` SET `username` = '$username', `email` = '$email', `level` = '$level', `name` = '$name', `address` = '$address', `tel` = '$tel', `status` = '$status',`image` = '$image', $newPassword WHERE `member`.`id` = $id;";
                            }else {
                                $sql = "UPDATE `member` SET `username` = '$username', `email` = '$email', `level` = '$level', `name` = '$name', `address` = '$address', `tel` = '$tel', `status` = '$status',$newPassword WHERE `member`.`id` = $id;";
                            }
                            
                            $result = $conn->query($sql);
                            if($result) {
                                $resultTxt = "สำเร็จ";
                            }else {
                                $resultTxt = "ไม่สำเร็จ";
                            }
                            
                        ?>
    
                        <div class="is-center">
                            <h4>แก้ไขสมาชิก <?php echo $resultTxt; ?> </h4>
                              <a href="index.php?module=member&mode=manage">คลิกเพื่อกลับไปยังหน้าจัดการ</a>
                        </div>
    
                        <?php }  ?>
                </div>
            </div>
		</div>
	
	</div>
</body>

</html>