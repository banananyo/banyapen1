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
<script src="js/moment.min.js"></script>
<script src="js/numeral.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php include"inc/inc_header.php"?>
<?php include"inc/inc_slide.php"?>
<div class="row">
	<div class="container" style="background-color:#ffffff;">
    <div class="ctiter"><span>แจ้งการโอนเงิน</span></div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6">
        <?php
        	  require_once('connect.php');
            $sql = "SELECT * FROM `page` WHERE `name` = 'PAGE_PAYMENT'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

            echo $row['data'];

			
            if(isset($_POST['submit_payment_confirm'])){
              if($_POST['captchaInput'] == $_SESSION['detect_farang']){
                $inputOrderRef = $_POST['inputOrderRef'];
                $inputDate = $_POST['inputDate'];
                $bank = $_POST['bank_radio'];
                $inputTime = $_POST['inputTime'];
                $name = $_POST['inputName'];
                $tel = $_POST['inputTel'];
                $email = $_POST['inputEmail'];
                $price = $_POST['inputPrice'];
                $remark = $_POST['inputRemark'];
                $file_upload = $_FILES['inputFile'];

                // check order_ref
                $sql = "SELECT `orders_ref` FROM `orders` WHERE `orders_ref`='".$inputOrderRef."'";
                $res = $conn->query($sql);
                $num_rows = $res->num_rows;
                if($num_rows <= 0) {
                  echo '<script>alert("ไม่พบรหัสสั่งซื้อที่ท่านแจ้ง! กรุณาตรวจสอบให้ดีอีกครั้ง");</script>';
                } else {
                  $uploadOk = false;
                  $types = array('image/jpeg', 'image/jpg', 'image/png');
                  if (in_array($file_upload['type'], $types)) {
                    $target_dir = "admin/uploads/payment_confirm/";
                    $target_file = utf8_decode($target_dir . time().'.jpg');
                    $uploadOk = move_uploaded_file($file_upload["tmp_name"], $target_file);
                    if($uploadOk){
                      $sql = "INSERT INTO `payment_confirm`(`orders_ref`, `bank`, `payment_date`, `payment_time`, `name`, `tel`, `email`, `price`, `slip_url`, `text_remark`, `status`) ".
                      "VALUES ('$inputOrderRef', '$bank', '$inputDate', '$inputTime', '$name', '$tel', '$email', '$price', '$target_file', '$remark', 'WFC')";
                      $res = $conn->query($sql);
                      if($res) {
                        echo '<script>alert("แจ้งโอนสำเร็จแล้ว กรุณารอรับอีเมลการยืนยันจากบ้านยาเป็นหนึ่ง");</script>';
                      } else {
                        echo '<script>alert("การอัพโหลดไฟล์สลิปไม่สำเร็จ รายการแจ้งโอนถูกยกเลิก!!!");</script>';
                      }
                    }
                  } else {
                    echo '<script>alert("โปรดใช้ไฟล์ประเภท .png .jpg หรือ .jpeg เท่านั้น");</script>';
                  }
                }
                unset($_POST);

                
              } else {
                echo '<script>alert("รหัสป้องกัน(captcha) ไม่ถูกต้อง!!!");</script>';
              }
              
            }
        ?>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-contact">
          <h2>กรุณากรอกข้อมูลการโอนเงิน</h2>
          <!-- <iframe id="uploadtarget" name="uploadtarget" src="" style="width:0px;height:0px;border:0"></iframe> -->
          <form class="form-horizontal" id="frmUpload" action="paymentconfirm.php" method="post" enctype="multipart/form-data" 
          onsubmit="return validateForm()" name="payment_confirm_form"> 
            <input type="hidden" name="submit_payment_confirm" value="true"/>                       
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:30px;">
              <?php 
              
                require_once('unicode_reverse.php');
                
                $bankQuery = $conn->query("SELECT * FROM bank");
                $i=0;
                while($bank = $bankQuery->fetch_assoc()){
                  $bankValue=new stdClass();
                  $bankValue->bank = $bank['name'];
                  $bankValue->number = $bank['number'];
                  $bankValueJSON = htmlspecialchars(json_encode((object) $bankValue), ENT_QUOTES, 'UTF-8');
                  $bankValueJSON = unicode_decode($bankValueJSON);
              ?>
                <tr>
                  <?php 
                    if($i==0){
                      echo '<td width="30%" valign="middle"><font size="2" face="Tahoma, Geneva, sans-serif" color="#333333">
                      <b>บัญชีที่โอนเงิน  <span class="text-danger">*</span></b></font></td>';
                    }else {
                      echo '<td></td>';
                    }?>
                  <td width="3%" height="60">
                    <input name="bank_radio" type="radio" id="radio" value="<?php echo $bankValueJSON; ?>" checked style="width:20px; height:20px;" required>
                  </td>
                  <td width="27%" height="60" align="center">
                    <img src="admin/uploads/bank/<?php echo $bank['icon']; ?>" width="33" height="33">
                  </td>
                  <td width="40%" height="60"><font size="2" face="Tahoma, Geneva, sans-serif" color="#333333">
                    <?php echo $bank['name']; ?><br>
                    ชื่อบัญชี <b> <?php echo $bank['account_name']; ?></b> <br>
                    เลขที่บัญชี <b><?php echo $bank['number']; ?></b></font></font>
                  </td>
                </tr>
              <?php 
                  $i++;
                } 
              ?>
            </table>
            <div class="form-group">
              <div class="col-md-6">
                  <label for="inputEmail3" class="col-sm-4 control-label">รหัสสั่งซื้อ <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputOrderRef" name="inputOrderRef" placeholder="หมายเลขของคำสั่งซื้อ" required>
                  </div>
              </div><!--col-md-6-->
              <div class="col-md-6">
                  <label for="inputEmail3" class="col-sm-4 control-label">สลิป <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="file" class="form-control" id="inputFile" style="font-size: 12px !important;" name="inputFile" placeholder="อัพโหลดไฟล์" required>
                  </div>
              </div><!--col-md-6-->
            </div><!--form-group-->
            <div class="form-group row">
              <div class="col-md-6">
                  <label for="inputDate1" class="col-sm-4 control-label">วันที่ <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="" class="form-control" placeholder="เช่น 09/12/2017" id="inputDate" name="inputDate" required>
                  </div>
              </div><!--col-md-6-->
              <div class="col-md-6">
                <label for="inputTime1" class="col-sm-4 control-label">เวลา <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="" class="form-control" placeholder="เช่น 10:05 (24 ชั่วโมง)" id="inputTime" name="inputTime" required>
                </div>
              </div><!--col-md-6-->
            </div><!--form-group-->
            <div class="form-group">
              <div class="col-md-6">
                  <label for="inputName1" class="col-sm-4 control-label">ชื่อ-สกุล <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="" class="form-control" id="inputName" name="inputName" placeholder="" required>
                  </div>
              </div><!--col-md-6-->
                <div class="col-md-6">
                  <label for="inputTel1" class="col-sm-4 control-label">เบอร์โทร</label>
                  <div class="col-sm-8">
                    <input type="" class="form-control" id="inputTel" name="inputTel" placeholder="">
                  </div>
              </div><!--col-md-6-->
            </div><!--form-group-->
            <div class="form-group">
              <div class="col-md-6">
                  <label for="inputEmail3" class="col-sm-4 control-label">อีเมล <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="" required>
                  </div>
              </div><!--col-md-6-->
                <div class="col-md-6">
                  <label for="inputPrice" class="col-sm-4 control-label">จำนวนเงิน <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputPrice" name="inputPrice" placeholder="เช่น 2200" required>
                  </div>
              </div><!--col-md-6-->
            </div><!--form-group-->
            
      
              <div class="form-group">
                  <div class="col-md-12">
                    <textarea rows="3" class="form-control" placeholder="ข้อความหมายเหตุ" id="inputRemark" name="inputRemark" style="height:120px;"></textarea>
                  </div>
            </div><!--form-group-->
            <div class="form-group">
				<label for="captchaInput" class="col-sm-4"><img src="captcha.php" style="width: auto; height: 40px;"></label>
              	<div class="col-sm-4">
                	<input type="text" class="form-control" style="width: auto; height: 40px;" placeholder="รหัสป้องกัน (captcha)" id="captchaInput" name="captchaInput" required/>
				</div>
              	<div class="col-sm-4">
                	<button type="submit" class="btn-register-1"><i class="fa fa-pencil-square-o f-16"></i> ยืนยันข้อมูล</button>
              	</div>
            </div>
          </form>
        </div><!--form-contact-->
      </div>
    </div>
    <div style="height:40px;"></div><!--space-->
  </div><!--container-->
