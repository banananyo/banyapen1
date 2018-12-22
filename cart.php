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
<?php include"inc/inc_header.php"?>
<?php include"inc/inc_slide.php"?>
<div class="row">
	<form class="container" style="background-color:#ffffff;" action="save_cart.php"
    method="post" name="form_submit_purchase" onsubmit="return validateForm()" >
		<a id="view" name="view"></a>
    	<a href="product.php#view">
			<div class="ctiter"><span>ตะกร้าสินค้า</span></div>
		</a>
		<div class="row">
            <div class="col-lg-12" >
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th colspan="2">สินค้า</th>
                            <!-- <th>จำนวนสินค้าในสต็อก</th> -->
                            <th>จำนวนที่ต้องการสั่งซื้อ</th>
                            <th>ราคา (บาท)</th>
                            <th>ลบรายการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once('connect.php');
                            require_once('unicode_reverse.php');
                            if(isset($_POST['prod_id'])){
                                if (isset($_POST['quantity']) && $_POST['quantity'] > 0) {
                                    $quantity = $_POST['quantity'];
                                } else {
                                    $quantity = 1;
                                }
                                $productId = $_POST['prod_id'];
                                $pq = $conn->query("SELECT price, name FROM product WHERE id=".$productId);
                                if($prodGet = $pq->fetch_assoc()){
                                    // if product exists in cart
                                    $cartQuery = $conn->query("SELECT * FROM `cart` WHERE `member_id`=".$_SESSION['login_user']['id']);
                                    if($cart = $cartQuery->fetch_assoc()){
                                        $product_list = get_object_vars(json_decode($cart['product_list']));
                                        if(!isset($product_list[$productId])){
                                            $product_list[$productId] = new stdClass();
                                            $product_list[$productId]->name = $prodGet['name'];
                                            $product_list[$productId]->price =  $prodGet['price'];
                                        }

                                        // init amount purchase
                                        if(!isset($product_list[$productId]->amount_purchase)){
                                            $product_list[$productId]->amount_purchase = 0;
                                        }

                                        // check product stock 
                                        // $prodCheckQuery = $conn->query("SELECT stock FROM product WHERE id=".intval($productId));
                                        // if($prodCheck = $prodCheckQuery->fetch_assoc()){
                                        //     if($product_list[$productId]->amount_purchase + 1 <= $prodCheck['stock']){
                                                $product_list[$productId]->amount_purchase += $quantity;
                                        //     }
                                        // }
                                        
                                        $conn->query("UPDATE `cart` SET `product_list`='"
                                        .encode_single_quote(unicode_decode(json_encode((object) $product_list))).
                                        "' WHERE `member_id`=".$_SESSION['login_user']['id']);
                                  
                                    }   
                                    // if user init cart
                                    else {
                                        $first_product[$productId]['amount_purchase'] = $quantity;
                                        $first_product[$productId]['name'] = $prodGet['name'];
                                        $first_product[$productId]['price'] =  $prodGet['price'];
                                        $conn->query("INSERT INTO `cart`(`member_id`, `product_list`) VALUES(".$_SESSION['login_user']['id'].", '".encode_single_quote(unicode_decode(json_encode($first_product)))."')");
                                    }
                                }
                            }

                            $cartShowQuery = $conn->query("SELECT * FROM `cart` WHERE `member_id`=".$_SESSION['login_user']['id']);
                            // fetch to show
                            $canPurchase = false;
                            if($rowCart = $cartShowQuery->fetch_assoc()){
                                echo '<input type="hidden" value="'.$rowCart['member_id'].'" name="member_id" id="member_id"/>';
                                echo '<input type="hidden" value="'.$rowCart['id'].'" name="cart_id" id="cart_id"/>';
                                echo '<input type="hidden" value="'.htmlspecialchars($rowCart['product_list'], ENT_QUOTES, 'UTF-8').'" name="product_list" id="product_list" />';
                                $canPurchase = true;
                                $product_list = get_object_vars(json_decode($rowCart['product_list']));
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
                                            <td colspan="2"><a href="product_detail.php?prodId=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
                                            <!-- <td><?php echo $row['stock']; if($row['stock'] < 1){ $canPurchase = false; }?></td> -->
                                            <td>
      
                                                <input type="number" price="<?php echo $row['price']; ?>" stock="<?php echo $row['stock']; ?>"
                                                    prodId="<?php echo $row['id']; ?>" value="<?php echo $productInCart->amount_purchase; ?>" 
                                                    name="" class="form-control" min="1" id="amount_<?php echo $row['id']; ?>" />
                                            </td>
                                            <td>
                                                <input type="number" value="<?php echo ($sum_this); ?>" 
                                                class="form-control" readonly id="sum_price_<?php echo $row['id'];?>" />
                                            </td>
                                            <td style="text-align: center;">
                                                <button type="button" class="btn btn-danger" value="<?php echo $row['id'];?>" id="delete_prod_<?php echo $row['id'];?>">X</button>
                                            </td>
                                        </tr>
                                    <?php
                                    
                                    $i++;
                                    }
                                    
                                }
                                ?>
                                <tr>
                                    <td></td>
                                    <td colspan="2"></td>
                                    <!-- <td></td> -->
                                    <td style="text-align: right;">รวมทั้งสิ้น</td>
                                    <td style="text-align: center;">
                                        <input type="number" name="sum_all_price" id="sum_all_price" value="<?php echo $sum_all_price; ?>" class="form-control" readonly/>
                                    </td>
                                    <td>บาท</td>
                                </tr>
                                <tr>
                                    <td colspan="3">ที่อยู่ในการจัดส่ง<br/></td>
                                    <td colspan="4">
                                        <textarea name="addressInput" id="addressInput" rows="3" class="form-control" required><?php 
                                            if($rowCart['address'] == null || $rowCart['address'] == ''){
                                                $addressQuery = $conn->query("SELECT address FROM member WHERE id=".$_SESSION['login_user']['id']);
                                                if($address = $addressQuery->fetch_assoc()){
                                                    echo $address['address'];
                                                }
                                            } else {
                                                echo $rowCart['address'];
                                            }
                                            ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">ชื่อผู้รับ<br/><span class="text-danger" style="font-size: 85%;">(โปรดใส่ชื่อจริง)</span></td>
                                    <td colspan="4">
                                            <?php 
                                            $n='';
                                            if($rowCart['email'] == null || $rowCart['email'] == ''){
                                                $nameQuery = $conn->query("SELECT name FROM member WHERE id=".$_SESSION['login_user']['id']);
                                                if($name = $nameQuery->fetch_assoc()){
                                                    $n = $name['name'];
                                                }
                                            } else {
                                                $n = $rowCart['reciever_name'];
                                            }
                                            ?>
                                        <input name="recieverNameInput" id="recieverNameInput" class="form-control"  value="<?php echo $n; ?>" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">อีเมลผู้รับ<br/><span class="text-danger" style="font-size: 85%;">(ระบบจะส่งอีเมล ไปพร้อมรหัสสั่งซื้อเมื่อทำรายการสำเร็จ)</span></td>
                                    <td colspan="4">
                                            <?php 
                                            $m='';
                                            if($rowCart['email'] == null || $rowCart['email'] == ''){
                                                $emailQuery = $conn->query("SELECT email FROM member WHERE id=".$_SESSION['login_user']['id']);
                                                if($email = $emailQuery->fetch_assoc()){
                                                    $m = $email['email'];
                                                }
                                            } else {
                                                $m = $rowCart['email'];
                                            }
                                            ?>
                                        <input name="emailInput" id="emailInput" rows="3" class="form-control" value="<?php echo $m; ?>" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">เบอร์โทรศัพท์ผู้รับ</td>
                                    <td colspan="4">
                                        <?php 
                                        $t='';
                                        if($rowCart['tel'] == null || $rowCart['tel'] == ''){
                                            $telQuery = $conn->query("SELECT tel FROM member WHERE id=".$_SESSION['login_user']['id']);
                                            if($tel = $telQuery->fetch_assoc()){
                                                $t = $tel['tel'];
                                            }
                                        } else {
                                            $t = $rowCart['tel'];
                                        }
                                        ?>
                                    <input name="telInput" id="telInput" rows="3" class="form-control" value="<?php echo $t; ?>" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: center;">
                                        <label for="captchaInput"><img src="captcha.php" style="width: auto; height: 40px;"></label>
                                    </td>
                                    <td colspan="4">
                                        <input type="text" class="form-control" style="width: 100%; height: 40px;" placeholder="รหัสป้องกัน (captcha) เฉพาะกรณีสั่งซื้อสินค้า" id="captchaInput" name="captchaInput" />
                                    </td>
                                </tr>
                                <?php
                            } else {
                                echo '<tr><td colspan="6" style="text-align: center; color: red;" ><h3>ไม่มีสินค้าในตะกร้า</h3></td></tr>';
                            }
                            // close connection db
                            $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-sm-4 col-sm-offset-4" > -->
                <?php if($canPurchase == true){ ?>
                    <div class="col-sm-4 col-sm-offset-4 text-center" >
                        <span class="text-danger" style="font-size: 85%;">*** โปรดตรวจสอบรายละเอียดให้ถูกต้อง ***</span>
                        <div class="btn-group" role="group" aria-label="...">
                            <input type="submit" value="ดำเนินการสั่งซื้อ" name="submit_purchase" id="submit_purchase_button" class="btn btn-success btn-lg " />
                            <input type="submit" value="บันทึกการเปลี่ยนแปลง" name="save_cart" id="save_cart" class="btn btn-info btn-lg" />
                        </div>
                    </div>
                <?php }else {
                    echo '<div class="col-sm-4 col-sm-offset-4" >
                    <h3 class="text-danger text-center">ไม่สามารถสั่งซื้อได้เนื่องจากสินค้าหมด<br/>หรือมีเงื่อนไขที่ไม่ถูกต้อง</h3>
                    </div>';
                } ?>
            <!-- </div> -->
        </div>
	    <div style="height:50px;"></div> <!-- space -->
    </form><!--container-->
