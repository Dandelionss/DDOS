<?php

$paginaname = '首页';

?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
			<?php include("@/header.php"); ?>
	
                    <div id="page-content">
                     
                        <div class="row">
                      
                            <div class="col-sm-6 col-lg-3">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini text-right clearfix">
                                        <div class="widget-icon pull-left themed-background-danger">
                                            <i class="fa fa-signal text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3 text-danger">
                                            <strong><span data-toggle="counter" data-to="<?php echo $stats -> totalBoots($odb); ?>"></span></strong>
                                        </h2>
                                        <span class="text-muted">总攻击</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini text-right clearfix">
                                        <div class="widget-icon pull-left themed-background-info">
                                            <i class="fa fa-fire text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3 text-info">
                                            <strong><span data-toggle="counter" data-to="<?php echo $stats -> runningBoots($odb); ?>"></span></strong>
                                        </h2>
                                        <span class="text-muted">攻击运行</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini text-right clearfix">
                                        <div class="widget-icon pull-left themed-background">
                                            <i class="fa fa-hdd-o text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3">
                                            <strong><span data-toggle="counter" data-to="<?php echo $stats -> serversonline($odb); ?>"></span></strong>
                                        </h2>
                                        <span class="text-muted">服务器</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <a href="javascript:void(0)" class="widget">
                                    <div class="widget-content widget-content-mini text-right clearfix">
                                        <div class="widget-icon pull-left themed-background-danger">
                                            <i class="fa fa-heart text-light-op"></i>
                                        </div>
                                        <h2 class="widget-heading h3 text-danger">
                                            <strong><span data-toggle="counter" data-to="<?php echo $stats -> totalUsers($odb); ?>"></span></strong>
                                        </h2>
                                        <span class="text-muted">总用户</span>
                                    </div>
                                </a>
                            </div>
                            
                        </div>
            
                        <div class="row">
                          
						<div class="col-sm-6 col-lg-8">
 
							<div class="widget">
								<div class="widget-content widget-content-mini themed-background-dark text-light-op">
								<span class="pull-right text-muted"><?php echo htmlspecialchars($sitename); ?></span>
								<i class="fa fa-send"></i> <b>资讯</b>
								</div>
								
								<div class="widget-content">
									<div style="position: relative; width: auto" class="slimScrollDiv">
										<div id="stats">
											<table class="table table-striped">
												<tbody>
													<tr>
														<th><center>标题</center></th>
														<th><center>内容</center></th>
														<th><center>日期</center></th>
														<th><center>作者</center></th>
													</tr>
													<tr>
													
													</tr>
													<?php
													$newssql = $odb -> query("SELECT * FROM `news` ORDER BY `date` DESC LIMIT 4");
													while($row = $newssql ->fetch())
													{
													$id = $row['ID'];
													$title = $row['title'];
													$content = $row['content'];
													$autor = $row['author'];
													echo '
													<tr>
															<td><center>'.htmlspecialchars($title).'</center></td>
															<td><center>'.htmlspecialchars($content).'</center></td>
															<td><center> '.date("d/m/y" ,$row['date']).'</center></td>
															<td><center><span class="label label-success">'.htmlspecialchars($autor).'</span></center></td>
														</div>
													</tr>';
													}
													?>			
												</tbody>
											</table>
										</div>
									</div>
								
								</div>
							</div>
						 
						</div>
						<div class="col-sm-6 col-lg-4">
							<div class="widget">
								<div class="widget-content widget-content-mini themed-background-dark text-light-op">
								<span class="pull-right text-muted"><?php echo htmlspecialchars($sitename); ?></span>
								<i class="fa fa-user"></i> <b>我的信息</b>
								</div>
								
								<div class="widget-content">
									<table class="table table-striped table-vcenter">
									<?php

								    //查询今日次数
								    $SQLSelect = $odb -> query("SELECT * FROM `gjcs` WHERE uid =".$_SESSION['ID']." AND shijian=".strtotime(date('Y-m-d',time())));
								    $yicishu = 0;
								    while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
								    {
								        $yicishu++;
								    }

									$plansql = $odb -> prepare("SELECT `users`.`expire`,`users`.`cishu` as 'ucishu', `plans`.`name`, `plans`.`concurrents`, `plans`.`cishu`, `plans`.`mbt` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id");
									$plansql -> execute(array(":id" => $_SESSION['ID']));
									$rowxd = $plansql -> fetch(); 
									$date = date("d/m/Y, h:i a", $rowxd['expire']);
									if (!$user->hasMembership($odb))
									{
									$rowxd['mbt'] = 0;
									$rowxd['concurrents'] = 0;
									$rowxd['name'] = '没有会员';
									$date = '没有会员';
									}
									if ($rowxd['ucishu'] >0) {
										$rowxd['cishu'] = $rowxd['ucishu'];
									}
									?>

									<tbody>
										<tr>
											<td class="text-right"><strong>用户名:</strong></td>
											<td><?php echo $_SESSION['username']; ?></td>
										</tr>
										<tr>									
											<td class="text-right" style="width: 50%;"><strong>会员:</strong></td>
											<td><?php echo htmlspecialchars($rowxd['name']); ?> <a data-original-title="升级" href="purchase.php" data-toggle="tooltip" title=""><i class="fa fa-chevron-up"></i></a></td>
										</tr>
										<tr>
											<td class="text-right"><strong>会员过期:</strong></td>
											<td><?php echo $date; ?></td>
										</tr>
										<tr>
											<td class="text-right"><strong>开机时间:</strong></td>
											<?php
											if (!$user->hasMembership($odb))
											{
												echo '<td>没有会员</td>';
											} else {
											?>
											<td><?php echo $rowxd['mbt']; ?>秒</td>
											<?php } ?>
										</tr>
										<tr>	
											<td class="text-right"><strong>并发:</strong></td>
											<?php
											if (!$user->hasMembership($odb))
											{
												echo '<td>没有会员</td>';
											} else {
											?>
											<td><?php echo $rowxd['concurrents']; ?>并发</td>
											<?php } ?>
										</tr>
										<tr>	
											<td class="text-right"><strong>每日剩余攻击:</strong></td>

											<td><?php echo $yicishu; ?>/<?php echo $rowxd['cishu']; ?> 次</td>
										</tr>
									</tbody>
									</table>
								
								</div>
							</div>
						</div>
					</div>	
						
					 <div class="row">	
						<div class="col-sm-6 col-lg-8">
							<div class="widget">
								<div class="widget-content widget-content-mini themed-background-dark text-light-op">
								<span class="pull-right text-muted"><?php echo htmlspecialchars($sitename); ?></span>
								<i class="fa fa-desktop"></i> <b>服务器</b>
								</div>
								
								<div style="position: relative; width: auto" class="slimScrollDiv">
									<div id="stats">
										<table class="table table-striped">
											<tbody>
												<tr>
													<th><center>名称</center></th>
													<th><center>攻击</center></th>
													<th><center>目标</center></th>
													<th><center>停止功能</center></th>
													<th><center>状态</center></th>
												</tr>
												<tr>
												
												</tr>
												<?php
												if ($system == 'api') {
													$SQLGetInfo = $odb->query("SELECT * FROM `api` ORDER BY `id` DESC");
												} else {
													$SQLGetInfo = $odb->query("SELECT * FROM `servers` ORDER BY `id` DESC");
												}
												while ($getInfo = $SQLGetInfo->fetch(PDO::FETCH_ASSOC)) {
													$name    = $getInfo['name'];
													$attacks = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `handler` LIKE '%$name%' AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
													$load    = round($attacks / $getInfo['slots'] * 100, 2);
													echo '
													<script type="text/javascript">
													var auto_refresh = setInterval(
													function ()
													{
													$(\'#ra'.$name.'\').load(\'ajax/servers.php?sv='.$name.'\').fadeIn("slow");
													}, 1000); // refresh every 10000 milliseconds
													</script>
													
													
													<tr>
																<td><center>' . $name . '</center></td>
																<td><center><div id="ra'.$name.'"></center></td>
																<td><center>所有</center></td>
																<td><center>是</center></td>
																<td><center><span class="label label-success">启用</span></center></td>
														   </tr>';
												}
												?>
											</tbody>
										</table>
									</div>
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