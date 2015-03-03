
<div class="container canvas">
   <div class="topbar" data-scrollspy="scrollspy">
      <div class="topbar-inner">
        <div class="container canvas">
          <span class="brand"><?php echo $site_name; ?> <span style="font-size:10px;"><?php echo $version; ?></span></span>
            <div class="navbar pull-left" style="margin-top: 7px;">
              <a href="viewdeal.php" class="btn primary">Dashboard</a>
            
              <a href="createdeal.php" class="btn primary">Create Deal</a>

              <a href="viewusers.php" class="btn primary">View Users</a>
            </div>
           <div class="navbar pull-right" style="margin-top: 7px;">
		    <?php if($_SESSION['admin_id'] == 1){?>
			<a href="admin.php" class="btn success">Admin</a>
			<?php } ?>
            <a href="logout.php" class="btn primary">Log Out</a>
			</div>
          </div>
      </div>
    </div>