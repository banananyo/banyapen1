
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `orders` WHERE `id` = $id";
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
    <title>ดูรายละเอียดบิล - <?php echo $bill['orders_ref']; ?> - ระบบจัดการบ้านยา</title>

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
                    ดูรายละเอียดบิล - <?php echo $bill['orders_ref'] ?>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>หมายเลขบิล</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="หมายเลขบิล"  value="<?php echo $bill['orders_ref'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>ผู้สั่ง</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="ผู้สั่ง"  value="<?php echo getUsername($conn,$bill['member_id']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทร</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="เบอร์โทร"  value="<?php echo $bill['tel'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>ที่อยู่</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="ที่อยู่"  value="<?php echo $bill['address'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>สถานะ: </label>
                        <?php 
                            switch($bill['status']) {
                                case 'CMP': 
                                    echo '<span class="label label-success">จัดส่งแล้ว</span>';
                                    break;
                                case 'REJ': 
                                    echo '<span class="label label-danger">ไม่รับคำสั่งซื้อ</span>';
                                    break;
                                case 'WFC': 
                                    echo '<span class="label label-info">รอจัดส่ง</span>';
                                    break;
                                case 'WFT': 
                                    echo '<span class="label label-warning">รอโอน</span>';
                                    break;
                                default: break;
                            }
                        ?>
                    </div>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>สินค้า</th>
                            <th>จำนวน</th>
                            <th>ราคา (บาท)</th>
                        </tr>
                    </thead>
                    <?php
                        $product_list = get_object_vars(json_decode($bill['products']));
                        $i=0;
                        $sum_all_price = 0;
                        foreach($product_list as $product_id => $productInCart){
                            $resProd = $conn->query("SELECT * FROM `product` WHERE `id`=".$product_id);
                            if($row = $resProd->fetch_assoc()){
                                $sum_this = ($productInCart->amount_purchase * $row['price']);
                                $sum_all_price += $sum_this;
                            ?>
                                <tr>
                                    <td><?php echo ($i+1) ;?></td>
                                    <td><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/product_detail.php?prodId=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
                                    <td>
                                        <?php echo $productInCart->amount_purchase; ?>
                                    </td>
                                    <td class="is-center">
                                        <?php echo ($sum_this); ?>
                                    </td>
                                </tr>
                            <?php
                            
                            $i++;
                            }
                        }
                    ?>
                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;">รวมทั้งสิ้น</td>
                                    <td style="text-align: center;">
                                        <?php echo $sum_all_price; ?> บาท
                                    </td>
                                </tr>
                    </table>
                </div>
            </div>
		</div>
	
	</div>
</body>

</html>