<?php require_once 'PHPMailer/PHPMailerAutoload.php'; ?>
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
function sendMail($dataemail, $email_type){
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->CharSet="UTF-8"; 
    // $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "TLS";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = "banyapen1@gmail.com";
    $mail->Password = "banyapen1_2017";
    $mail->setFrom('banyapen1@gmail.com', 'banyapen1');
    $mail->AddCC('banyapen1@gmail.com', 'banyapen1');

    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );

    if($email_type == 'payment_confirm'){
        $path = str_replace("/admin","/",getcwd());
        $mail->Subject = 'ยืนยันการแจ้งโอนจากบ้านยาเป็นหนึ่ง';
        $mail->addAddress($dataemail->email, 'คุณลูกค้า: ' . $dataemail->customer_name);
        $mail->AltBody = 'ยืนยันการแจ้งโอนจากคุณ '.$dataemail->customer_name;
        $mail->IsHTML(true); 
        $mail->CharSet="utf-8";
        $mail->AddEmbeddedImage($path.'/images/logo_new2.jpg', 'logo');
        $message = file_get_contents($path.'/mailbody_paymentconfirm.php'); 
        $message = str_replace('%orders_ref%', $dataemail->orders_ref, $message); 
        $message = str_replace('%total_transfer%', $dataemail->total_transfer, $message); 
        $message = str_replace('%bank_account%', $dataemail->bank_account, $message); 
        $mail->msgHTML($message);
    }
    
    else if($email_type == 'contact'){
        $mail->Subject = 'ขอติดต่อผ่านทางเว็บไซต์ของบ้านยาเป็นหนึ่ง';
        $mail->addAddress($dataemail->email, 'คุณลูกค้า: ' . $dataemail->customer_name);
        $mail->msgHTML('<p> ข้อความจาก ' . $dataemail->customer_name.
                        '</p> <p>เบอร์โทรศัพท์ ' . $dataemail->tel . 
                        '</p><p>รายละเอียด:' . $dataemail->text_info . '</p>');
    }
    
    else if($email_type == 'order'){
        $path = str_replace("/admin","/",getcwd());
        $mail->Subject = 'บ้านยาเป็นหนึ่ง ยืนยันรายการสั่งซื้อและจัดส่งแล้ว';
        $mail->addAddress($dataemail->email, 'คุณลูกค้า: ' . $dataemail->customer_name);
        $mail->IsHTML(true); 
        $mail->CharSet="utf-8";
        $mail->AddEmbeddedImage($path.'/images/logo_new2.jpg', 'logo');
        $message = file_get_contents($path.'/mailbody_ordersending_confirm.php'); 
        $message = str_replace('%orders_ref%', $dataemail->orders_ref, $message); 
        $message = str_replace('%sending_ref%', $dataemail->sending_ref, $message); 
        $message = str_replace('%sending_address%', $dataemail->sending_address, $message); 
        $message = str_replace('%reciever_name%', $dataemail->reciever_name, $message); 
        $message = str_replace('%reciever_email%', $dataemail->reciever_email, $message); 
        $message = str_replace('%reciever_telnumber%', $dataemail->reciever_telnumber, $message); 
        $message = str_replace('%sending_info%', $dataemail->sending_info, $message); 
        $message = str_replace('%product_data%', html_entity_decode($dataemail->product_data), $message); 
        $mail->msgHTML($message);
    }

    if (!$mail->send()) {
        echo "<script>alert('".'การส่งอีเมล์ไม่สำเร็จเกิดข้อผิดพลาด! กรุณาติดต่อเจ้าของร้าน' . "');</script>";
    } else {
        if($email_type == 'contact'){
            echo "<script>alert('".'การส่งอีเมล์ติดต่อสำเร็จ ขอบคุณที่ใช้บริการค่ะ'."');</script>";
        }
        else if($email_type == 'payment_confirm'){
            echo "<script>alert('ยืนยันแจ้งโอนสำเร็จ!');</script>";
        }
        else{
            echo '<script>alert("ยืยันการจัดส่งสำเร็จ!");</script>';
        }
    }
    //mockup
                // $datatest = new stdClass();
                // $datatest->email = 'wazjakorn@gmail.com';
                // $datatest->customer_name = 'test user name';
                // $datatest->orders_ref = 'xxxx-xxxx';
                // $datatest->total_transfer = '2000';
                // $datatest->bank_account = 'KTC';
                // sendMail($datatest, 'payment_confirm');

                // $datatest = new stdClass();
                // $datatest->email = 'wazjakorn@gmail.com';
                // $datatest->customer_name = 'ชื่อ user ที่สั่งซื้อ';
                // $datatest->orders_ref = 'xxxx-xxxx';
                // $datatest->product_data = htmlspecialchars('<table cellspacing="0" cellpadding="0">
                // <thead>
                //     <tr>
                //         <th style="border: 1px solid black; padding: 5px;">สินค้า</th>
                //         <th style="border: 1px solid black; padding: 5px;">จำนวน</th>
                //         <th style="border: 1px solid black; padding: 5px;">ราคาสินค้า</th>
                //         <th style="border: 1px solid black; padding: 5px;">ราคารวม</th>
                //     </tr>
                // </thead>
                // <tbody>
                //     <tr>
                //         <td style="border: 1px solid black; padding: 5px;">test product</td>
                //         <td style="border: 1px solid black; padding: 5px;">2</td>
                //         <td style="border: 1px solid black; padding: 5px;">50.00</td>
                //         <td style="border: 1px solid black; padding: 5px;">100.00</td>
                //     </tr>
                //     <tr>
                //         <td colspan="3" style="text-align: right; border: 1px solid black; padding: 5px;">ราคารวมทั้งหมด</td>
                //         <td  style="border: 1px solid black; padding: 5px;">100.00 บาท</td>
                //     </tr>
                // <tbody>
                // </table>');
                // $datatest->sending_ref = 'เลข EMS หรือ tracking number';
                // $datatest->sending_address = 'ที่อยู่ในการจัดส่ง';
                // $datatest->reciever_name = 'ชื่อผู้รับ';
                // $datatest->reciever_email = 'อีเมลผู้รับ';
                // $datatest->reciever_telnumber = 'เบอร์โทรผู้รับ';
                // $datatest->sending_info = 'หมายเหตุ';
                // sendMail($datatest, 'order');
}
?>
</body>
</html>