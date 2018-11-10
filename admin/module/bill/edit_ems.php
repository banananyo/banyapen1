
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
    <title>ยืนยันการชำระเงิน - <?php echo $bill['orders_ref'] ?> - ระบบจัดการบ้านยา</title>

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
                    แก้ไขการจัดส่ง - <?php echo $bill['orders_ref'] ?>
                </div>
                <div class="panel-body">
                    <div class="is-left">
                    <?php
                    $get = $_GET;
                    $post = $_POST;
                        if(isset($get['id']) && !isset($post['orders_ref'])) {
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>หมายเลขบิล</label>
                                    <input type="text" name="orders_ref" class="form-control" id="orders_ref" placeholder="หมายเลขบิล"  value="<?php echo $bill['orders_ref'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>รหัสพัสดุ</label>
                                    <input type="text" name="ems" class="form-control" id="ems" placeholder="รหัสพัสดุ" value="<?php echo $bill['ems'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>ข้อมูลเพิ่มเติมในการจัดส่ง</label>
                                    <textarea type="text" name="info" class="form-control" id="info" placeholder="ข้อมูลเพิ่มเติมในการจัดส่ง" ><?php echo $bill['info'] ?></textarea>
                                </div>
                                <input type="radio" name="status"  id="status" placeholder="สถานะ" value="SHP" <?php echo $bill['status']=='SHP'? 'checked':''; ?> >จัดส่งแล้ว&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="status"  id="status" placeholder="สถานะ" value="WFS" <?php echo $bill['status']=='WFS'? 'checked':''; ?> >รอการจัดส่ง<br/><br/>
                                </div>
                                <button class="btn btn-primary">บันทึก</button>
                                <a class="btn btn-danger" href="index.php?module=bill&mode=ems">กลับ</a>
                            </form>

                            <?php

                        }else if(isset($get['id']) && isset($post['orders_ref'])&& isset($post['ems'])) { 
                            $billId = $post['orders_ref'];
                            $ems = $post['ems'];
                            $info = $post['info'];
                            $status = $post['status'];

                            $sql = "UPDATE `payment_confirm` SET `status`='$status' WHERE `payment_confirm`.`orders_ref` = '$billId';";
                            $result = $conn->query($sql);

                            $sql = "UPDATE `orders` SET `ems` = '$ems', `info` = '$info', `status`='$status' WHERE `orders`.`orders_ref` = '$billId';";
                            $result = $conn->query($sql);
                            $id = $bill['orders_ref'];
                            if($result) {
                                if($status == "SHP") {
                                    $path = str_replace("/admin","/",getcwd());
                                    $totalPrice = $bill['total_price'];
                                    require($path.'sendmail.php');
                                    $datatest = new stdClass();
                                    $datatest->email = $bill['email'];
                                    $datatest->customer_name = getUsername($conn,$bill['member_id']);
                                    $datatest->orders_ref = $bill['orders_ref'];
                                    // var_dump(json_decode($bill['products']));
                                    // exit();
                                    $dataResult = "";
                                    foreach(json_decode($bill['products']) as $key => $value) {
                                        $dataResult.= "<tr><td style=\"border: 1px solid black; padding: 5px;\">".$value->name."</td>
                                        <td style=\"border: 1px solid black; padding: 5px;\">".$value->amount_purchase."</td>
                                        <td style=\"border: 1px solid black; padding: 5px;\">".$value->price."</td>
                                        <td style=\"border: 1px solid black; padding: 5px;\">".($value->price*$value->amount_purchase)."</td></tr>";
                                    }
                                    $datatest->product_data = htmlspecialchars('<table cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid black; padding: 5px;">สินค้า</th>
                                            <th style="border: 1px solid black; padding: 5px;">จำนวน</th>
                                            <th style="border: 1px solid black; padding: 5px;">ราคาสินค้า</th>
                                            <th style="border: 1px solid black; padding: 5px;">ราคารวม</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        '.$dataResult.'
                                        <tr>
                                            <td colspan="3" style="text-align: right; border: 1px solid black; padding: 5px;">ราคารวมทั้งหมด</td>
                                            <td  style="border: 1px solid black; padding: 5px;">'.number_format($totalPrice).' บาท</td>
                                        </tr>
                                    <tbody>
                                    </table>');
                                    $datatest->sending_ref = $ems;
                                    $datatest->sending_address = $bill['address'];
                                    $datatest->reciever_name = $bill['reciever_name'];
                                    $datatest->reciever_email = $bill['email'];
                                    $datatest->reciever_telnumber = $bill['tel'];
                                    $datatest->sending_info = $bill['info'];
                                    // exit();
                                    sendMail($datatest, 'order');
                                }
                                echo "<div class='is-center'><span class='is-green'>บันทึกข้อมูลการจัดส่งของหมายเลข $id แล้ว</span><br /><br /><a class=\"btn btn-default\" href=\"index.php?module=bill&mode=ems\">กลับ</a></div>";
                            }else {
                                echo "<div class='is-center'><span class='is-red'>บันทึกข้อมูลการจัดส่งของหมายเลข $id ไม่สำเร็จ</span><br /><br /><a class=\"btn btn-default\" href=\"index.php?module=bill&mode=ems\">กลับ</a></div>";
                            }
                        }
                    ?>
                    <br>
                    <br>
                    </div>
                </div>
            </div>
		</div>
	
	</div>
</body>

</html>