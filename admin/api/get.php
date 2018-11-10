<?php
session_start();

if (!isset($_SERVER['HTTP_REFERER'])) {
    exit("Access Denied");
}

require "../../connect.php";

if(file_get_contents('php://input')) {
    $request = (array)json_decode(file_get_contents('php://input'));
    if(is_null($request)) {
        exit("Access Denied");
    }

    $mode = $request['mode'];
    if(isset($request['mode'])) {
        if($mode == "LOGIN") {
            $username = $request['data']->username;
            $password = md5($request['data']->password);
            $sql = "SELECT * FROM `member` WHERE `username` LIKE '$username' AND `password` LIKE '$password' AND `level` LIKE '1'";
            $result = $conn->query($sql);
            $count = $result->num_rows;
            if($count == 1) {
                $_SESSION['BANYA_ADMIN_LOGIN'] = 1;
                $_SESSION['BANYA_ADMIN_USERNAME'] = $username;
                $_SESSION['BANYA_ADMIN_TIME'] = date("Y-m-d H:i:s");
                echo json_encode(array("status" => true));
            }else {
                echo json_encode(array("status" => false));
            }
            
        }else {
            exit("Access Denied");
        }
    }else {
        exit("Access Denied");
    }
   
    
    
}

