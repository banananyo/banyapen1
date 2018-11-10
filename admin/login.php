<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>เข้าสู่ระบบ - ระบบจัดการบ้านยา</title>

    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/angular.min.js"></script>


    <link rel="stylesheet" href="css/app.css" />
    <script src="js/app.js"></script>
    
    
</head>

<body ng-controller="login as controller">
    <div class="container">
            <div class="col-md-12">
                <div class="modal-dialog" style="margin-bottom:0">
                    <div class="modal-content">
                        <div class="panel-heading">
                            <h3 class="panel-title">ระบบจัดการบ้านยา</h3> 
                        </div>
                        <div class="panel-body">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="ชื่อผู้ใช้" name="username" ng-model="controller.field.username" type="text" autofocus="" ng-enter="controller.confirm();">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="รหัสผ่าน" name="password" ng-model="controller.field.password" type="password" value="" ng-enter="controller.confirm();">
                                    </div>
                                    <a href="javascript:;" ng-click="controller.confirm();" class="btn btn-sm btn-success"><i class="fa fa-sign-in"></i> เข้าสู่ระบบ</a>
                                    <a href="javascript:;" ng-click="controller.back();"  class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> กลับไปยังเว็บไซต์</a>
                                </fieldset>
                               
                            </form>
                        </div>
                    </div>
                    <div class="progress is-hidden"  style="margin-top: 2rem;" style="margin-top: 2rem;" >
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                    <div class="alert alert-danger is-hidden" id="LOGIN_ERR" style="margin-top: 2rem;" role="alert">
                        ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</body>

</html>