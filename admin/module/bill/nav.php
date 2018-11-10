<?php
    $get = $_GET;
?>
<div class="list-group">
    <a href="index.php?module=bill&mode=manageBank" class="list-group-item <?php echo  in_array($get['mode'],array('manageBank',"addBank","editBank","removeBank")) == true ?  "active":"" ?>">
        จัดการธนาคาร
    </a>
    <a href="index.php?module=bill&mode=orders&get=ALL" class="list-group-item <?php echo  in_array($get['mode'],array('orders')) == true ?  "active":"" ?>">
        รายการสั่งซื้อ
    </a>
    <a href="index.php?module=bill&mode=confirm" class="list-group-item <?php echo  in_array($get['mode'],array('view_bill',"confirm","confirm_bill","rejected_bill")) == true ?  "active":"" ?>">
        รายการแจ้งชำระ
    </a>
    <a href="index.php?module=bill&mode=ems" class="list-group-item <?php echo  in_array($get['mode'],array('ems',"edit_ems","view")) == true ?  "active":"" ?>">
        รหัสการจัดส่ง
    </a>
    
</div>