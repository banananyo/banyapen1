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
	<div class="ctiter"><span>โปรโมชั่น</span></div>
    <div class="row"><div class="col-md-12">
    <?php
    require_once 'connect.php';
        $sql = "SELECT * FROM `page` WHERE `name` = 'PAGE_PROMOTION'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        echo $row['data'];
        $conn->close();
    ?>
    </div></div>
    <div style="height:40px;"></div><!--space-->
    </div><!--container-->
</div><!--row-->

<?php include "inc/inc_footer.php"?>

</body>
</html>