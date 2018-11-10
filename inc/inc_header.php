<div class="container" style="background-color:#ffffff;">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="row" style="padding-top:25px; padding-bottom:10px;">
				<div class="col-md-3" align="center" style="padding-top:10px; padding-left:20px;" >
				<a href="index.php">
				<img src="images/logo_new2.jpg" class="img-responsive"></a>
				</div>
				<div class="col-md-9" align="right">
					<div class="head_r" style="display:none;">
						<table width="500" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td align="right">
									<a href="cart.php"  style="color: green">
										<!-- <img src="images/cart.png" width="100" height="15"> -->
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;ตะกร้าสินค้า
									</a>
								</td>
							</tr>
							<tr>
								<td align="right">
									<a href="order_history.php" style="color: green">
										<i class="fa fa-book" aria-hidden="true"></i>&nbsp;ประวัติการสั่งซื้อ
									</a>
								</td>
							</tr>
							<tr>
								<td align="right" style="padding-top:10px;" colspan="1">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" style="padding-right:10px;">
											<span style="font-size:22px;">ชื่อผู้เข้าใช้ : <?php echo $_SESSION['login_user']['name']; ?> </span>
											</td>
											<td align="right"><a href="logout.php">
											<img src="images/logout.png" width="100" height="15" /></a>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td align="right"  style="padding-top:10px; padding-bottom:10px;">
									<form style="width:250px;" align="right" id="search-form" action="product.php">
										<div class="input-group stylish-input-group">
											<input type="text" class="form-control"  placeholder="ค้นหาจากชื่อสินค้า" name="search_by_product_name" />
											<span class="input-group-addon">
												<button type="submit">
													<span class="glyphicon glyphicon-search"></span>
												</button>  
											</span>
										</div>
									</form>
								</td>
							<tr>
						</table>
					</div>
				</div>
			</div> <!-- row -->
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span>Menu</span>
			</button>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="home.php">หน้าแรก</a></li>
					<li><a href="about.php">เกี่ยวกับเรา</a></li>
					<li><a href="promotion.php">โปรโมชั่น</a></li>
					<li><a href="product.php">ราคายา</a></li>
					<li><a href="payment.php">วิธีการชำระเงิน</a></li>
					<li><a href="paymentconfirm.php">แจ้งการโอนเงิน</a></li>
					<li><a href="contact.php"><i class="fa fa-pencil-square-o f-16"></i>ติดต่อเรา </a></li>
					<li class="mobile-menu"><a href="logout.php">ออกจากระบบ </a></li>
					<li class="mobile-menu"><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;ตะกร้าสินค้า </a></li>
					<li class="mobile-menu"><a href="order_history.php"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;ประวัติการสั่งซื้อ </a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</div>
<!-- cart floating -->
<div class="cart-floating-wrapper">
<a href="logout.php">
	<div class="cart-button">
	<span>ออกจากระบบ</span>
	</div>
</a>
<hr style="margin: 5px;"/>
<a href="cart.php">
	<div class="cart-button" style="text-align: center;margin-top: 2px;">
	<i class="fa fa-shopping-cart" aria-hidden="true"></i>
	&nbsp;<span>ตะกร้าสินค้า</span>
	</div>
</a>
<hr style="margin: 5px;"/>
<a href="order_history.php">
	<div class="cart-button" style="text-align: center;margin-top: 2px;">
	<i class="fa fa-book" aria-hidden="true"></i>
	&nbsp;<span>ประวัติการสั่งซื้อ</span>
	</div>
</a>
</div>
<!-- cart floating end -->
<script>
$(function() {
	var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
	$("ul.navbar-nav li a").each(function(){
	if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
	$(this).addClass("active-menu");
	})
	});
</script>