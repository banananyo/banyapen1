<?php 
if(!isset($_SESSION)){
    session_start();
}
if(isset($_GET['prodId'])){
    require_once('connect.php');
    $cartQuery = $conn->query("SELECT * FROM `cart` WHERE `member_id`=".$_SESSION['login_user']['id']);
    if($cart = $cartQuery->fetch_assoc()){
        $product_list = get_object_vars(json_decode($cart['product_list']));
        unset($product_list[$_GET['prodId']]);
        if(count($product_list) < 1) {
            $conn->query("DELETE FROM `cart` WHERE `member_id`=".$_SESSION['login_user']['id']);
        } else {
            $conn->query("UPDATE `cart` SET `product_list`='".json_encode((object) $product_list)."' WHERE `member_id`=".$_SESSION['login_user']['id']);
        }
    }
    $conn->close();
}
echo '<script>window.location.href="cart.php"</script>';
?>