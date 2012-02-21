

<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
        <a href="#" class="brand">PerfLabs Reservations</a>
				<ul class="nav">
          <li>
            <?php echo anchor( 'dashboard', 'Dashboard' ); ?>
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
