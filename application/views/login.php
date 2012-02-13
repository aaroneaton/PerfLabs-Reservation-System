<?php
<html>
<head>
    <title>Login | PHP CAS Standalone Example</title>
</head>
<body>

<a href="./index.php">&laquo; Home</a>

<pre><?php isset($_SESSION['auth']) ? print_r($_SESSION['auth']) : 'NO AUTHENTICATION DATA PRESENT'; ?></pre>

</body>
</html>

