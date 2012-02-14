<?php

//require_once dirname(__FILE__) . '/common.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP CAS Test Page</title>
</head>
<body>
<?php $sNetID = $this->session->userdata('netID'); ?>
<?php if ( !empty($sNetID) ) : ?>
<p>
<?php echo anchor( 'auth_test/logout', 'Log Out'); ?>

</p>
<pre><?php print_r($this->session->all_userdata()); ?></pre>
<?php else : ?>
<p>
<?php echo anchor( 'auth_test/login', 'Log In'); ?>
</p>
<pre><?php print_r($this->session->all_userdata()); ?></pre>
<?php endif; ?>
</body>
</html>
