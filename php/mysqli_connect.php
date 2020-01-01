<?php

DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', '127.0.0.1');
DEFINE('DB_NAME', 'sets');
DEFINE('DB_PORTS', '3308');


$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME,DB_PORTS) OR die('Could not to MySQL:'.mysqli_connect_error());

?>