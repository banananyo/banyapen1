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
	<!-- <script type="text/javascript" src="fancybox2/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="fancybox2/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="fancybox2/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="fancybox2/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="fancybox2/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
	<link rel="stylesheet" type="text/css" href="fancybox2/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link rel="stylesheet" type="text/css" href="fancybox2/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<link rel="stylesheet" type="text/css" href="fancybox2/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="fancybox2/index.js"></script> -->
	<style type="text/css">
	a:link {
		color: #666;
	}
	a:hover {
		color: #666;
	}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php include('inc/inc_header.php'); ?>
<?php include('inc/inc_slide.php'); ?>
<div class="row">
	<div class="container" style="background-color:#ffffff;">
		<div class="ctiter"><span>หน้าแรก</span></div>
		<div class="row">
			<div class="col-md-12">
			<?php
				require_once('connect.php');
				$sql = "SELECT * FROM `page` WHERE `name` = 'PAGE_INDEX'";
				$result = $conn->query($sql);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				echo $row['data'];
				$conn->close();
			?>
			</div><!-- Col6 -->
		</div><!-- Row -->
		
		<div style="height:40px;"></div>
		
  </div><!--container-->
</div><!--row-->
<?php include"inc/inc_footer.php"?>
</body>
</html>