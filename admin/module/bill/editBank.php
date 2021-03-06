
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `bank` WHERE `id` = $id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Typeห" content="text/html; charset=UTF-8" />
    <title>แก้ไขธนาคาร - ระบบจัดการบ้านยา</title>

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
    <script src="module/gallery/core.js"></script>
	<div class="container main-container" ng-controller="edit as controller">
    <div class="col-md-4 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    เมนู
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php 
                            require_once "nav.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-md-8 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    แก้ไขธนาคาร - <?php echo $row['name'] ?>
                </div>
                <div class="panel-body">
                <?php if(!isset($_POST['name']) && !isset($_POST['order'])) { ?>
                    <form action="" method="post"  enctype="multipart/form-data">
                    <div ng-init="controller.field.name = '<?php echo $row['name'] ?>';
                    controller.field.sname = '<?php echo $row['sname'] ?>';
                    controller.field.number = '<?php echo $row['number'] ?>';
                    controller.field.account_name = '<?php echo $row['account_name'] ?>';
                    controller.field.image = '<?php echo $row['icon'] ?>';
                    "></div>
                    <div class="form-group">
                        <label>ชื่อธนาคาร</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อธนาคาร" ng-model="controller.field.name">
                    </div>

                    <div class="form-group">
                        <label>ตัวย่อธนาคาร</label>
                        <input type="text" name="sname" class="form-control" id="sname" placeholder="ตัวย่อธนาคาร" ng-model="controller.field.sname">
                    </div>

                    <div class="form-group">
                        <label>เลขบัญชี</label>
                        <input type="text" name="number" class="form-control" id="number" placeholder="เลขบัญชี" ng-model="controller.field.number">
                    </div>

                    <div class="form-group">
                        <label>เจ้าของบัญชี</label>
                        <input type="text" name="account_name" class="form-control" id="account_name" placeholder="เจ้าของบัญชี" ng-model="controller.field.account_name">
                    </div>

                    <div class="form-group">
                        <label>รูป</label><br />
                        <label>(คำแนะนำ ภาพควรมีขนาดกว้าง-ยาวเท่ากัน และไม่เกิน 800px | พื้นที่ไม่เกิน 2MB)</label>
                        <img ng-src="uploads/bank/{{controller.field.image}}" class="img-responsive" alt=""><br />
                        <input type="file" accept="image/*" app-filereader name="image" id="image" ng-model="controller.field.image">
                    </div>
                    <button type="submit" ng-disabled="controller.check() == false" class="btn btn-default">ตกลง</button>
                    <div class="alert alert-danger is-hidden" id="LOGIN_ERR" style="margin-top: 2rem;" role="alert">
                        กรอกข้อมูลให้ครบถ้วน
                    </div>
                    </form>
    
                        <?php } else  { 
        
                            $target_dir = "uploads/bank/";
                            $newfilename= $_POST['sname'].".jpg";                    
                            $target_file = $target_dir . basename($newfilename);
                            $uploadOk = 1;
                            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                            // Check if image file is a actual image or fake image
                            $name = $_POST['name'];
                            $sname = $_POST['sname'];
                            $number = $_POST['number'];
                            $account_name = $_POST['account_name'];
                            if($_FILES['image']["name"] != "") {
                                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                                $image = basename($newfilename);
                                $sql = "SELECT * FROM `gallery` WHERE `id` = $id";
                                $result = $conn->query($sql);
                                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                                $sql = "UPDATE `bank` SET `name` = '$name', `sname` = '$sname',`account_name` = '$account_name',`number` = '$number',`icon` = '$image' WHERE `bank`.`id` = $id;";
                            }else {
                                $sql = "UPDATE `bank` SET `name` = '$name', `sname` = '$sname',`account_name` = '$account_name', `number` = '$number' WHERE `bank`.`id` = $id;";
                            }

                            $result = $conn->query($sql);
                            if($result) {
                                $resultTxt = "สำเร็จ";
                            }else {
                                $resultTxt = "ไม่สำเร็จ";
                            }
                            
                        ?>
    
                        <div class="is-center">
                            <h4>แก้ไขธนาคาร <?php echo $resultTxt; ?> </h4>
                              <a href="index.php?module=bill&mode=manageBank">คลิกเพื่อกลับไปยังหน้าจัดการ</a>
                        </div>
    
                        <?php }  ?>
                </div>
            </div>
		</div>
	
	</div>
</body>

</html>