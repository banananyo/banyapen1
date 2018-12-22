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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php include"inc/inc_header.php"?>
<?php include"inc/inc_slide.php"?>
<div class="row">
	<div class="container" style="background-color:#ffffff;">
		<a id="view" name="view"></a>
    	<a href="product.php#view">
			<div class="ctiter"><span>รายละเอียดยา</span></div>
		</a>
		<?php 
		if(isset($_GET['prodId']) && $_GET['prodId'] != ''){
			require_once('connect.php');
			$prodId = $_GET['prodId'];
			$prodRes = $conn->query("SELECT * FROM `product` WHERE active=1 AND `id`=$prodId");
			if($row = $prodRes->fetch_assoc()){
		?>
			<!-- Gal 1-->
			<div class="col-xs-12 col-sm-12 col-md-12">
				<!-- <div style="font-size:160%; color:#0c5d25;"><?php echo $row['name'].'  '.($row['stock']<1 ? '<span class="badge badge-danger">สินค้าหมด</span> ':''); ?></div> -->
				<div style="padding-top:25px; padding-bottom:25px; font-size: 120%" class="row">
					<div class="col-lg-4"><img src="admin/uploads/<?php echo $row['image']; ?>" alt="" class="img-prod-detail img-fluid"/></div>
					<div class="col-lg-8">
						<div class="row">
							<div class="col-lg-12">
								<h3	style="border-bottom: 2px; border-color: rgb(100,100,100);">รายละเอียด</h3>
								<?php echo $row['description']; ?>
							</div>
						</div>
						<hr/>
						<div class="row" >
							<div class="col-lg-12">ราคา: <label class="hilighted-text"><?php echo $row['price']; ?> &#3647;</label></div>
						</div>
						<!-- <div class="row">
							<div class="col-lg-12">สินค้าในสต็อก: <label class="hilighted-text"><?php echo $row['stock']; ?> ชิ้น</label></div>
						</div> -->
						<form class="row" action="cart.php" method="post">
							<div class="col-lg-12">
								<input type="hidden" name="prod_id" value="<?php echo $row['id']; ?>" />
								<input type="hidden" name="add_to_cart" />
								<input type="number" class="form-control" style="width: 80px; display: inline-block" name="quantity" value="1" min="1"/>
								<input type="text" class="form-control" style="width: 60px; display: inline-block" value="ชิ้น" readOnly/>
								<button type="submit" class="btn btn-warning" 
									<?php echo ($row['stock']>=1 ? '':'disabled'); ?>>
									หยิบใส่ตะกร้า <i class="fa fa-shopping-cart" aria-hidden="true"></i>
								</button>
								<!-- <input type="submit" value="หยิบใส่ตะกร้า" name="add_to_cart" class="btn btn-warning btn-lg" <?php echo ($row['stock']>=1 ? '':'disabled'); ?>/> -->
							</div>
						</form>
					</div>
				</div>
				
			<div style="border-bottom:1px #e0e0e0 dotted; height:25px;"> </div>
			<!-- End Gal 1-->
		<?php 
			}
			$conn->close();
		} 
		?>
	<div style="height:50px;"></div> <!-- space -->
	<a onclick="window.history.back();" class="btn btn-success btn-lg">กลับไปหน้าหมวดหมู่</a>
	<a href="cart.php" class="btn btn-info btn-lg">ดูตะกร้าสินค้า <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
	<div style="height:50px;"></div> <!-- space -->
    </div><!--container-->
</div><!--row-->
<?php include"inc/inc_footer.php"?>

</body>
</html>