
<?php
    if(!isset($_GET['id'])) {
        exit("Access Denied");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM `product` WHERE `id` = $id";
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
    <title>แก้ไขสินค้า - ระบบจัดการบ้านยา</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/angular.min.js"></script>


    <link rel="stylesheet" href="css/app.css" />
    <script src="js/app.js"></script>
    
    
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
    <script src="module/product/core.js"></script>
	<div class="container main-container" ng-controller="edit as controller">
    <div class="col-md-4 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    เมนู
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="index.php?module=product&mode=manage" class="list-group-item active">
                            จัดการสินค้า
                        </a>
                        <a href="index.php?module=product&mode=add" class="list-group-item">เพิ่มสินค้า</a>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-md-8 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    แก้ไขสินค้า - <?php echo $row['name'] ?>
                </div>
                <div class="panel-body">
                <?php if(!isset($_POST['name']) && !isset($_POST['price']) && !isset($_POST['stock']) && !isset($_POST['category_id'])) { ?>
                    <form action="" method="post"  enctype="multipart/form-data">
                    <div ng-init="controller.field.name = '<?php echo $row['name'] ?>';
                    controller.field.price = <?php echo $row['price'] ?>;
                    controller.field.description = '<?php echo $row['description'] ?>';
                    controller.field.sdescription = '<?php echo $row['sdescription'] ?>';
                    controller.field.stock = <?php echo $row['stock'] ?>;
                    controller.field.category_id = '<?php echo $row['category_id'] ?>';
                    controller.field.image = '<?php echo $row['image'] ?>';
                    "></div>
                    <div class="form-group">
                        <label>ชื่อ</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อสามัญ" ng-model="controller.field.name">
                    </div>
                    <div class="form-group">
                        <label>ราคา</label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="ราคา" ng-model="controller.field.price">
                    </div>
                    <div class="form-group">
                        <label>จำนวนในสต็อก</label>
                        <input type="number" name="stock" class="form-control" id="stock" placeholder="จำนวนในสต็อก" ng-model="controller.field.stock">
                    </div>
                    <div class="form-group">
                        <label>หมวดหมู่</label>
                        <?php
                                // $category_sql = "SELECT * FROM `category`";
                                // $category_result = $conn->query($category_sql);
                                // $category_row = mysqli_fetch_all($category_result,MYSQLI_ASSOC);
                                $category_sql = "SELECT * FROM `category`";
                                $category_result = $conn->query($category_sql);
                                $array = array();
                                while($row = $category_result->fetch_assoc())
                                    $array[] = $row;
                                // $count = $result->num_rows;
                                $category_row = $array;
                        ?>
                        <select name="category_id" class="form-control" id="category_id" ng-model="controller.field.category_id">
                            <option value=""> -- เลือก --</option>
                            <?php 
                                foreach($category_row as $key => $value) {
                                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>รายละเอียด แบบย่อ</label>
                        <textarea type="text" name="sdescription" class="form-control" id="sdescription" placeholder="รายละเอียด" ng-model="controller.field.sdescription"></textarea>
                    </div>
                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea type="text" name="description" class="form-control" id="description" placeholder="รายละเอียด" ng-model="controller.field.description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>รูป</label><br />
                        <label>(คำแนะนำ ภาพควรมีขนาดกว้าง-ยาวเท่ากัน และไม่เกิน 800px | พื้นที่ไม่เกิน 2MB)</label>
                        <img ng-src="uploads/{{controller.field.image}}" class="img-responsive" alt=""><br />
                        <input type="file" accept="image/*" app-filereader name="image" id="image" ng-model="controller.field.image">

                        
                    </div>
                    <button type="submit" ng-disabled="controller.check() == false" class="btn btn-default">ตกลง</button>
                    <div class="alert alert-danger is-hidden" id="LOGIN_ERR" style="margin-top: 2rem;" role="alert">
                        กรอกข้อมูลให้ครบถ้วน
                    </div>
                    </form>
    
                        <?php } else  { 
        
                            $target_dir = "uploads/";
                            $newfilename= date('dmYHis').".jpg";
                            $target_file = $target_dir . basename($newfilename);
                            $uploadOk = 1;
                            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                            // Check if image file is a actual image or fake image
                            $name = $_POST['name'];
                            $description = $_POST['description'];
                            $sdescription = $_POST['sdescription'];
                            
                            $stock = $_POST['stock'];
                            $price = $_POST['price'];
                            $category_id = $_POST['category_id'];
                            if($_FILES['image']["name"] != "") {
                                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                                $image =  basename($newfilename);
                                $sql = "UPDATE `product` SET `name` = '$name', `price` = '$price', `description` = '$description',`sdescription` = '$sdescription', `image` = '$image', `stock` = '$stock', `category_id` = '$category_id' WHERE `product`.`id` = $id;";
                            }else {
                                $sql = "UPDATE `product` SET `name` = '$name', `price` = '$price', `description` = '$description',`sdescription` = '$sdescription', `stock` = '$stock', `category_id` = '$category_id' WHERE `product`.`id` = $id;";
                            }
                            
                            

                            
                           
                            $result = $conn->query($sql);
                            if($result) {
                                $resultTxt = "สำเร็จ";
                            }else {
                                $resultTxt = "ไม่สำเร็จ";
                            }
                            
                        ?>
    
                        <div class="is-center">
                            <h4>แก้ไขสินค้า <?php echo $resultTxt; ?> </h4>
                              <a href="index.php?module=product&mode=manage">คลิกเพื่อกลับไปยังหน้าจัดการ</a>
                        </div>
    
                        <?php }  ?>
                </div>
            </div>
		</div>
	
	</div>
</body>

</html>