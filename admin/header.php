<div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-left">
			<li><a href="index.php?module=page&mode=manage"><i class="fa fa-file-o"></i> จัดการหน้าเว็บ</a></li>
            <li class="dropdown ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="fa fa-picture-o"></i> แกลเลอรี
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class=""><a href="index.php?module=gallery&mode=manage">จัดการรูปภาพ</a></li>
                        <li class=""><a href="index.php?module=gallery&mode=add">เพิ่มรูปภาพ</a></li>
                    </ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="fa fa-list"></i> หมวดหมู่
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class=""><a href="index.php?module=category&mode=manage">จัดการหมวดหมู่สินค้า</a></li>
                        <li class=""><a href="index.php?module=category&mode=add">เพิ่มหมวดหมู่สินค้า</a></li>
                    </ul>
				</li>
                
                <li class="dropdown ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="fa fa-shopping-bag"></i> สินค้า
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class=""><a href="index.php?module=product&mode=manage">จัดการสินค้า</a></li>
                        <li class=""><a href="index.php?module=product&mode=add">เพิ่มสินค้า</a></li>
                    </ul>
				</li>
                <li class="dropdown ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="fa fa-user"></i> สมาชิก
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class=""><a href="index.php?module=member&mode=manage">จัดการสมาชิก</a></li>
                        <li class=""><a href="index.php?module=member&mode=add">เพิ่มสมาชิก</a></li>
                        <li class="divider"></li>
                        <li class=""><a href="index.php?module=member&mode=confirm">ยืนยันสมาชิก</a></li>
                    </ul>
				</li>
                <li class="dropdown ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="fa fa-credit-card"></i> บิลสินค้า
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class=""><a href="index.php?module=bill&mode=manageBank">จัดการธนาคาร</a></li>
                        <li class=""><a href="index.php?module=bill&mode=orders&get=ALL">รายการสั่งซื้อ</a></li>
                        <li class=""><a href="index.php?module=bill&mode=confirm">รายการแจ้งชำระเงิน</a></li>
                        <li class=""><a href="index.php?module=bill&mode=ems">รหัสการจัดส่ง</a></li>
                    </ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="javascript:;" target="_blank">ยินดีต้อนรับ <?php echo $_SESSION['BANYA_ADMIN_USERNAME'] ?></a></li>
				<li class="dropdown ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						จัดการสมาชิก
						<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="dropdown-header">ตั้งค่า</li>
							<li><a href="index.php?mode=password">เปลี่ยนรหัสผ่าน</a></li>
							<li class="divider"></li>
							<li><a href="index.php?mode=logout">ออกจากระบบ</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->