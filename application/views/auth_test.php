<?php

require_once dirname(__FILE__) . '/common.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP CAS Test Page</title>
</head>
<body>
<?php if ( isset( $_SESSION['auth']) ) : ?>
<p>
	<a href="./logout.php">Log Out</a>
</p>
<pre><?php print_r($_SESSION['auth']); ?></pre>
<?php else : ?>
<p>
<?php echo anchor( 'auth_test/login', 'Log In'); ?>
</p>
<pre><?php print_r($_SESSION); ?></pre>
<?php endif; ?>
</body>
</html>
