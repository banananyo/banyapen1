<?php
    session_start();
    if(isset($_GET['mode'])) {
        $mode = $_GET['mode'];
    }else {
        $mode = false;
    }
    if(isset($_GET['module'])) {
        $module = $_GET['module'];
    }else {
        $module = false;
    }
    
    if(check() && !$mode) {
        require_once "manage.php";
    }elseif(check() && $mode == "password") {
        require_once "../connect.php";
        require_once "password.php";
    }elseif(check() && $mode == "logout") {
        require_once "logout.php";
    }elseif(check() && isset($mode) && isset($module)) {
        require_once "../connect.php";
        require_once "module/".$module."/".$mode.".php";
    }else {
        require_once "login.php";
    }
    
function check() {
    if(isset($_SESSION['BANYA_ADMIN_LOGIN']) && isset($_SESSION['BANYA_ADMIN_USERNAME']) && isset($_SESSION['BANYA_ADMIN_TIME'])) {
        return true;
    }else {
        return false;
    }
}