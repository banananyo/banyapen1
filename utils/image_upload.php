<?php 

function upload($target_dir, $file_upload) {
    $uploadOk = false;
    $types = array('jpeg', 'jpg', 'png');
    $path = $file_upload['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if (in_array($ext, $types)) {
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0775, true);
        }
        $target_file = utf8_decode($target_dir . time().'.'.$ext);
        $uploadOk = move_uploaded_file($file_upload["tmp_name"], $target_file);
        if ($uploadOk) {
            return $target_file;
        } else {
            return null;
        }
    } else if(!in_array($ext, $types)) {
        echo '<script>alert("โปรดใช้ไฟล์ประเภท .png .jpg หรือ .jpeg เท่านั้น");</script>';
        return null;
    } else {
        echo '<script>alert("การอัพโหลดไฟล์รูปผิดพลาด กรุณาติดต่อแอดมิน");</script>';
        return null;
    }
}

?>