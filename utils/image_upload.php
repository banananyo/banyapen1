<?php 

function upload($target_dir, $file_upload) {
    $uploadOk = false;
    $types = array('image/jpeg', 'image/jpg', 'image/png');
    if (in_array($file_upload['type'], $types)) {
        $path = $file_upload['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
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
    } else {
        echo '<script>alert("โปรดใช้ไฟล์ประเภท .png .jpg หรือ .jpeg เท่านั้น");</script>';
        return null;
    }
}

?>