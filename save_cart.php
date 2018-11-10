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
    <script src="js/numeral.min.js"></script>
</head>
<body>
    <?php 
    
    if(isset($_POST['save_cart'])){
        require_once('connect.php');
        $id = $_POST['cart_id'];
        $address = $_POST['addressInput'];
        $email = $_POST['emailInput'];
        $tel = $_POST['telInput'];
        $recieverName = $_POST['recieverNameInput'];
        $productList = $_POST['product_list'];
        $sql = "UPDATE `cart` SET `product_list`='$productList', `address`='$address', `email`='$email', `tel`='$tel', `reciever_name`='$recieverName' WHERE `id`=$id";
        $res = $conn->query($sql);
        if($res){
            echo '<script>alert("บันทึกการเปลี่ยนแปลงแล้ว");window.location.href="cart.php"</script>';
        }else {
            echo '<script>window.location.href="cart.php"</script>';
        }
        $conn->close();
    }else if(isset($_POST['submit_purchase'])){
        require_once('connect.php');
        if(isset($_POST['captchaInput']) && ($_POST['captchaInput'] == $_SESSION['detect_farang'])) {
            $address = $_POST['addressInput'];
            $memberId = $_POST['member_id'];
            $products = $_POST['product_list'];
            $email = $_POST['emailInput'];
            $tel = $_POST['telInput'];
            $recieverName = $_POST['recieverNameInput'];

            $product_list = get_object_vars(json_decode(stripslashes($products)));
            // print_r($product_list);
            $total_price = 0;
            foreach($product_list as $productInCart){
                $total_price += (intval($productInCart->amount_purchase) * floatval($productInCart->price));
            }

            $lastOrderId = '0000';
            $lastOrderQuery = $conn->query("SELECT id, orders_ref FROM orders ORDER BY id DESC LIMIT 1");
            if($lastOrderQuery->num_rows > 0 && $lastOrder = $lastOrderQuery->fetch_assoc()){
                $expd = explode("-", $lastOrder['orders_ref']);
                $lastOrderId = intval( $expd[2] ) + 1 ;
                if($lastOrderId > 9999) {
                    $lastOrderId = '0000';
                }
            }

            $dateTime = date("Y-m-d H:i:s");
            $orders_ref = "BL-".date('Ymd')."-".str_pad($lastOrderId, 4, '0', STR_PAD_LEFT);;
            $sql = "INSERT INTO `orders`(`member_id`, `orders_ref`, `status` ,`products`, `order_datetime`, `address`, `email`, `tel`, `reciever_name`, `total_price`) ".
            "VALUES ($memberId, '$orders_ref', 'WFT','$products','$dateTime','$address', '$email', '$tel', '$recieverName', $total_price)";
            // echo $sql;
            $res = $conn->query($sql);

            if($res){
                $product_info ='';
                foreach($product_list as $pid => $p){
                // decrease product stock
                    $amount = intval($p->amount_purchase);
                    $sql = "UPDATE `product` SET `stock`=`stock`-$amount WHERE id=".$pid;
                    $conn->query($sql);
                    // $product_query = $conn->query("SELECT name, price FROM product WHERE id=".$pid);
                    // $prod = $product_query->fetch_assoc();
                    // $product_info .= '<tr><td style="border: 1px solid black; padding: 5px;">'.$prod['name'].'</td>'.
                    // '<td style="border: 1px solid black; padding: 5px;">'.number_format($prod['price']).'</td>'.
                    // '<td style="border: 1px solid black; padding: 5px;">'.$amount.'</td></tr>';
                }
                // delete cart
                $sql = "DELETE FROM `cart` WHERE `member_id`=".$memberId;
                $conn->query($sql);

                echo '<script>alert("สั่งซื้อเรียบร้อยแล้ว กรุณาทำการโอนและแจ้งโอน เพื่อดำเนินการจัดส่งต่อไป ขอบคุณที่ใช้บริการค่ะ"); window.location.href="order_history.php";</script>';
            }else {
                echo '<script>alert("สั่งซื้อไม่สำเร็จ กรุณาติดต่อทางร้านโดยตรง ขอบคุณที่ใช้บริการค่ะ"); window.location.href="cart.php";</script>';
            }
        } else {
            echo '<script>alert("รหัสป้องกัน(captcha) ไม่ถูกต้อง!!!");window.location.href="cart.php";</script>';
        }
        $conn->close();
    }else {
        // print_r($_POST);
        echo '<script>window.location.href="cart.php"</script>';
    }
?>
</body>
</html>