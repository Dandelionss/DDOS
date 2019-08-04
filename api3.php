
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
			?<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />


        <title>DDOS压测平台 - API管理</title>

        <meta name="description" content="DDOS压测平台">
        <meta name="author" content="StrikeREAD">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.png">
        <link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="img/icon180.png" sizes="180x180">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/plugins.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/themes/amethyst.css" id="theme-link">
        <link rel="stylesheet" href="css/themes.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
	<script src="/ajax/js/jquery.min.js"></script>
    </head>
    <body>
        <div id="page-wrapper" class="page-loading">
            <div class="preloader">
                <div class="inner">
                    <!-- Animation spinner for all modern browsers -->
                    <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

                    <!-- Text for IE9 -->
                    <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
                </div>
            </div>
            <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
                <div id="sidebar-alt" tabindex="-1" aria-hidden="true">
                    <a href="javascript:void(0)" id="sidebar-alt-close" onclick="App.sidebar('toggle-sidebar-alt');"><i class="fa fa-times"></i></a>

                    <div id="sidebar-scroll-alt">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Profile -->
                         
                        </div>
                      
                    </div>
                   
                </div>
                
			
				
                <div id="sidebar">
                 
                    <div id="sidebar-brand" class="themed-background">
                        <a href="index.php" class="sidebar-title">
                            <i class="fa fa-terminal"></i><span class="sidebar-nav-mini-hide"><strong>DDOS压测平台</strong></span>
                        </a>
                    </div>
            

                 
                    <div id="sidebar-scroll">
                 
                        <div class="sidebar-content">
                    
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="index.php" ><i class="fa fa-home sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">主页</span></a>
                                </li>
				<li>
                                    <a href="api3.php"  class="active"  ><i class="fa fa-gears sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">API管理</span></a>
                                </li>
				<li>
                                    <a href="stress.php"  ><i class="fa fa-power-off sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">压测面板</span></a>
                                </li>
				<li>
                                    <a href="tickets.php" ><i class="fa fa-envelope sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">工单系统</span></a>
                                </li>
				<li>
                                    <a href="purchase.php" ><i class="fa fa-shopping-cart sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">购买套餐</span></a>
                                </li>

                                
                            </ul>

                        </div>
                 
                    </div>
     
               
                    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
                        <div class="text-center">
                            <small>DDOS压测平台 v1.0</small><br>
                            <small><span id="year-copy"></span> &copy; <a href="index.php" target="_blank">DDOS压测平台</a></small>
                        </div>
                    </div>

                </div>
				<div id="main-container">
				<header class="navbar navbar-inverse navbar-fixed-top">
                       
                        <ul class="nav navbar-nav-custom">
                          
                            <li>
                                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');">
                                    <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                                    <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
                                </a>
                            </li>
                           

                      
                            <li class="hidden-xs animation-fadeInQuick">
                                <a href=""><strong>API管理</strong></a>
                            </li>
                         
                        </ul>
               
                        <ul class="nav navbar-nav-custom pull-right">

                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="img/placeholders/avatars/avatar16.jpg" alt="avatar">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-header">
                                        <strong>123123123</strong>
                                    </li>
                                    <li>
								
                                        <a href="#modal-cp" data-toggle="modal" >
                                            <i class="fa fa-user fa-fw pull-right"></i>
                                            账号设置
                                        </a>
                                    </li>
							<li>
                                        <a href="logout.php">
                                            <i class="fa fa-unlock fa-fw pull-right"></i>
                                           退出
                                        </a>
                                    </li>
                                </ul>
                            </li>
                          
                        </ul>
						
						<script>
						function pass()
						{
						var password=$('#password').val();
						var npassword=$('#npassword').val();
						var rpassword=$('#rpassword').val();
						var idpass=$('#idpass').val();
						var userpass=$('#userpass').val();
						document.getElementById("passdiv").style.display="none";
						document.getElementById("passimage").style.display="inline";
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
							document.getElementById("passdiv").innerHTML=xmlhttp.responseText;
							document.getElementById("passimage").style.display="none";
							document.getElementById("passdiv").style.display="inline";
							}
						  }
						xmlhttp.open("POST","ajax/usercp.php?type=pass",true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							xmlhttp.send("password=" + password + "&npassword=" + npassword + "&rpassword=" + rpassword + "&userpass=" + userpass + "&idpass=" + idpass);

						}
						function code()
						{
						var code=$('#code').val();
						var codepass=$('#codepass').val();
						var ncode=$('#ncode').val();
						var idcode=$('#idcode').val();
						document.getElementById("codediv").style.display="none";
						document.getElementById("codeimage").style.display="inline";
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
							document.getElementById("codediv").innerHTML=xmlhttp.responseText;
							document.getElementById("codeimage").style.display="none";
							document.getElementById("codediv").style.display="inline";
							}
						  }
						xmlhttp.open("POST","ajax/usercp.php?type=code",true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							xmlhttp.send("codepass=" + codepass + "&code=" + code + "&ncode=" + ncode + "&idcode=" + idcode);

						}
						
						
						</script>
						
						<div id="modal-cp" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
									<div class="modal-content">
									<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h3 class="modal-title"><strong>账号设置</strong></h3>
									</div>
									<div class="modal-body">
									<div class="form-horizontal form-bordered">
									<div class="form-group">
									<div class="col-md-12">
									<a href="#modal-password" class="btn btn-effect-ripple btn-primary btn-block" data-toggle="modal">更改密码</a>
									</div>
									</div>
									<div class="form-group">
									<div class="col-md-12">
									<a href="#modal-code" class="btn btn-effect-ripple btn-primary btn-block" data-toggle="modal">更改私密代码</a>
									</div>
									</div>
									<div class="form-group">
									<div class="col-md-12">
									<a href="#modal-logs" class="btn btn-effect-ripple btn-primary btn-block" data-toggle="modal">查看日志</a>
									</div>
									</div>
									<div class="form-group">
									<div class="col-md-12">
									<a class="btn btn-effect-ripple btn-danger btn-block" data-dismiss="modal" aria-hidden="true" >取消</a>
									</div>
									</div>
									</div>
									</div>							
									</div>
									</div>
						</div>
						<div id="modal-password" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
									<div class="modal-content">
									<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h3 class="modal-title"><strong>Change Password</strong> <img src="img/jquery.easytree/loading.gif" id="passimage" style="display:none"/></h3>
									</div>
									<div class="modal-body">
									<div class="form-horizontal form-bordered">
									<div class="form-group">
									<div class="col-md-12">
									<div id="passdiv" style="display:none"></div>
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label">密码</label>
									<div class="col-md-9">
									<input type="text" name="password" id="password" value="" class="form-control">
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label">新密码</label>
									<div class="col-md-9">
									<input type="text" name="rpassword" id="rpassword" value="" class="form-control">
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label">确认密码</label>
									<div class="col-md-9">
									<input type="text" name="npassword" id="npassword" value="" class="form-control">
									</div>
									</div>
									<input type="hidden" id="userpass" name="userpass" value="123123123"  />
									<input type="hidden" id="idpass" name="idpass" value="134"  />
									<div class="form-group">
									<div class="col-md-12">
									<button type="submit" onclick="pass()" class="btn btn-effect-ripple btn-primary btn-block">更改密码</button>
									</div>
									</div>
									<div class="form-group">
									<div class="col-md-12">
									<a class="btn btn-effect-ripple btn-danger btn-block" data-dismiss="modal" aria-hidden="true" >取消</a>
									</div>
									</div>
									</div>
									</div>							
									</div>
									</div>
						</div>
						<div id="modal-code" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
									<div class="modal-content">
									<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h3 class="modal-title"><strong>Change Security Code</strong> <img src="img/jquery.easytree/loading.gif" id="codeimage" style="display:none"/></h3>
									</div>
									<div class="modal-body">
									<div class="form-horizontal form-bordered">
									<div class="form-group">
									<div class="col-md-12">
									<div id="codediv" style="display:none"></div>
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label">私密代码</label>
									<div class="col-md-9">
									<input type="text" id="code" name="code" value="" class="form-control">
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label">您的密码</label>
									<div class="col-md-9">
									<input type="text" id="codepass" name="codepass" value="" class="form-control">
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label">新私密代码</label>
									<div class="col-md-9">
									<input type="text" id="ncode" name="ncode" value="" class="form-control">
									</div>
									</div>
									<input type="hidden" id="idcode" name="idcode" value="134"  />
									<div class="form-group">
									<div class="col-md-12">
									<button type="submit" onclick="code()" class="btn btn-effect-ripple btn-primary btn-block" data-toggle="modal">更改私密代码</button>
									</div>
									</div>
									<div class="form-group">
									<div class="col-md-12">
									<a class="btn btn-effect-ripple btn-danger btn-block" data-dismiss="modal" aria-hidden="true" >取消</a>
									</div>
									</div>
									</div>
									</div>							
									</div>
									</div>
						</div>
						<div id="modal-logs" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
									<div class="modal-content">
									<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h3 class="modal-title"><strong>Logs</strong></h3>
									</div>
									<div class="modal-body">
									<div class="form-horizontal form-bordered">
									<div class="form-group">
									
									
									<ul class="nav nav-tabs nav-justified">
											<li class="active"><a href="#tab9" data-toggle="tab">登录历史</a></li>
											<li><a href="#tab10" data-toggle="tab">攻击历史</a></li>
										</ul>
									 <div class="block-content tab-content">
											<div class="tab-pane active" id="tab9">
												<p>
											<table class="table table-striped">
											<tr>
												<th>IP</th><th>国家</th><th>日期</th>
											</tr>
											<tr>
	<tr><td>117.40.132.196</td><td>China</td><td>04-16-2017, 10:10:49 am</td></tr><tr><td>117.40.132.196</td><td>China</td><td>04-16-2017, 08:19:46 am</td></tr><tr><td>106.7.189.195</td><td>China</td><td>04-15-2017, 11:10:54 pm</td></tr><tr><td>59.55.129.230</td><td>China</td><td>04-09-2017, 12:15:48 am</td></tr><tr><td>117.40.132.196</td><td>China</td><td>04-07-2017, 01:31:55 pm</td></tr>											</tr>                                       
										</table>
												</p>
											</div>
											<div class="tab-pane" id="tab10">
												<p>
											<table class="table table-striped">
											<tr>
												<th>IP</th><th>端口</th><th>时间</th><th>方法</th><th>日期</th>
											</tr>
											<tr>
												</tr>                                       
										</table>
												</p>
											</div>                        
										</div>
									<div class="form-group">
									<div class="col-md-12">
									<a class="btn btn-effect-ripple btn-danger btn-block" data-dismiss="modal" aria-hidden="true" >取消</a>
									</div>
									</div>
									</div>
									</div>							
									</div>
									</div>
									</div>
						</div>
						
                       
                    </header>			
			<div id="page-content">
                        <div class="row">
								<div class="center-block" style="width:800px;background-color:#ccc;">
									<div id="divall" style="display:inline"></div>
										<div id="div" style="display:inline"></div>
											<div class="widget">
												<div class="widget-content widget-content-mini themed-background-dark text-light-op">	
												<span class="pull-right text-muted">DDOS压力测试</span>
												<i class="fa fa-gears"></i> <b>API连接中心<img id="image" src="img/jquery.easytree/loading.gif" style="display:none"/></b>
												</div>
												<div style="position: relative; width: auto; font-size:10pt" class="slimScrollDiv">
												<div class="widget-content widget-content-mini">	
												<div id="stats">
												<table class="table table-striped">
												<tbody>
												<tr>
													
													<h4><strong>API - 设置</strong></h4>
													<h6>你被分配的API地址为：</h6>
													<pre class="pre-scrollable text-light-op"><strong>http://域名/api.php?username=账号&password=密码&host=目标&port=端口&time=时间&method=模式</strong></pre>
													<h6>使用：请将中文换成你需要填写的目标，使用GET方式即可发动攻击（例如使用浏览器直接访问）</h6>
													<p class="lead"><h4><strong>API - 说明文档 (必看)</strong></h4></p>
													问：什么是API？答：您可以使用我们的API进行简单的GET访问即可轻松对接工具，如：QQ机器人，你的网站，攻击器等等。在这里,您可以用低廉的价格,创建属于自己的DDoS攻击的工具!<br><br>

													问：如何获得我的API ? 答：所有套餐默认开通了API访问的权限，如果您需要其他套餐可购买其相关授权服务<br><br>

													问：API的常见问题? 答：我们不允许共享API用户名和密码!我们的API同样有攻击次数与并发限制（与其账户套餐相同）<br>
													
												
												</tr>		
												</tbody>
												</table>
												</div>
												</div>
												</div>
											</div>
										</div>
									</div>
								</div>
						</div>
			</div>



		?		<script src="/ajax/js/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-2.1.1.min.js"%3E%3C/script%3E'));</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/app.js"></script>
        <script src="js/pages/readyDashboard.js"></script>
        <script>$(function(){ ReadyDashboard.init(); });</script>    </body>
</html>