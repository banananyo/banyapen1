
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

<?php
$get = $_GET;
    if(isset($get['id'])) {
        $sql = "UPDATE `payment_confirm` SET `status` = 'SHP' WHERE `payment_confirm`.`id` = $id;";
        $result = $conn->query($sql);
        $sql = "UPDATE `orders` SET `status` = 'SHP' WHERE `orders`.`orders_ref` = '$ordersRef';";
        $result = $conn->query($sql);
        
        // if($result) {
        //     $path = str_replace("/admin","/",getcwd());
        //     require($path.'sendmail.php');
        //     $datatest = new stdClass();
        //     $datatest->email = $bill['email'];
        //     $datatest->customer_name = $bill['name'];
        //     $datatest->orders_ref = $bill['orders_ref'];
        //     $datatest->ems = $bill['orders_ref'];
        //     sendMail($datatest, 'shipped');
        //     $id = $ordersRef;
        //     echo "<span class='is-green'>ยืนยันการจัดส่งให้กับบิลหมายเลข $id แล้ว</span>";
        // }else {
        //     echo "<span class='is-red'>ยืนยันการจัดส่งให้กับบิลหมายเลข $id ไม่สำเร็จ</span>";
        // }

    }else {
        echo "ไม่พบหน้าที่ต้องการ";
    }
?>
