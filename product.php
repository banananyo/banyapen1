<?php  include('session.php'); ?>
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
<?php include('inc/inc_header.php'); ?>
<?php include('inc/inc_slide.php'); ?>
<script>
	function updateQueryStringParameter(uri, key, value) {
		var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
		var separator = uri.indexOf('?') !== -1 ? "&" : "?";
		if (uri.match(re)) {
			return uri.replace(re, '$1' + key + "=" + value + '$2');
		}
		else {
			return uri + separator + key + "=" + value;
		}
	}
	const goCat = function(catId) {
		const newUrl = updateQueryStringParameter(window.location.href, 'cat', catId);
		const goPageAlso = updateQueryStringParameter(newUrl, 'page', 1);
		const clearSearchAlso = updateQueryStringParameter(goPageAlso, 'search_by_product_name', '');
		window.location.href = clearSearchAlso;
	}
	const goPage = function(page) {
		const newUrl = updateQueryStringParameter(window.location.href, 'page', page);
		window.location.href = newUrl;
	}
</script>
<div class="row">
<div class="container" style="background-color:#ffffff;">

	<div class="box_project_main">
		
		<div class="row" style="padding-top:20px;">
			<?php 
			require_once('connect.php');
			$pre_sql_string = "SELECT * FROM `product` WHERE `active`=1";

			if(isset($_GET['search_by_product_name']) && $_GET['search_by_product_name'] != ""){ ?>
			<div class="col-md-12">
				<div class="row"><div class="col-sm-12 search-text-title">ผลการค้นหาจาก "<?php echo $_GET['search_by_product_name']; ?>"</div></div>
			</div>
			<?php
			}
			$max_per_page = 9;
			$max_buttons = 5;
			$min_max_out = 2;
			$cat_queryparam = isset($_GET['cat']) ? "'".$_GET['cat']."'" : null;
			$current_page = (isset($_GET['page']) && $_GET['page'] != '0') ? $_GET['page'] : 1; // begin at 1 but in sql is begin 0

			$limit=" LIMIT 0, $max_per_page";
			if($current_page != null){
				$limit = " LIMIT ".abs((intval($current_page)-1) * $max_per_page).", $max_per_page";
			}
			if($cat_queryparam != null){
				$pre_sql_string = "SELECT * FROM `product` WHERE `active`=1 AND `category_id`=$cat_queryparam";
			} else if(isset($_GET['search_by_product_name'])){
				$pre_sql_string = "SELECT * FROM `product` WHERE `active`=1 AND `name` LIKE '%".$_GET['search_by_product_name']."%'";
			} else {
				$pre_sql_string = "SELECT * FROM `product` WHERE `active`=1 ";
			}
			$pre_query = $conn->query($pre_sql_string);
		
			$count_prod_to_show = mysqli_num_rows($pre_query);
			$resProd = $conn->query($pre_sql_string.$limit);
			$last_page = ceil($count_prod_to_show / $max_per_page);
			$last_page_to_show = $last_page;
			$first_page_to_show = 1;
			$isOverMaxButton = ($last_page > $max_buttons);
			?>
			<div class="col-md-12">
				<div class="row">
					<div class="col-sm-12 search-text-title">
						หน้าที่ <?php echo $current_page; ?> จาก <?php echo $last_page; ?> หน้า
						<?php 
						if($isOverMaxButton){
							$last_page_to_show = ($current_page + $min_max_out);
							$first_page_to_show = ($current_page - $min_max_out);
							if($first_page_to_show < 1){
								$last_page_to_show += (1-$first_page_to_show);
								$first_page_to_show = 1;
							}
							else if($last_page_to_show > $last_page) {
								$first_page_to_show -= ($last_page_to_show - $last_page);
								$last_page_to_show = $last_page;
							}
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-md-12 text-center" style="margin-bottom: 10px;">
				<?php
				include('paging.php');
				?>
			</div>
			<div class="col-md-3" style="padding-right: 10px">
				<img src="images/hproduct.jpg" style="width: 100%; height: auto;" >
				<div style="padding-top:25px; padding-bottom:20px;"><img src="images/hcat.png" width="138" height="33"></div>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><img src="images/lmline.png" width="1" height="210"></td>
						<td align="left"><div id='csslmenu' align="left">
							<ul style="margin-left:5px;">
								<li>
									<a href="product.php" class="clickable">ทั้งหมด</a>
								</li><?php
									
									$resCat = $conn->query("SELECT * FROM `category`");
									while($row = $resCat->fetch_assoc()){
										$isActive = '';
										if(isset($_GET['cat']) && (intval($_GET['cat']) == $row['id'])){
											$isActive = 'class="active"';
										}
										echo '<li '.$isActive.'><a onclick="goCat('.$row['id'].')" class="clickable">'.$row['name'].'</a></li>';
									}
								?>
							</ul>
							<div style="height:35px;"></div>
						</td>
					</tr>
				</table>
			</div><!--col3 Menu-->
			<div class="col-md-9"> 
				<div class="row">
					<!-- prod -->
					<?php 
					while($row = $resProd->fetch_assoc()){ ?>
						
						<div class="col-xs-12 col-sm-4 col-md-4">
							<div class="frame">
								<figure>
									<a href="product_detail.php?prodId=<?php echo $row['id']; ?>">
										<img src="admin/uploads/<?php echo $row['image']; ?>" class="img-responsive img-prod-thumb">
									</a>
								</figure>
								<div class="product-pre-desc">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td style="height:45px;">
												<label style="font-size:22px;"><?php echo ($row['stock']<1 ? '<span class="badge badge-danger">หมด</span> ':'').$row['name']; ?></label>
											</td>
										</tr>
									</table>
									
									<label class="sdescription"><?php echo $row['sdescription']; ?></label>
									<form action="cart.php" method="post" class="quickbuy">
										<input type="hidden" name="prod_id" value="<?php echo $row['id']; ?>" />
										<input type="hidden" name="add_to_cart" value="" />
										<button class="btn btn-success" type="submit">
											<?php echo $row['price']; ?> &#3647;
											<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										</button>
									</form>
								</div>
								<div class="read-more">
									<a href="product_detail.php?prodId=<?php echo $row['id']; ?>">
										รายละเอียดเพิ่มเติม <i class="fa fa-arrow-circle-o-right f-14"></i>
									</a>
								</div>
							</div>
						</div>
					<?php }
					if(mysqli_num_rows($resProd) == 0) { ?>
						<div class="col-md-12">
							<div class="col-sm-12 search-text-title">ไม่พบสินค้าตามที่ค้นหา</div>
						</div>
					<?php }
					$conn->close();
					?>
					<!-- End prod-->
				</div>
			</div><!--col-md-9-->
		</div><!-- row -->
		<div class="row nav-bottom">
			<div class="col-md-12 text-center">
				<?php
					include('paging.php');
				?>
			</div>
		</div><!-- row nav-bottom -->
	</div><!--box -->
	<div style="height:40px;"></div><!--space-->
</div><!--container-->

</div><!--row-->
<?php include"inc/inc_footer.php"?>

</body>
</html>
