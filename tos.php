<?php
ob_start();
require_once '@/config.php';
require_once '@/init.php';

$paginaname = 'TOS';

?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
			<head>
        <meta charset="utf-8">

        <title><?php echo htmlspecialchars($sitename); ?> - <?php echo $paginaname; ?></title>

        <meta name="description" content="<?php echo htmlspecialchars($description); ?>">
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
                            <i class="fa fa-terminal"></i> <span class="sidebar-nav-mini-hide"><strong><?php echo htmlspecialchars($sitename); ?></strong></span>
                        </a>
                    </div>
            

                 
                    <div id="sidebar-scroll">
                 
                        <div class="sidebar-content">
                    
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="tos.php" class="active"><i class="fa fa-home sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">服务条款</span></a>
                                </li>
                                <li class="sidebar-separator">
                                    <i class="fa fa-ellipsis-h"></i>
                                </li>
						<li>
                                    <a href="login.php" ><i class="fa fa-home sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">登录</span></a>
                                </li>
						<li>
                                    <a href="register.php" ><i class="fa fa-home sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">注册</span></a>
                                </li>
		
                            </ul>

                        </div>
                 
                    </div>
                 

               
                    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
                        <div class="text-center">
                            <small><?php echo htmlspecialchars($sitename); ?> v1.0</small><br>
                            <small><span id="year-copy"></span> &copy; <a href="<?php echo htmlspecialchars($siteurl); ?>" target="_blank"><?php echo htmlspecialchars($sitename); ?></a></small>
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
                                <a href=""><strong><?php echo $paginaname; ?></strong></a>
                            </li>
                         
                        </ul>
               
                        <ul class="nav navbar-nav-custom pull-right">

                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="img/placeholders/avatars/avatar16.jpg" alt="avatar">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-header">
                                        <strong>未知</strong>
                                    </li>
                                    <li>
								
                                        <a href="login.php">
                                            <i class="fa fa-user fa-fw pull-right"></i>
                                            登录
                                        </a>
                                    </li>
							<li>
                                        <a href="register.php">
                                            <i class="fa fa-unlock fa-fw pull-right"></i>
                                          注册
                                        </a>
                                    </li>
                                </ul>
                            </li>
                          
                        </ul>
						
				
						
						
                       
                    </header>
				
<div id="page-content">
<div class="content-header">
<div class="header-section clearfix">
<a href="javascript:void(0)" class="pull-right">
<img src="img/placeholders/avatars/avatar4.jpg" alt="Avatar" class="img-circle">
</a>
<h1><?php echo htmlspecialchars($sitename); ?></h1>
<h2>服务条款</h2>
</div>
</div>
<div class="row">
<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
<div class="block">
<div class="block-title">
<div class="block-options pull-right">
<a href="javascript:void(0)" class="btn btn-effect-ripple btn-warning" data-toggle="tooltip" title="添加到收藏夹"><i class="fa fa-star"></i></a>
<a href="javascript:void(0)" class="btn btn-effect-ripple btn-danger" data-toggle="tooltip" title="Love it"><i class="fa fa-heart"></i></a>
</div>
<h2><i class="fa fa-rocket"></i> <?php echo htmlspecialchars($sitename); ?></h2>
</div>

<pre>
1.所有销售是最终的，没有退款。
2.不能共享您的帐户
3.通过使用此“ddos压力测试”你必须负责，你正在使用它什么。你必须坚持与你来自哪里的法律，记住你有责任为自己的行为，并提醒人们，“ddos压力测试”是压力测试的网络工具。
4.没有钱将被退还
5.所有销售都是最终决定
6.我们对你的行为不承担责任
7.不要滥用或可能被禁止
8.无退款
9.不要登录使用VPN或代理，这不是严格的，但可能会被视为帐户共享。
10.你不能进行压力测试任何教育或政府网站。
11.你不能与任何人分享您的帐户。每个帐户仅限于每个帐户1人。
12. DDoS攻击服务是严格禁止的。
13.你不能强调的是，你没有同意任何压力的服务器。
14.本站以服务器网络压力测试为目的。禁止测试自己服务器以外的服务器！
15.注册登录表示您同意我们的服务条款。我们有权关闭你的帐户不通知不退款！
</pre>

<hr>
</div>
</div>
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