
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `category` WHERE `id` = $id";
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
    <title>เพิ่มหมวดหมู่ - ระบบจัดการบ้านยา</title>

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
    <script src="module/category/core.js"></script>
	<div class="container main-container" ng-controller="edit as controller">
    <div class="col-md-4 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    เมนู
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="index.php?module=category&mode=manage" class="list-group-item active">
                            จัดการหมวดหมู่
                        </a>
                        <a href="index.php?module=category&mode=add" class="list-group-item">เพิ่มหมวดหมู่</a>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-md-8 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    แก้ไขหมวดหมู่ - <?php echo $row['name'] ?>
                </div>
                <div class="panel-body">
                <?php if(!isset($_POST['name'])) { ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label>ชื่อหมวดหมู่</label>
                        <div ng-init="self.field.name = '<?php echo $row['name']; ?>';self.field.detail = '<?php echo $row['detail']; ?>'"></div>
                        <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อหมวดหมู่" ng-model="self.field.name" value="">
                    </div>
                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea type="text" name="detail" class="form-control" id="detail" placeholder="รายละเอียด" ng-model="self.field.detail" ></textarea>
                    </div>
                    <button type="submit" ng-disabled="self.field.name == undefined || self.field.name == ''" class="btn btn-default">ตกลง</button>
                    <div class="alert alert-danger is-hidden" id="LOGIN_ERR" style="margin-top: 2rem;" role="alert">
                        กรอกข้อมูลให้ครบถ้วน
                    </div>
                    </form>

                    <?php } else  { 

                    $name = $_POST['name'];
                    $detail = $_POST['detail'];
                        
                    $sql = "UPDATE `category` SET `name` = '$name', `detail` = '$detail' WHERE `category`.`id` = $id;";
                    $result = $conn->query($sql);
                    if($result) {
                        $resultTxt = "สำเร็จ";
                    }else {
                        $resultTxt = "ไม่สำเร็จ";
                    }
                        
                    ?>

                    <div class="is-center">
                        <h4>แก้ไขหมวดหมู่ <?php echo $resultTxt; ?> </h4>
                          <a href="index.php?module=category&mode=manage">คลิกเพื่อกลับไปยังหน้าจัดการ</a>
                    </div>

                    <?php }  ?>

                </div>
            </div>
		</div>
	
	</div>
</body>

</html>