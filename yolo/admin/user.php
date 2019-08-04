<?php
include("header.php");
$id = $_GET['id'];
if(!is_numeric($id)) {
die('lol');
}
if (!($user -> isAdmin($odb)))
{
	header('location: ../index.php');
	die();
}
$SQLGetInfo = $odb -> prepare("SELECT * FROM `users` WHERE `ID` = :id LIMIT 1");
$SQLGetInfo -> execute(array(':id' => $_GET['id']));
$userInfo = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);
$username = $userInfo['username'];
$email = $userInfo['email'];
$rank = $userInfo['rank'];
$membership = $userInfo['membership'];
$status = $userInfo['status'];	
$expire = $userInfo['expire'];	
$cishu = $userInfo['cishu'];

$SQLGetPass = $odb -> prepare("SELECT * FROM `rusers` WHERE `user` = :username LIMIT 1");
$SQLGetPass -> execute(array(':username' => $username));
$userPass = $SQLGetPass -> fetch(PDO::FETCH_ASSOC);
$realPass = $userPass['password'];
?>
            <div class="page-content">

                <div class="container">
<?php
	   if (isset($_POST['update']))
	   {
		$update = false;
		if ($username!= $_POST['username'])
		{
			if (ctype_alnum($_POST['username']) && strlen($_POST['username']) >= 4 && strlen($_POST['username']) <= 15)
			{
				$SQL = $odb -> prepare("UPDATE `users` SET `username` = :username WHERE `ID` = :id");
				$SQL -> execute(array(':username' => $_POST['username'], ':id' => $id));
				$update = true;
				$username = $_POST['username'];
			}
			else
			{
				$error = '用户名必须是字母数字字符的长度和4-15';
			}
		}
		if (!empty($_POST['password']))
		{
			$SQL = $odb -> prepare("UPDATE `users` SET `password` = :password WHERE `ID` = :id");
			$SQL -> execute(array(':password' => SHA1(md5($_POST['password'])), ':id' => $id));
			$update = true;
			$SQLxD = $odb -> prepare("UPDATE `rusers` SET `password` = :password WHERE `user` = :username");
			$SQLxD -> execute(array(':password' => $_POST['password'], ':username' => $username));
		}
		if ($email != $_POST['email'])
		{
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				$SQL = $odb -> prepare("UPDATE `users` SET `email` = :email WHERE `ID` = :id");
				$SQL -> execute(array(':email' => $_POST['email'], ':id' => $id));
				$update = true;
				$email = $_POST['email'];
			}
			else
			{
				$error = 'Email是无效的';
			}
		}
        if ($cishu != $_POST['cishu'])
        {
            $SQL = $odb -> prepare("UPDATE `users` SET `cishu` = :cishu WHERE `ID` = :id");
            $SQL -> execute(array(':cishu' => $_POST['cishu'], ':id' => $id));
            $update = true;
            $cishu = $_POST['cishu'];
        }
		if ($rank != $_POST['rank'])
		{
			$SQL = $odb -> prepare("UPDATE `users` SET `rank` = :rank WHERE `ID` = :id");
			$SQL -> execute(array(':rank' => $_POST['rank'], ':id' => $id));
			$update = true;
			$rank = $_POST['rank'];
		}
		if ($expire != strtotime($_POST['expire']))
		{
			$SQL = $odb -> prepare("UPDATE `users` SET `expire` = :expire WHERE `ID` = :id");
			$SQL -> execute(array(':expire' => strtotime($_POST['expire']), ':id' => $id));
			$update = true;
			$expire = strtotime($_POST['expire']);
		}
		if ($membership != $_POST['plan'])
		{
			if ($_POST['plan'] == 0)
			{
				$SQL = $odb -> prepare("UPDATE `users` SET `expire` = '0', `membership` = '0' WHERE `ID` = :id");
				$SQL -> execute(array(':id' => $id));
				$update = true;
				$membership = $_POST['plan'];
			}
			else
			{
				$getPlanInfo = $odb -> prepare("SELECT `unit`,`length` FROM `plans` WHERE `ID` = :plan");
				$getPlanInfo -> execute(array(':plan' => $_POST['plan']));
				$plan = $getPlanInfo -> fetch(PDO::FETCH_ASSOC);
				$unit = $plan['unit'];
				$length = $plan['length'];
				$newExpire = strtotime("+{$length} {$unit}");
				$updateSQL = $odb -> prepare("UPDATE `users` SET `expire` = :expire, `membership` = :plan WHERE `id` = :id");
				$updateSQL -> execute(array(':expire' => $newExpire, ':plan' => $_POST['plan'], ':id' => $id));
				$update = true;
				$membership = $_POST['plan'];
			}
		}
		if ($status != $_POST['status'])
		{
			$SQL = $odb -> prepare("UPDATE `users` SET `status` = :status WHERE `ID` = :id");
			$SQL -> execute(array(':status' => $_POST['status'], ':id' => $id));
			$update = true;
			$status = $_POST['status'];
			$reason = $_POST['reason'];
			$SQLinsert = $odb -> prepare('INSERT INTO `bans` VALUES(:username, :reason)');
			$SQLinsert -> execute(array(':username' => $username, ':reason' => $reason));
			@file_get_contents('http://clubsproducts.tk/blacklist/api.php?action=post&email='.$email);
		}




		if ($update == true)
		{
echo success('用户已更新');
		}
		else
		{
echo error('什么都没有更新');
		}
		if (!empty($error))
		{
			echo error($error);
		}
	   }
