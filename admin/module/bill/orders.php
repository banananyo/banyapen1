<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>จัดการหมวดหมู่ - ระบบจัดการบ้านยา</title>

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
    <script src="module/category/core.js"></script>
    <div class="container main-container" ng-controller="manage as controller">
        <div class="col-md-4 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    เมนู
                </div>
                <div class="panel-body">
                    <div class="list-group">
                    <?php 
                            require_once "nav.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    รายการสั่งซื้อ
                    <div class="pull-right col-md-4" style="margin-top: -0.6rem">
                    <form action="" method="get">
                        <div class="input-group">
                        <input type="text" name="filter" class="form-control" placeholder="ค้นหา..">
                        <input type="hidden" name="module" value="category">
                        <input type="hidden" name="mode" value="manage">
                        <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">ค้นหา</button>
                        </span>
                    </div><!-- /input-group -->
                    </form>
                    </div>
                </div>
                <div class="panel-body">
                    <a class="btn btn-default" href="index.php?module=bill&mode=orders&get=ALL">
                        ทั้งหมด
                    </a>
                    <!-- <a class="btn btn-default" href="index.php?module=bill&mode=orders&get=WFC">
                        รอจัดส่ง
                    </a>
                    <a class="btn btn-default" href="index.php?module=bill&mode=orders&get=WFT">
                        รอโอน
                    </a> -->
                    <a class="btn btn-default" href="index.php?module=bill&mode=orders&get=CMP">
                        รอผู้ขายอนุมัติ
                    </a>
                    <a class="btn btn-default" href="index.php?module=bill&mode=orders&get=REJ">
                        ไม่รับคำสั่งซื้อ
                    </a>
                    <hr>
                    <table class="table table-condensed table-hover">
                        <tr>
                            <td class="col-md-1">#</td>
                            <td class="col-md-4">หมายเลขบิล</td>
                            <td class="col-md-2">ผู้สั่ง</td>
                            <td class="col-md-2">สถานะ</td>
                            <td class="col-md-2">จัดการ</td>
                        </tr>

                        <?php
                        $start = 0;
                        $page = !isset($_GET['page']) ? 1:$_GET['page'];
                        $limit = !isset($_GET['limit']) ? 10:$_GET['limit'];
                        $start = ($page*$limit) - $limit;

                        $sql_count = $conn->query("SELECT COUNT(*) FROM `orders`");
                        $count = $sql_count->fetch_row();
                        $count = $count[0];


                        if(isset($_GET['get'])) {
                            $get = $_GET['get'];
                            $filter = "`status` LIKE '$get'";
                            $filter = $get=="ALL" ? "1":$filter;
                        }else {
                            $filter = "`status` LIKE 'WFC'";
                        }

                        if(isset($_GET['filter'])) {
                            $filter = $_GET['filter'];
                            $filter = "`orders_ref` LIKE '%$filter%'";
                        }

                       

                        $sql = "SELECT * FROM `orders` WHERE $filter LIMIT $start,$limit";
                        $result = $conn->query($sql);
                        // $row = $result->fetch_all(MYSQLI_ASSOC);
                        $array = array();
                        while($row = $result->fetch_assoc())
                            $array[] = $row;
                        // $count = $result->num_rows;
                        $row = $array;
                        foreach($row as $key => $value) {
                    ?>
                            <tr>
                                <td>
                                    <?php echo $limit * $page - ($limit - 1) + $key; ?>
                                </td>
                                <td>
                                    <a href="index.php?module=bill&mode=view&id=<?php echo $value['id'] ?>" ><?php echo $value['orders_ref']; ?></a>
                                </td>
                                <td>
                                    <?php 
                                        echo getUsername($conn,$value['member_id']);
                                    ?>
                                </td>
                                <td>
                                <?php 
                                    switch($value['status']) {
                                        case 'SHP': 
                                            echo '<span class="label label-success">จัดส่งแล้ว</span>';
                                            break;
                                        case 'WFS': 
                                            echo '<span class="label label-info">รอการจัดส่ง</span>';
                                            break;
                                        case 'REJ': 
                                            echo '<span class="label label-danger">ปฏิเสธ</span>';
                                            break;
                                        case 'WFT': 
                                            echo '<span class="label label-warning">รอโอน</span>';
                                            break;
                                        case 'WFC': 
                                            echo '<span class="label label-warning">รอการยืนยัน</span>';
                                            break;
                                        default: break;
                                    }
                                ?>
                                </td>
                                <td>
                                    <!-- <a href="index.php?module=bill&mode=confirm_order&id=<?php //echo $value['id'] ?>"  class="btn btn-success <?php //echo ($value['status'] == "WFC" ? "":"is-hidden") ?>">&#10004;</a>  -->
                                    <?php if($value['status'] == 'WFT') {?>
                                        <!-- <a ng-click="controller.reject('<?php //echo $value['id'] ?>')" class="btn btn-danger">&#10006;</a>  -->
                                        <a href="index.php?module=bill&mode=action_reject&id=<?php echo $value['id'] ?>" class="btn btn-danger">&#10006;</a> 
                                    <?php } ?>
                                </td>
                            </tr>

                            <?php } ?>
                    </table>

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            </li>
                            <?php 
                            $params = array();
                            parse_str($_SERVER['QUERY_STRING'], $params);
                            $get='';
                            if(isset($params['get'])) {
                                $get = '&get='.$params['get'];
                            }
                            $maxLoop = ($page == 1) ? ($count/$limit)+1:($count/$limit);
                            for($i=1;$i<=$maxLoop;$i++) {
                                 $textLimit = "";
                                if(isset($_GET['limit'])) {
                                    $textLimit = "&limit=$limit";
                                }
                                echo " <li><a href=\"index.php?module=bill&mode=orders".$get."&page=$i$textLimit\">$i</a></li>";
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