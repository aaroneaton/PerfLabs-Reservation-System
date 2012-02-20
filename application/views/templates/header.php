<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <title><?php echo $title; ?> - PerfLabs Reservations</title>
  <link media="all" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css" />
</head>
<body>


<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
        <a href="#" class="brand">PerfLabs Reservations</a>
				<ul class="nav">
          <li>
          	<a href="#">Dashboard</a>
          </li>
          <li>
          	<a href="#">Account</a>
          </li>
          <li>
<?php echo anchor( $anchor['link'], $anchor['text'] ); ?>
          </li>
				</ul>
		</div>
	</div>
</div>
<div class="container">
