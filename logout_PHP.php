<?php 
if(!isset($_SESSION)){
    session_start();
}
unset($_SESSION);
session_destroy();
echo "<script>window.location.href='index.php';</script>";
?>