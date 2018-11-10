
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "DELETE FROM `category` WHERE `category`.`id` = $id";
    $result = $conn->query($sql);
    if($result) {
        $resultTxt = "สำเร็จ";
    }else {
        $resultTxt = "ไม่สำเร็จ";
    }
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
                    ลบหมวดหมู่
                </div>
                <div class="panel-body">
                    <?php 

                    if($result) {
                        $resultTxt = "สำเร็จ";
                    }else {
                        $resultTxt = "ไม่สำเร็จ";
                    }
                        
                    ?>

                    <div class="is-center">
                        <h4>ลบหมวดหมู่ <?php echo $resultTxt; ?> </h4>
                          <a href="index.php?module=category&mode=manage">คลิกเพื่อกลับไปยังหน้าจัดการ</a>
                    </div>


                </div>
            </div>
		</div>
	
	</div>
</body>

</html>