</div><!--row-->
<?php $conn->close(); ?>
<?php include"inc/inc_footer.php"?>
<script>
  (function(){
    $('#inputDate').val(moment().format('DD/MM/YYYY'));
    $('#inputTime').val(moment().format('HH:mm'));
  })();
function validateForm() {
	var captchaInput = document.forms["payment_confirm_form"]["captchaInput"].value;
    var bank_radio = document.forms["payment_confirm_form"]["bank_radio"].value;
    var inputOrderRef = document.forms["payment_confirm_form"]["inputOrderRef"].value;
    var inputDate = document.forms["payment_confirm_form"]["inputDate"].value;
    var inputTime = document.forms["payment_confirm_form"]["inputTime"].value;
    var inputName = document.forms["payment_confirm_form"]["inputName"].value;
    var inputPrice = document.forms["payment_confirm_form"]["inputPrice"].value;
    var inputEmail = document.forms["payment_confirm_form"]["inputEmail"].value;
    var inputFile = document.forms["payment_confirm_form"]["inputFile"].value;
    console.log(inputFile);
    if (
		captchaInput == "" ||
      bank_radio == "" ||
      inputOrderRef == "" || 
      inputDate == "" ||
      inputTime == "" ||
      inputName == "" ||
      inputPrice == "" ||
      inputFile == "" ||
      inputEmail == "") {
        alert("กรุณากรอกข้อมูลที่จำเป็น");
        return false;
    }
    console.log(numeral(inputPrice).value());
    if(!moment(inputDate, "DD/MM/YYYY").isValid()){
      alert('กรุณาใส่รูปแบบของวันที่ให้ถูกต้อง');
      return false;
    }
    if(!moment(inputTime, "HH:mm").isValid()){
      alert('กรุณาใส่รูปแบบของเวลาให้ถูกต้อง');
      return false;
    }
    if(numeral(inputPrice) === null || !numeral(inputPrice)){
      alert('กรุณากรอกรูปแบบจำนวนเงินให้ถูกต้อง');
      return false;
    }
    return true;
}
</script>
</body>
</html>