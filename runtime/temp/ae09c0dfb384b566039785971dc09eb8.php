<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"E:\wamp64\www\Ordersys\public/../application/index\view\order\showOrder.html";i:1517222423;}*/ ?>
<div class="content">
	<div class="container-fluid">
		<!--<div class="row">-->
			<!--<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
				<!--<div class="card">-->
					<!--<div class="card-header" data-background-color="green">-->
						<!--<h4 class="title">订单列表<?php echo $vo['orderId']; ?></h4>-->
					<!--</div>-->
					<!--<div class="card-content">-->
						<!--asdasd-->

					<!--</div>-->
				<!--</div>-->
			<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->

		<!--</div>-->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="purple">
						<h4 class="title">订单列表</h4>
					</div>
					<div class="card-content table-responsive">
						<table class="table">
							<thead class="text-primary">
							<th>订单号</th>
							<th>经手人</th>
							<th>总价</th>
							<th>订单状态</th>
							<th>操作</th>
							</thead>
							<tbody>
								<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<tr>
										<td><?php echo $vo['orderId']; ?></td>
										<td><?php echo $vo['userAccount']; ?></td>
										<td class="text-primary">$<?php echo $vo['price']; ?></td>
										<td> <?php echo $vo['orderState']; ?></td>
									</tr>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
	</div>
</div>

