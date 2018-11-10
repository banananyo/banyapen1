<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>จัดการรูปภาพ - ระบบจัดการบ้านยา</title>

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
    <script src="module/bill/core.js"></script>
    <div class="container main-container" ng-controller="manageBank as controller">
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
            <div class="pull-right" style="margin-top:0.5rem;margin-right:0.5rem;">
                <a class="btn btn-primary" href="index.php?module=bill&mode=addBank"><i class="fa fa-plus"></i> เพิ่มธนาคาร</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    จัดการธนาคาร

                    <div class="pull-right col-xs-4" style="margin-top: -0.6rem">
                    
                    <form action="" method="get">
                        <div class="input-group">
                        <input type="text" name="filter" class="form-control" placeholder="ค้นหา..">
                        <input type="hidden" name="module" value="gallery">
                        <input type="hidden" name="mode" value="manage">
                        <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">ค้นหา</button>
                        </span>
                    </div><!-- /input-group -->
                    </form>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <tr>
                            <td class="col-md-1 is-center">#</td>
                            <td class="col-md-2 is-center">รูป</td>
                            <td class="col-md-3 is-center">ธนาคาร</td>
                            <td class="col-md-3 is-center">ตัวย่อ</td>
                            <td class="col-md-3 is-center">จัดการ</td>
                        </tr>

                        <?php
                       $start = 0;
                       $page = !isset($_GET['page']) ? 1:$_GET['page'];
                       $limit = !isset($_GET['limit']) ? 10:$_GET['limit'];
                       $start = ($page*$limit) - $limit;
                       
                       $sql_count = $conn->query("SELECT COUNT(*) FROM `bank`");
                       $count = $sql_count->fetch_row();
                       $count = $count[0];

                       $filter = "1";
                       if(isset($_GET['filter'])) {
                           $filter = $_GET['filter'];
                           $filter = "`name` LIKE '%$filter%'";
                       }


                        $sql = "SELECT * FROM `bank` WHERE $filter LIMIT $start,$limit";
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
                                    <?php echo "<img class='img-responsive' src='uploads/bank/".$value['icon']."' />"; ?>
                                </td>
                                <td class="is-center">
                                    <?php echo $value['name']; ?>
                                </td>
                                <td class="is-center">
                                    <?php echo $value['sname']; ?>
                                </td>
                                <td>
                                    <a href="index.php?module=bill&mode=editBank&id=<?php echo $value['id'] ?>" class="btn btn-default">แก้ไข</a>
                                    <a href="javascript:;" ng-click="controller.remove('<?php echo addslashes($value['name']); ?>',<?php echo $value['id'] ?>)" class="btn btn-danger">ลบ</a> 
                                </td>
                            </tr>

                            <?php } ?>
                    </table>

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                            <a class="<?php echo 1 == $page ? 'is-hidden':"" ?>" href="index.php?module=manageBank&mode=manage&page=<?php echo isset($_GET['page']) ? $_GET['page']-1:2; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            </li>
                            <?php 
                            $maxLoop = ($page == 1) ? ($count/$limit)+1:($count/$limit);
                            for($i=1;$i<=ceil($count / $limit);$i++) {
                                 $textLimit = "";
                                if(isset($_GET['limit'])) {
                                    $textLimit = "&limit=$limit";
                                }
                                echo " <li class='".($page == $i ? 'active':'')."'><a href=\"index.php?module=manageBank&mode=manage&page=$i$textLimit\">$i</a></li>";
                            } ?>
                           
                            <li>
                            <a class="<?php echo ceil($count / $limit) == $page ? 'is-hidden':"" ?>" href="index.php?module=manageBank&mode=manage&page=<?php echo isset($_GET['page']) ? $_GET['page']+1:2; ?>" aria-label="Next">
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