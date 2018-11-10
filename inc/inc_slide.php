<div class="container" style="background-color:#ffffff;">
    <div class="row" style="padding-left:1px; padding-right:1px; margin-top:-1px;">
        <div id="slide-main" class="owl-carousel owl-theme">
            <?php
                require_once 'connect.php';
                $sql = "SELECT * FROM `gallery` ORDER BY `order` ASC";
                $result = $conn->query($sql);
                $array = array();
                while($row = $result->fetch_assoc()){
                    $array[] = $row;
                }
                $row = $array;
                foreach($row as $key => $value) {
                    echo "<div class=\"item\"><img src=\"admin/uploads/".$value['image']."\" class=\"img-responsive\" /></div>";
                }
            ?>
            

        </div><!--slide-main-->
    </div><!--row-->
</div><!--container-->

<script>
$(document).ready(function() {
  $("#slide-main").owlCarousel({
 
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
	  autoPlay:true
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
  });
});
</script>