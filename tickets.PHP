<?php

$paginaname = '工单';


?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
			<?php 
			
			include("@/header.php");
			?>
				<script>
				function send()
						{
						var subject=$('#subject').val();
						var content=$('#content').val();
						var username=$('#username').val();
						document.getElementById("ticketdiv").style.display="none";
						document.getElementById("ticketimage").style.display="inline";
						var xmlhttp;
						if (window.XMLHttpRequest)
						  {// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp=new XMLHttpRequest();
						  }
						else
						  {// code for IE6, IE5
						  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						  }
						xmlhttp.onreadystatechange=function()
						  {
						  if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
							document.getElementById("ticketdiv").innerHTML=xmlhttp.responseText;
							document.getElementById("ticketimage").style.display="none";
							document.getElementById("ticketdiv").style.display="inline";
							}
						  }
						xmlhttp.open("POST","ajax/usercp.php?type=ticket",true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							xmlhttp.send("subject=" + subject + "&content=" + ticket + "&username=" + username);

						}
				</script>
					<div id="page-content" class="inner-sidebar-left">
 
<div id="page-content-sidebar">
 
<div class="block-section">
<a href="#modal-compose" class="btn btn-effect-ripple btn-block btn-success" data-toggle="modal"><i class="fa fa-pencil"></i>提交工单</a>
</div>
<div id="modal-compose" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3 class="modal-title"><strong>提交工单<img src="img/jquery.easytree/loading.gif" id="ticketimage" style="display:none"/></strong></h3>
</div>
<div class="modal-body">
<?php 
if (isset($_POST['updateBtn']))
{
	$subject = $_POST['subject'];
	$content = $_POST['content'];
	if (empty($subject) || empty($content))
	{
		$error = '抱歉，您尚未输入标题或内容';
	}
	if ($user -> safeString($content) || $user -> safeString($subject))
	{
		$error = '不安全的字符设置
';
	}
	$SQLCount = $odb -> query("SELECT COUNT(*) FROM `tickets` WHERE `username` = '{$_SESSION['username']}' AND `status` = '等待管理响应'")->fetchColumn(0);
	if ($SQLCount > 2)
	{
		$error = '你开的票太多了.在你打开一个新的之前，请等待他们回应';
	}
	if (empty($error))
	{
		$SQLinsert = $odb -> prepare("INSERT INTO `tickets` VALUES(NULL, :subject, :content, :status, :username, UNIX_TIMESTAMP())");
		$SQLinsert -> execute(array(':subject' => $subject, ':content' => $content, ':status' => '等待管理响应', ':username' => $_SESSION['username']));
		echo success('工单已创建.重定向到收件箱..');
	}
	else
	{
		echo error($error);
	}
}
?>
<form class="form-horizontal form-bordered" method="post">
<div class="form-group">
<div class="col-xs-12">
<input type="text" name="subject" id="subject" value="" class="form-control" placeholder="主题">
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<textarea name="content" id="content" rows="7" class="form-control" placeholder="输入您的信息.."></textarea>
</div>
</div>
<input type="hidden" id="username" name="username" value="<?php echo $_SESSION['username']; ?>"  />
<div class="form-group form-actions">
<div class="col-xs-12 text-left">
提交这张票我同意，我已经阅读<a href="tos.php" target="_blank">服务条款</a>.
</div>
<div class="col-xs-12 text-right">
<button name="updateBtn" class="btn btn-effect-ripple btn-primary">提交</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
 
 
<a href="javascript:void(0)" class="btn btn-block btn-effect-ripple btn-default visible-xs" data-toggle="collapse" data-target="#email-nav">导航</a>
<div id="email-nav" class="collapse navbar-collapse remove-padding">
 
<div class="block-section">
<h4 class="inner-sidebar-header">
标签
</h4>
<ul class="nav nav-pills nav-stacked nav-icons">
<li>
<a href="javascript:void(0)">
<i class="fa fa-fw fa-circle icon-push text-info"></i> <strong>未读工单</strong>
</a>
</li>
<li>
<a href="javascript:void(0)">
<i class="fa fa-fw fa-circle icon-push text-success"></i> <strong>已读工单</strong>
</a>
</li>
<li>
<a href="javascript:void(0)">
<i class="fa fa-fw fa-circle icon-push text-danger"></i> <strong>关闭工单</strong>
</a>
</li>
</ul>
</div>
 
</div>
 
</div>
 
 
<div class="block overflow-hidden">
 
<div id="message-list">
 
<div class="block-title clearfix">
<div class="block-options pull-right">
<?php
$total = $odb->query("SELECT COUNT(*) FROM `tickets` WHERE `username` = '{$_SESSION['username']}' ORDER BY `id` DESC")->fetchColumn(0);
$unread = $odb->query("SELECT COUNT(*) FROM `tickets` WHERE `username` = '{$_SESSION['username']}' AND `status` = 'Waiting for user response' ORDER BY `id` DESC")->fetchColumn(0);
?>
<a href="javascript:void(0)" class="btn btn-effect-ripple btn-default">工单总数: <?php echo $total; ?></a>
</div>
<div class="block-options pull-left">
<a class="btn"><i class="fa fa-inbox"></i>支持工单</a>
</div>

</div>
 
<div class="block-content-full">
<table class="table table-borderless table-striped table-vcenter remove-margin">
<tbody>
	<?php
	$SQLGetTickets = $odb -> prepare("SELECT * FROM `tickets` WHERE `username` = :username ORDER BY `id` DESC");
	$SQLGetTickets -> execute(array(':username' => $_SESSION['username']));
	while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
	{
	$id = $getInfo['id'];
	$subject = $getInfo['subject'];
	$status = $getInfo['status'];
	$date = date("m-d-Y, h:i:s a" ,$getInfo['date']);
	if ($status == '等待用户响应')
	{
	$group = 'info';
	}
	elseif ($status == '等待管理响应')
	{
	$group = 'success';
	}
	else
	{
	$group = 'danger';
	}
	echo '<tr>
	
	<td class="td-label td-label-'.$group.' text-center" style="width: 3%;"></td>
	<td><h4><a href="view.php?id='.$id.'" style="cursor:pointer" class="text-dark"><strong>'.htmlspecialchars($subject).'</strong></a></h4><span class="text-muted"></span></td>
	<td class="hidden-xs text-center" style="width: 30px;"></td>
	<td class="hidden-xs text-right text-muted" style="width: 200px;"><em>'.$date.'</em></td>
	</tr>';
	}
	?>
</tbody>
</table>
</div>
 
</div>
 
 
<div id="message-view" class="block-section display-none">
</div>
 
</div>
 
</div>
                    <? // NO BORRAR LOS TRES DIVS! ?>
               </div>         
          </div>
	</div>

		<?php include("@/script.php"); ?>
    </body>
</html>