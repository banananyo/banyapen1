
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `bank` WHERE `id` = $id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    unlink(getcwd().'/uploads/bank/'.$row['icon']);

    $sql = "DELETE FROM `bank` WHERE `bank`.`id` = $id";
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
    <title>ลบธนาคาร - ระบบจัดการบ้านยา</title>

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
                            จัดการธนาคาร
                        </a>
                        <a href="index.php?module=gallery&mode=add" class="list-group-item">เพิ่มธนาคาร</a>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-md-8 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ลบธนาคาร
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
                        <h4>ลบธนาคาร <?php echo $resultTxt; ?> </h4>
                          <a href="index.php?module=bill&mode=manageBank">คลิกเพื่อกลับไปยังหน้าจัดการ</a>
                    </div>


                </div>
            </div>
		</div>
	
	</div>
</body>

</html>