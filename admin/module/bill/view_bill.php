
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `payment_confirm` WHERE `id` = $id";
    $result = $conn->query($sql);
    $bill = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>ดูการชำระเงินบิล - <?php echo getBillID($conn,$bill['orders_ref']); ?> - ระบบจัดการบ้านยา</title>

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
                    ดูการชำระเงินบิล - <?php echo getBillID($conn,$bill['orders_ref']); ?>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>หมายเลขบิล</label>
                            <input type="text" name="name" class="form-control" id="bill_id" placeholder="หมายเลขบิล"  value="<?php echo getBillID($conn,$bill['orders_ref']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>วันที่</label>
                            <input type="text" name="name" class="form-control" id="date" placeholder="วันที่"  value="<?php echo $bill['payment_date']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>เวลา</label>
                            <input type="text" name="name" class="form-control" id="time" placeholder="เวลา"  value="<?php echo $bill['payment_time']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>ชื่อ</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อ"  value="<?php echo $bill['name'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>เบอร์โทร</label>
                            <input type="text" name="name" class="form-control" id="tel" placeholder="เบอร์โทร"  value="<?php echo $bill['tel'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>อีเมลล์</label>
                            <input type="text" name="name" class="form-control" id="email" placeholder="อีเมลล์"  value="<?php echo $bill['email'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>จำนวนเงิน</label>
                            <input type="text" name="name" class="form-control" id="email" placeholder="จำนวนเงิน"  value="<?php echo number_format($bill['price']) ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label>สลิป</label>
                           <img class="img-responsive" src="../<?php echo $bill['slip_url'] ?>" alt="">
                        </div>

                        <div class="form-group">
                            <label>เพิ่มเติม</label>
                            <textarea type="text" name="name" class="form-control" id="email" placeholder="เพิ่มเติม" readonly><?php echo $bill['text_remark'] ?></textarea>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
		</div>
	
	</div>
</body>

</html>