</div><!--row-->
<?php include"inc/inc_footer.php"?>
<script type="text/javascript">
    String.prototype.escapeSpecialChars = function() {
        return this.replace(/\\n/g, "\\n")
                .replace(/\\'/g, "\\'")
                .replace(/\\"/g, '\\"')
                .replace(/\\&/g, "\\&")
                .replace(/\\r/g, "\\r")
                .replace(/\\t/g, "\\t")
                .replace(/\\b/g, "\\b")
                .replace(/\\f/g, "\\f");
    };
    $(document).ready(function(){
        // handle change amount
        $("input[id^='amount_']" ).on('change', function(){
            var productList = JSON.parse($('#product_list').val());

            var price = numeral($(this).attr('price')).value();
            var amount = numeral($(this).val()).value();
            var prodId = $(this).attr('prodId');
            var stock = numeral($(this).attr('stock')).value();
            // if(amount > stock){
            //     alert('ไม่สามารถสั่งเกินจำนวนในสต็อกได้');
            //     $(this).val(stock);
            //     $("#sum_price_"+prodId).val(stock * price);

            //     productList[prodId].amount_purchase = stock;

            // }else {
                var s = amount * price;
                $("#sum_price_"+prodId).val(s);

                productList[prodId].amount_purchase = amount;
                
            // }
            $('#product_list').val(JSON.stringify(productList).escapeSpecialChars());
            // console.log(productList);

            var arr_sum = ($("[id^='sum_price_']").toArray()).map(function(e) { return e.value });
            // console.log(arr_sum);
            var sum = 0;
            for( var i =0 ; i < arr_sum.length ; i++ ){
                sum += numeral(arr_sum[i]).value();
            }
            $('#sum_all_price').val(sum);
        });

        // handle delete
        $("button[id^='delete_prod_']").on('click', function(){
            var prodId = $(this).val();
            // console.log(prodId);
            window.location.href = 'remove_from_cart.php?prodId='+prodId;
        });

        
        // $('#submit_purchase_button').on("click", function(e){
        //     var confirm = window.confirm('คุณยืนยันที่จะดำเนินการสั่งซื้อรายการนี้?');
        //     if(confirm){
                // $('#form_submit_purchase').submit();
        //         console.log('submit');
        //     }
        // });
    });
    // handle submit
    function validateForm() {
        // var captchaInput = document.forms["form_submit_purchase"]["captchaInput"].value;
        var addressInput = document.forms["form_submit_purchase"]["addressInput"].value;
        var telInput = document.forms["form_submit_purchase"]["telInput"].value;
        var emailInput = document.forms["form_submit_purchase"]["emailInput"].value;
        var recieverNameInput = document.forms["form_submit_purchase"]["recieverNameInput"].value;
        // var inputName = document.forms["form_submit_purchase"]["inputName"].value;
        // var inputPrice = document.forms["form_submit_purchase"]["inputPrice"].value;
        // var inputFile = document.forms["form_submit_purchase"]["inputFile"].value;
        if (
            addressInput == "" ||
            telInput == "" ||
            emailInput == "" || 
            recieverNameInput == "" ) {
            alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
            return false;
        }

        return true;
    }
</script>
</body>
</html>