<?php

$paginaname = '激活套餐';

			



?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
			<?php 
			
			include("@/header.php");

				if (isset($_POST['jihuo']))
				{
					$jihuo = $_POST['code'];

					if (empty($jihuo)) {
						echo "<script>
								window.alert('请输入激活码');
							  </script>";
					}else{
						$swdw = $odb->query("SELECT * FROM `cardcode` WHERE `code` = '$jihuo'")->fetchColumn(0);
						if ($swdw) {

							
							$swdw = $odb->query("SELECT state FROM `cardcode` WHERE `code` = '$jihuo'")->fetchColumn(0);
							if ($swdw !=0) {
								echo "<script>
										window.alert('该激活码已被使用');
									  </script>";
							}else{
								$swdw = $odb->query("SELECT plansid FROM `cardcode` WHERE `code` = '$jihuo'")->fetchColumn(0);

								$getPlanInfo = $odb -> prepare("SELECT `unit`,`length` FROM `plans` WHERE `ID` = :plan");
								$getPlanInfo -> execute(array(':plan' => $swdw));
								$plan = $getPlanInfo -> fetch(PDO::FETCH_ASSOC);
								$unit = $plan['unit'];
								$length = $plan['length'];
								$newExpire = strtotime("+{$length} {$unit}");
								
								$updateSQL = $odb -> prepare("UPDATE `users` SET `expire` = :expire, `membership` = :plan WHERE `id` = :id");
								$updateSQL -> execute(array(':expire' => $newExpire, ':plan' => $swdw , ':id' => $_SESSION['ID']));

								$updateSQL = $odb -> prepare("UPDATE `cardcode` SET `state` = :state,`uid` = :uid, `jtime` = :jtime WHERE `code` = :code");
								$updateSQL -> execute(array(':state' => 1, ':jtime' => time() ,':uid' => $_SESSION['ID'] , ':code' => $jihuo));

								echo "<script>
										window.alert('激活套餐成功');
									  </script>";
							}

						}else{
							echo "<script>
									window.alert('激活码不存在');
								  </script>";
						}
					}
				}
			?>
<div id="page-content" style="min-height: 445px;">
            
                        <div class="row">
						
                          
						<div class="col-sm-12">
						
 
							<div class="widget">
								<div class="widget-content widget-content-mini themed-background-dark text-light-op">
								<span class="pull-right text-muted">自助激活码开通套餐</span>
								<i class="fa fa-send"></i> <b>自助激活</b>
								</div>
								
								<div class="widget-content">
								<form action="" method="POST"><fieldset>
									<div align="center">
									<center>
	                                    <div class="form-group">
	                                        <div class="col-md-2"><strong>激活码</strong></div>
	                                        <div class="col-md-7"><input type="text" name="code" value="" class="form-control"></div><br>            
	                                    </div></center><br>
										<br>
									</div>
									<br><center><a href="http://baidu.com" target="_banlk" color="orange"><b>点击购买激活码</b></a></center><br><br>
									<center>	<button type="submit" name="jihuo" class="btn btn-success">激活</button></center></fieldset>
								</form>
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