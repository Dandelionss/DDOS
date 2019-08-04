<?php

$paginaname = '购买';


?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
			<?php 
			
			include("@/header.php");

			?>
                    <div id="page-content">
            
                        <div class="row">	
						
						<div class="col-sm-12">
							<div class="widget">
								<div class="widget-content widget-content-mini themed-background-dark text-light-op">
								<span class="pull-right text-muted">所有付款都是手动的！</span>
								<i class="fa fa-shopping-cart"></i> <b>购买</b>
								</div>
								
								<div style="position: relative; width: auto" class="slimScrollDiv">
									<div id="stats">
										<table class="table table-striped">
											<tbody>
												<tr>
													<th><center>套餐</center></th>
													<th><center>时间</center></th>
													<th><center>开机时间/并发</center></th>
													<th><center>每日攻击次数</center></th>
													<th><center>价格</center></th>
													<th><center>支付方式</center></th>
												</tr>
												<?php
												$SQLGetPlans = $odb -> query("SELECT * FROM `plans` WHERE `private` = 0 ORDER BY `price` ASC");
												while ($getInfo = $SQLGetPlans -> fetch(PDO::FETCH_ASSOC))
												{
													$name = $getInfo['name'];
													$price = $getInfo['price'];
													$length = $getInfo['length'];
													$unit = $getInfo['unit'];
													$concurrents = $getInfo['concurrents'];
													$mbt = $getInfo['mbt'];
													$ID = $getInfo['ID'];
													$cishu = $getInfo['cishu'];
													
													echo '
													<tr>
														<td><center>'.htmlspecialchars($name).'</center></td>
														<td><center>'.$length.' '.htmlspecialchars($unit).'</center></td>
														<td><center>'.$mbt.'秒 '.$concurrents.' 并发</center></td>
														<td><center>'.$cishu.' 次</td>
														<td><center>￥'.$price.'</td>
														<td><center>
														<a href="paypal.php?id='.$ID.'"><img src="img/paypal.png" /></a>
														
														</center></td>
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