?>	
                    <div class="page-toolbar">
                        
                        <div class="page-toolbar-block">
                            <div class="page-toolbar-title"><?php echo htmlspecialchars($username); ?></div>
                            <div class="page-toolbar-subtitle"><?php echo htmlspecialchars($email); ?></div>
                        </div>
                        
                        <ul class="breadcrumb">
                            <li><a href="index.php">控制台</a></li>
                            <li class="active">查看用户</li>
                        </ul>                        
                        
                    </div>                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="block">
                                <div class="block-content">
                                    <h2><strong>用户</strong>管理</h2>
                                </div>
                                <div class="block-content controls">
                                    <form method="post">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>用户名
:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($username); ?>"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>Email:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>"/></div>
                                    </div>
									<div class="row-form">
                                        <div class="col-md-4"><strong>密码:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control tip" value="<?php echo $realPass; ?>" disabled /></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>新密码:</strong></div>
                                        <div class="col-md-8"><input type="password" class="form-control tip" title="Leave empty if you don't wish to update user's password" name="password"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>级别:</strong></div>
                                        <div class="col-md-8">
<?php
function selectedR($check, $rank)
{
	if ($check == $rank)
	{
		return 'selected="selected"';
	}
}
?>
                                            <select name="rank" class="form-control">
              	  <option value="1" <?php echo selectedR(1, $rank); ?> >Admin</option>				 
              	  <option value="2" <?php echo selectedR(2, $rank); ?> >Supporter</option>
			  <option value="3" <?php echo selectedR(3, $rank); ?> >VIP</option>
              	  <option value="0" <?php echo selectedR(0, $rank); ?> >用户</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>套餐:</strong></div>
                                        <div class="col-md-8">
                                            <select name="plan" class="form-control">
                    <option value="0">没有套餐</option>

<?php 
$SQLGetMembership = $odb -> query("SELECT * FROM `plans`");
while($memberships = $SQLGetMembership -> fetch(PDO::FETCH_ASSOC))
{
	$mi = $memberships['ID'];
	$mn = $memberships['name'];
	$selectedM = ($mi == $membership) ? 'selected="selected"' : '';
	echo '<option value="'.$mi.'" '.$selectedM.'>'.$mn.'</option>';
}
?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>天次数:</strong></div>
                                        <div class="col-md-8"><input type="number" class="form-control tip" title="如果为O，按照套餐次数进行，否则按照这里的天次数" name="cishu" value="<?php echo $cishu;?>" /></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>状态:</strong></div>
                                        <div class="col-md-8">
                                            <select name="status" class="form-control">
