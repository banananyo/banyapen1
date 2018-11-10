
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `gallery` WHERE `id` = $id";
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
    <title>แก้ไขรูปภาพ - ระบบจัดการบ้านยา</title>

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
                        <a href="index.php?module=gallery&mode=manage" class="list-group-item active">
                            จัดการรูปภาพ
                        </a>
                        <a href="index.php?module=gallery&mode=add" class="list-group-item">เพิ่มรูปภาพ</a>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-md-8 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    แก้ไขรูปภาพ - <?php echo $row['name'] ?>
                </div>
                <div class="panel-body">
                <?php if(!isset($_POST['name']) && !isset($_POST['order'])) { ?>
                    <form action="" method="post"  enctype="multipart/form-data">
                    <div ng-init="controller.field.name = '<?php echo $row['name'] ?>';
                    controller.field.order = <?php echo $row['order'] ?>;
                    controller.field.image = '<?php echo $row['image'] ?>';
                    "></div>
                    <div class="form-group">
                        <label>ชื่อรูปภาพ</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อรูปภาพ" ng-model="controller.field.name">
                    </div>

                    <div class="form-group">
                        <label>ลำดับรูป</label>
                        <input type="text" name="order" class="form-control" id="order" placeholder="ลำดับรูป" ng-model="controller.field.order">
                    </div>
                    <div class="form-group">
                        <label>รูป</label><br />
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
                            $order = $_POST['order'];
                            if($_FILES['image']["name"] != "") {
                                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                                $image = basename($newfilename);
                                $sql = "SELECT * FROM `gallery` WHERE `id` = $id";
                                $result = $conn->query($sql);
                                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                                if(file_exists(getcwd().'/uploads/'.$row['image'])) {
                                    unlink(getcwd().'/uploads/'.$row['image']);
                                }
                                
                                $sql = "UPDATE `gallery` SET `name` = '$name', `order` = '$order',`image` = '$image' WHERE `gallery`.`id` = $id;";
                            }else {
                                $sql = "UPDATE `gallery` SET `name` = '$name', `order` = '$order' WHERE `gallery`.`id` = $id;";
                            }
                            
                            

                            
                           
                            $result = $conn->query($sql);
                            if($result) {
                                $resultTxt = "สำเร็จ";
                            }else {
                                $resultTxt = "ไม่สำเร็จ";
                            }
                            
                        ?>
    
                        <div class="is-center">
                            <h4>แก้ไขรูปภาพ <?php echo $resultTxt; ?> </h4>
                              <a href="index.php?module=gallery&mode=manage">คลิกเพื่อกลับไปยังหน้าจัดการ</a>
                        </div>
    
                        <?php }  ?>
                </div>
            </div>
		</div>
	
	</div>
</body>

</html>