<?php

 if (empty($_GET['username']) || empty($_GET['password']) || empty($_GET['host']) || empty($_GET['time']) || empty($_GET['port']) || empty($_GET['method'])) {
            exit('<font color=#ff0000>Error prompt=></font><br><br>请确认所有字段：<br>http://域名/api.php?username=账号&password=密码&host=[IP]&port=[端口]&time=[时间]&method=[模式]');


        }

        require_once("api/api.php");


?>
