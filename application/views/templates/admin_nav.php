

<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
        <a href="#" class="brand">PerfLabs Reservations</a>
				<ul class="nav">
          <li>
            <?php echo anchor( 'dashboard', 'Dashboard' ); ?>
          </li>
          <li class="dropdown" id="admin-menu">
            <a href="#admin-menu" class="dropdown-toggle" data-toggle="dropdown">Administration<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><?php echo anchor ( 'request', 'Requests' ); ?></li>
              <li><?php echo anchor ( 'user', 'Users' ); ?></li>
              <li><?php echo anchor ( 'equipment', 'Equipment' ); ?></li>
              <li><?php echo anchor ( 'room', 'Rooms' ); ?></li>
              <li><?php echo anchor ( 'location', 'Storage Locations' ); ?></li>
              <li><?php echo anchor ( 'studio_guest', 'Studio Guests' ); ?></li>
            </ul>
          </li>
          <li><?php echo anchor( 'user/view/' . $user_id, 'My Account' ); ?></li>
          <li>
<?php echo anchor( $anchor['link'], $anchor['text'] ); ?>
          </li>
				</ul>
		</div>
	</div>
</div>
<div class="container">
