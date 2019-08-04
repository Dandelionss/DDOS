<?php
require_once('waf.php');
define('DB_HOST', 'localhost');
define('DB_NAME', '数据库名');
define('DB_USERNAME', '数据库用户名');
define('DB_PASSWORD', '数据库密码');
define('ERROR_MESSAGE', 'Oops, we ran into a problem here :(');

try {
$odb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
}
catch( PDOException $Exception ) {
	error_log('ERROR: '.$Exception->getMessage().' - '.$_SERVER['REQUEST_URI'].' at '.date('l jS \of F, Y, h:i:s A')."\n", 3, 'error.log');
	die(ERROR_MESSAGE);
}

function error($string)
{
return '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>ERROR:</strong> '.$string.'</div>';
}

function success($string)
{
return '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>SUCCESS:</strong> '.$string.'</div>';
}
?>