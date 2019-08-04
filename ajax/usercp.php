<?php
if (!isset($_SERVER['HTTP_REFERER'])) {die;}
//Get the includes
require '../@/config.php';
require '../@/init.php';

//Safe get
$type = $_GET['type'];

//Pass case
if($type == 'pass')
{
	
$cpassword = $_POST['password'];
$npassword = $_POST['npassword'];
$npassworda = $_POST['rpassword'];
$idpass = $_POST['idpass'];
$userpass= $_POST['userpass'];
if (!empty($cpassword) && !empty($npassword) && !empty($npassworda))
{
if ($npassword == $npassworda)
{
$SQLCheckCurrent = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `ID` = :ID AND `password` = :password");
$SQLCheckCurrent -> execute(array(':ID' => $idpass, ':password' => SHA1(md5($cpassword))));
$countCurrent = $SQLCheckCurrent -> fetchColumn(0);
if ($countCurrent == 1)
{
$SQLUpdate = $odb -> prepare("UPDATE `users` SET `password` = :password WHERE `username` = :username AND `ID` = :id");
$SQLUpdate -> execute(array(':password' => SHA1(md5($npassword)),':username' => $userpass, ':id' => $idpass));

$SQLUpdateT = $odb -> prepare("UPDATE `rusers` SET `password` = :password WHERE `user` = :username");
$SQLUpdateT -> execute(array(':password' => $npassword, ':username' => $userpass));
echo success('密码修改成功<br>您的新密码: <strong>'.$npassword.'</strong>');
}
else
{
echo error('当前密码不正确');
}
}
else
{
echo error('密码不匹配');
}
}
else
{
echo error('请填写所有字段');
}	


}

//Code case
if($type == 'code')
{
	
$ncode = $_POST['ncode'];
$codepass = $_POST['codepass'];
$idcode = $_POST['idcode'];
$code = $_POST['code'];

if ($ncode == "" || $codepass == "" || $code == "")
{
echo error('请填写所有字段');
} else {
$SQLCheckCurrent = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `ID` = :ID AND `password` = :password AND `scode` = :code");
$SQLCheckCurrent -> execute(array(':ID' => $idcode, ':password' => SHA1(md5($codepass)), ':code' => $code));
$countCurrent = $SQLCheckCurrent -> fetchColumn(0);
if ($countCurrent == 1)
{
$SQLUpdate = $odb -> prepare("UPDATE `users` SET `scode` = :ncode WHERE `ID` = :id AND `password` = :password");
$SQLUpdate -> execute(array(':ncode' => $ncode,':password' => SHA1(md5($codepass)), ':id' => $idcode));

echo success('私密代码修改成功<br>您的新代码: <strong>'.$ncode.'</strong>');
} else {
echo error('当前私密代码不正确');
}
}
}	
	
//Ticket case
if($type == 'ticket')
{
	echo 'ekisde';
}


?>