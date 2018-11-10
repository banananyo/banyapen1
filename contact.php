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
<?php //require_once 'ChromePhp.php'; ?>
<?php require_once "inc/inc_header.php"?>
<?php require_once "inc/inc_slide.php"?>
<?php require_once "sendmail.php" ?>
<div class="row">
	<div class="container" style="background-color:#ffffff;">
		<div class="ctiter"><span>ติดต่อเรา</span></div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div><h1><span style="color:#0c5d25;">บ้านยาเป็นหนึ่ง</span></h1>
					<?php
						require_once 'connect.php';
						$sql = "SELECT * FROM `page` WHERE `name` = 'PAGE_CONTACT'";
						$result = $conn->query($sql);
						$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

						echo $row['data'];
						$conn->close();
					?>
				</div>
			</div><!--col-md-6-->
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="form-contact">
					<?php
						if(isset($_POST['send_question'])){
							$form = new stdClass();
							$form->firstnameInput = $_POST['firstnameInput'];
							$form->lastNameInput = $_POST['lastNameInput'];
							$form->emailInput = $_POST['emailInput'];
							$form->telInput = $_POST['telInput'];
							$form->remarkInput = $_POST['remarkInput'];

							
							// ChromePhp::log($form);
							// ChromePhp::log($_SESSION['detect_farang']);
							// ChromePhp::log($_POST['captchaInput']);
							if($_POST['captchaInput'] == $_SESSION['detect_farang']){
								// ChromePhp::log('right');
								$dataemail = new stdClass();
								$dataemail->email = $form->emailInput;
								$dataemail->customer_name = ($form->firstnameInput).' '.($form->lastNameInput);
								$dataemail->text_info = $form->remarkInput;
								$dataemail->tel = $form->telInput;
								sendMail($dataemail, 'contact');
							} else {
								// ChromePhp::log('wrong');
								echo '<script>alert("รหัสป้องกัน(captcha) ไม่ถูกต้อง!!!");</script>';
							}
						}
					?>
					<h2>กรุณากรอกข้อมูลของท่าน</h2>
					<iframe id="uploadtarget" name="uploadtarget" src="" style="width:0px;height:0px;border:0"></iframe>
					<form class="form-horizontal"  id="frmUpload" action="contact.php" method="post" enctype="multipart/form-data"  onsubmit="return validateForm()" name="form_contact">
					
						<div class="form-group">
							<div class="col-md-6">
								<label for="firstnameInput" class="col-sm-3 control-label">ชื่อ</label>
								<div class="col-sm-9">
								<input type="text" class="form-control" id="firstnameInput" name="firstnameInput" placeholder="" required>
								</div>
							</div><!--col-md-6-->
							<div class="col-md-6">
								<label for="lastNameInput" class="col-sm-3 control-label">นามสกุล</label>
								<div class="col-sm-9">
								<input type="text" class="form-control" id="lastNameInput" name="lastNameInput" placeholder="" required>
								</div>
							</div><!--col-md-6-->
						</div><!--form-group-->
						<div class="form-group">
							<div class="col-md-6">
								<label for="emailInput" class="col-sm-3 control-label">อีเมล</label>
								<div class="col-sm-9">
								<input type="email" class="form-control" id="emailInput" name="emailInput" placeholder=""  required>
								</div>
							</div><!--col-md-6-->
							<div class="col-md-6">
								<label for="telInput" class="col-sm-3 control-label">เบอร์โทรศัพท์</label>
								<div class="col-sm-9">
								<input type="text" class="form-control" id="telInput" name="telInput" placeholder="" required>
								</div>
							</div><!--col-md-6-->
						</div><!--form-group-->
					
						<div class="form-group">
								<div class="col-md-12">
								<textarea rows="3" class="form-control" placeholder="ข้อความ" id="remarkInput" name="remarkInput" style="height:120px;" required></textarea>
								</div>
						</div><!--form-group-->
						<div class="form-group">
							<label for="captchaInput" class="col-sm-3"><img src="captcha.php" style="width: auto; height: 40px;"></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" style="width: auto; height: 40px;" placeholder="รหัสป้องกัน (captcha)" id="captchaInput" name="captchaInput" required />
							</div>
							<div class="col-lg-offset-1 col-sm-4">
								<button type="submit" class="btn-register-1" style="width: auto; height: 40px;" name="send_question"><i class="fa fa-pencil-square-o f-16"></i> ส่งคำถาม</button>
							</div>
						</div>
					</form>
				</div><!--form-contact-->
		</div><!--col-md-6-->
		<div class="row" style="margin-top:40px; padding:0px 15px;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5448.636920704652!2d102.12756554590874!3d15.060936829214691!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTXCsDAzJzM2LjgiTiAxMDLCsDA3JzQxLjAiRQ!5e0!3m2!1sth!2sth!4v1472057817122" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe></div>
		<div style="height:40px;"></div><!--space-->
	</div><!--container-->
</div><!--row-->

<?php include"inc/inc_footer.php"?>
<script>
	function validateForm(){
		// console.log('validate');
		var firstnameInput = document.forms["form_contact"]["firstnameInput"].value;
		var lastNameInput = document.forms["form_contact"]["lastNameInput"].value;
		var emailInput = document.forms["form_contact"]["emailInput"].value;
		var telInput = document.forms["form_contact"]["telInput"].value;
		var remarkInput = document.forms["form_contact"]["remarkInput"].value;
		var captchaInput = document.forms["form_contact"]["captchaInput"].value;
		if(firstnameInput === '' ||
		lastNameInput === '' ||
		emailInput === '' ||
		telInput === '' ||
		remarkInput === '' ||
		captchaInput === ''){
			alert('โปรดกรอกข้อมูลให้ครบทุกช่อง');
			return false;
		}
		return true;
	}	
</script>	
</body>
</html>