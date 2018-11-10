
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `payment_confirm` WHERE `id` = $id";
    $result = $conn->query($sql);
    $bill = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $ordersRef =  $bill['orders_ref'];
?>

<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>ยกเลิกการชำระเงิน - <?php echo getBillID($conn,$bill['orders_ref']); ?> - ระบบจัดการบ้านยา</title>

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
                    รอการยืนยัน - <?php echo getBillID($conn,$bill['orders_ref']); ?>
                </div>
                <div class="panel-body">
                    <div class="is-center">
                    <?php
                    $get = $_GET;
                        if(isset($get['id'])) {
                            $sql = "UPDATE `payment_confirm` SET `status` = 'WFC' WHERE `payment_confirm`.`id` = $id;";
                            $result = $conn->query($sql);
                            $sql = "UPDATE `orders` SET `status` = 'WFC' WHERE `orders`.`orders_ref` = '$ordersRef';";
                            $res = $conn->query($sql);
                            $id = $ordersRef;
                            if($result) {
                                echo "<span class='is-green'>เปลี่ยนสถานะเป็น `รอการยืนยัน` ให้ $id แล้ว</span>";
                            }else {
                                echo "<span class='is-red'>เปลี่ยนสถานะเป็น `รอการยืนยัน` ให้ $id ไม่สำเร็จ</span>";
                            }

                        }else {
                            echo "ไม่พบหน้าที่ต้องการ";
                        }
                    ?>
                    <br>
                    <br>
                    <a class="btn btn-default" href="index.php?module=bill&mode=confirm">กลับหน้าจัดการ</a>
                    </div>
                </div>
            </div>
		</div>
	
	</div>
</body>

</html>