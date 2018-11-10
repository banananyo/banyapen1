<?php include('session.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>บ้านยาเป็นหนึ่ง</title>
<meta name="Keywords" content="บ้านยาเป็นหนึ่ง">
<link rel="icon" href="logo-1.png" type="image/x-icon">
<link rel="stylesheet" href="css/owl.carousel.css">
<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/jquery.bxslider.css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" type="text/css" rel="stylesheet">
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body>
<?php include"inc/inc_header.php"?>
<?php include"inc/inc_slide.php"?>
<div class="row">
	<div class="container" style="background-color:#ffffff;">
	<div class="ctiter"><span>ประวัติการสั่งซื้อ</span></div>
    <div class="row"><div class="col-md-12">
    <table class="table table-wrap" >
        <thead>
            <tr>
                <th>รหัสการสั่งซื้อ</th>
                <th>สินค้า</th>
                <th>ยอดรวม(บาท)</th>
                <th>ที่อยู่</th>
                <th>ข้อมูลผู้รับ</th>
                <th>รหัสการจัดส่ง</th>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
        <?php
        require_once 'connect.php';
            $sql = "SELECT * FROM `orders` WHERE `member_id`=".$_SESSION['login_user']['id']." ORDER BY order_datetime DESC";
            $result = $conn->query($sql);
            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){ ?>
                <tr>
                    <td style="width: 150px;"><?php echo $row['orders_ref'].'<br/>'.$row['order_datetime']; ?></td>
                    <td style="width: 170px;"><?php 
                    $prodArray = get_object_vars(json_decode(stripslashes($row['products'])));
                    foreach(array_keys($prodArray) as $pid){
                        $amount = $prodArray[$pid]->amount_purchase;
                        $product_query = $conn->query("SELECT name FROM product WHERE id=".$pid);
                        $prod = $product_query->fetch_assoc();
                        echo $prod['name'].' ['.$amount.']</br>';
                    }
                    ?></td>
                    <td ><?php echo $row['total_price']; ?></td>
                    <td style="width: 200px;"><?php echo $row['address']; ?></td>
                    <td style="width: 200px;"><?php echo 'ชื่อ: '.$row['reciever_name'].'<br/>อีเมล: '.$row['email'].'</br>เบอร์: '.$row['tel']; ?></td>
                    <td><?php echo $row['ems'].'<br/>'.$row['info']; ?></td>
                    <td ><?php 
                        switch($row['status']){
                            case 'SHP': 
                                echo '<span class="label label-success">จัดส่งแล้ว</span>';
                                break;
                            case 'WFS': 
                                echo '<span class="label label-info">รอการจัดส่ง</span>';
                                break;
                            case 'REJ': 
                                echo '<span class="label label-danger">ปฏิเสธ</span>';
                                break;
                            case 'WFT': 
                                echo '<span class="label label-warning">รอโอน</span>';
                                break;
                            case 'WFC': 
                                echo '<span class="label label-warning">รอการยืนยัน</span>';
                                break;
                            default:
                                echo '-';
                                break;
                        }
                    ?></td>
                </tr>
            <?php }
            $conn->close();
        ?>
        </tbody>
    </table>
    </div></div>
    <div style="height:40px;"></div><!--space-->
    </div><!--container-->
</div><!--row-->

<?php include"inc/inc_footer.php"?>

</body>
</html>