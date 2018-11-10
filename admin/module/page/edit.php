
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `page` WHERE `id` = $id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>แก้ไขหน้าเว็บ - ระบบจัดการบ้านยา</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/angular.min.js"></script>


    <link rel="stylesheet" href="css/app.css" />
    <script src="js/app.js"></script>

    <script src="ckeditor/ckeditor.js"></script>

    
    
</head>

<body ng-controller="content as controller">
  
 
    <nav class="navbar navbar-default navbar-static-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				ระบบจัดการบ้านยา
			</a>
		</div>
        <?php 
            require_once "header.php";
        ?>
    
	</nav>
    <script src="module/page/core.js"></script>
	<div class="container main-container" ng-controller="edit as controller">
		<div class="col-md-12 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    แก้ไขหน้าเว็บ - <?php echo $row['name'] ?>
                </div>
                <div class="panel-body">
                <?php if(!isset($_POST['hint']) && !isset($_POST['data'])) { ?>
                    <form action="" method="post">
                    <div ng-init="controller.field.hint = '<?php echo $row['hint'] ?>';
                    "></div>
                    <div class="form-group">
                        <label>ชื่อ</label>
                        <input type="text" name="hint" class="form-control" id="hint" placeholder="ชื่อ" readonly ng-model="controller.field.hint">
                    </div>
                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea type="text" name="data" class="form-control" id="data" placeholder="รายละเอียด" >
                        <?php echo $row['data'] ?>
                        </textarea>
                        <script>
                            let editor = CKEDITOR.replace('data', {
                                language: 'th',
                                filebrowserImageBrowseUrl:'kcfinder/browse.php?opener=ckeditor&type=images',
                                filebrowserImageUploadUrl:'kcfinder/upload.php?opener=ckeditor&type=images'

                            } );
                            // CKFinder.setupCKEditor( editor );

                        </script>
                        
                    </div>
                   
                    <button type="submit" ng-disabled="controller.check() == false" class="btn btn-default">ตกลง</button>
                    <div class="alert alert-danger is-hidden" id="LOGIN_ERR" style="margin-top: 2rem;" role="alert">
                        กรอกข้อมูลให้ครบถ้วน
                    </div>
                    </form>
    
                        <?php } else  { 
                            $name = $_POST['hint'];
                            $data = $_POST['data'];
                            $sql = "UPDATE `page` SET `hint` = '$name', `data` = '$data' WHERE `page`.`id` = $id;";
                           
                            $result = $conn->query($sql);
                            if($result) {
                                $resultTxt = "สำเร็จ";
                            }else {
                                $resultTxt = "ไม่สำเร็จ";
                            }
                            
                        ?>
    
                        <div class="is-center">
                            <h4>แก้ไขหน้าเว็บ <?php echo $resultTxt; ?> </h4>
                              <a href="index.php?module=page&mode=manage">คลิกเพื่อกลับไปยังหน้าจัดการ</a>
                        </div>
    
                        <?php }  ?>
                </div>
            </div>
		</div>
	
	</div>
</body>

</html>