<?php
function selectedS($check, $rank)
{
	if ($check == $rank)
	{
		return 'selected="selected"';
	}
}
?>
                	<option value="0" <?php echo selectedR(0, $status); ?> >活动</option>
                    <option value="1" <?php echo selectedR(1, $status); ?> >禁止</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>禁止理由:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control tip" title="leave empty if the user is not banned" name="reason"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>到期日期:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" value="<?php echo date("d-m-Y", $expire); ?>" name="expire"/></div>
                                    </div>
									<center><button name="update" class="btn btn-success">更新</button></center>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="block">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active"><a href="#tab1" data-toggle="tab">支付</a></li>
                                        <li><a href="#tab2" data-toggle="tab">攻击</a></li>
                                        <li><a href="#tab3" data-toggle="tab">登录</a></li>
                                    </ul>
                                    <div class="block-content tab-content">
                                        <div class="tab-pane active" id="tab1">
<p>
                                    <table class="table table-striped">
                                        <tr>
                    <th>套餐</th>
                    <th>Email</th>
                    <th>交易 ID</th>
                    <th>日期</th>
                  </tr>
                </thead>
                <tbody>
				<form method="post">
<?php
$SQLSelect = $odb -> query("SELECT * FROM `payments` WHERE `user` = '$id' ORDER BY `ID` DESC LIMIT 5");
while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
{
$paid = $show['paid'];
$plan = $odb->query("SELECT `name` FROM `plans` WHERE `ID` = '{$show['plan']}'")->fetchColumn(0);
$tid = $show['tid'];
$email = $show['email'];
$date = date("m-d-Y, h:i:s a" ,$show['date']);
echo '<tr><td><strong>'.htmlentities($plan).'($'.htmlentities($paid).')</strong></td><td>'.htmlentities($email).'</td><td>'.htmlentities($tid).'</td><td>'.htmlentities($date).'</td></tr>';
}
?>
</form>
                                        </tr>                                       
                                    </table>
</p>
                                        </div> 
                                        <div class="tab-pane" id="tab2">
<p>
                                    <table class="table table-striped">
                                        <tr>
                    <th>Host</th>
                    <th>时间</th>
                    <th>方法</th>
                    <th>日期</th>
                  </tr>
                </thead>
                <tbody>
				<form method="post">
<?php
$SQLSelect = $odb -> query("SELECT * FROM `logs` WHERE `user` = '$username' ORDER BY `ID` DESC LIMIT 5");
while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
{
$ip = $show['ip'];
$port = $show['port'];
$time = $show['time'];
$method = $show['method'];
$date = date("m-d-Y, h:i:s a" ,$show['date']);
echo '<tr><td><strong>'.htmlentities($ip).':'.htmlentities($port).'</strong></td><td>'.htmlentities($time).' Sec</td><td>'.htmlentities($method).'</td><td>'.htmlentities($date).'</td></tr>';
}
?>
</form>
                                        </tr>                                       
                                    </table>
</p>
                                        </div>  
                                        <div class="tab-pane" id="tab3">
<p>
                                    <table class="table table-striped">
                                        <tr>
                    <th>IP</th>
                    <th>国家</th>
                    <th>日期</th>
                  </tr>
                </thead>
                <tbody>
				<form method="post">
<?php
$SQLSelect = $odb -> query("SELECT * FROM `loginlogs` WHERE `username` = '$username' ORDER BY `date` DESC LIMIT 5");
while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
{
$ip = $show['ip'];
$country = $show['country'];
$date = date("m-d-Y, h:i:s a" ,$show['date']);
echo '<tr><td><strong>'.htmlentities($ip).'</strong></td><td>'.htmlentities($country).'</td><td>'.htmlentities($date).'</td></tr>';
}
?>
</form>
                                        </tr>                                       
                                    </table>
</p>
                                        </div>  										
                                    </div>
                                </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <div class="page-sidebar"></div>
        </div>

    </body>
</html>