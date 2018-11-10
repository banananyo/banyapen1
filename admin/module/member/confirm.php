<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "UPDATE `member` SET `status` = '1' WHERE `member`.`id` = $id;";
        $result = $conn->query($sql);
    }
?>
<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>จัดการสมาชิก - ระบบจัดการบ้านยา</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" />

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/angular.min.js"></script>


    <link rel="stylesheet" href="css/app.css" />
    <script src="js/app.js"></script>


</head>

<body>


    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
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
    <script src="module/member/core.js"></script>
    <div class="container main-container" ng-controller="manage as controller">
        <div class="col-md-4 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    เมนู
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="index.php?module=member&mode=manage" class="list-group-item">
                            จัดการสมาชิก
                        </a>
                        <a href="index.php?module=member&mode=add" class="list-group-item">เพิ่มสมาชิก</a>
                        <a href="index.php?module=member&mode=confirm" class="list-group-item active">
                            ยันยันสมาชิก
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    จัดการสมาชิก
                    <form action="" method="get">
                        <div class="input-group">
                        <input type="text" name="filter" class="form-control" placeholder="ค้นหา..">
                        <input type="hidden" name="module" value="member">
                        <input type="hidden" name="mode" value="confirm">
                        <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">ค้นหา</button>
                        </span>
                    </div><!-- /input-group -->
                    </form>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <tr>
                            <td class="col-md-1 is-center">#</td>
                            <td class="col-md-3 is-center">username</td>
                            <td class="col-md-3 is-center">ชื่อผู้ใช้</td>
                            <td class="col-md-3 is-center">จัดการ</td>
                        </tr>

                        <?php
                        $start = 0;
                        $page = !isset($_GET['page']) ? 1:$_GET['page'];
                        $limit = !isset($_GET['limit']) ? 10:$_GET['limit'];
                        $start = ($page*$limit) - $limit;
                        $filter = "";
                        if(isset($_GET['filter'])) {
                            $filter = $_GET['filter'];
                            $filter = "AND `username` LIKE '%$filter%' OR `name` LIKE '%$filter%'";
                        }

                        $sql_count = $conn->query("SELECT COUNT(*) FROM `category`");
                        $count = $sql_count->fetch_row();
                        $count = $count[0];

                        $sql = "SELECT * FROM `member` WHERE `status` = 0 $filter LIMIT $start,$limit";
                        $result = $conn->query($sql);
                        $array = array();
                        while($row = $result->fetch_assoc())
                            $array[] = $row;
                        // $count = $result->num_rows;
                        $row = $array;
                        // $count = $result->num_rows;
                        
                        foreach($row as $key => $value) {
                    ?>
                            <tr>
                                <td>
                                    <?php echo $limit * $page - ($limit - 1) + $key; ?>
                                </td>
                                <td>
                                    <?php echo $value['username']; ?>
                                </td>
                                <td>
                                    <?php echo $value['name']; ?>
                                </td>
                                <td class="is-center">
                                    <a href="index.php?module=member&mode=confirm&id=<?php echo $value['id'] ?>" class="btn btn-success">ยืนยันสมาชิก</a>
                                </td>
                            </tr>

                            <?php } ?>
                    </table>
                    <?php
                        if(isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $sql = "UPDATE `member` SET `status` = '1' WHERE `member`.`id` = $id;";
                            $result = $conn->query($sql);
                            if($result) {
                                echo "<div class=\"alert alert-success\" role=\"alert\">ยืนยันสมาชิกเสร็จสิ้น</div>";
                            }else {
                                echo "<div class=\"alert alert-danger\" role=\"alert\">ยืนยันสมาชิกไม่สำเร็จ</div>";
                            }
                        }
                      
                    ?>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            </li>
                            <?php 
                            $maxLoop = ($page == 1) ? ($count/$limit)+1:($count/$limit);
                            for($i=1;$i<=$maxLoop;$i++) {
                                 $textLimit = "";
                                if(isset($_GET['limit'])) {
                                    $textLimit = "&limit=$limit";
                                }
                                echo " <li><a href=\"index.php?module=member&mode=manage&page=$i$textLimit\">$i</a></li>";
                            } ?>
                           
                            <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                            </li>
                        </ul>
                    </nav>

                    <div class="modal fade" id="remove" tabindex="-1" role="dialog" >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                   <h4> ยืนยันการลบ  {{ controller.tmp.name }}</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" ng-click="controller.cancelRemove();"  class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                    <button type="button" ng-click="controller.goRemove();" class="btn btn-danger">ตกลง</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>