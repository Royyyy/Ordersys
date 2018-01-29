<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"E:\wamp64\www\Ordersys\public/../application/index\view\order\cart.html";i:1517221722;}*/ ?>

<div class="col-lg-4 col-md-12" style="position: absolute;left: 66%;">
	<div class="card">
		<div class="card-header" data-background-color="green">
			<h4 class="title"><?php echo \think\Session::get('orderId'); ?>号订单详情</h4>
			<p class="category">开单时间:<?php echo \think\Session::get('orderBeginDate'); ?>,经手人：<?php echo \think\Session::get('userAccount'); ?></p>
		</div>
		<div class="card-content table-responsive">
			<table class="table table-hover">
				<thead class="text-warning">
				<th>ID</th>
				<th>菜品名字</th>
				<th>价格</th>
				<th>数量</th>

				</thead>
				<tbody>
				<?php if(is_array($cart) || $cart instanceof \think\Collection || $cart instanceof \think\Paginator): $i = 0; $__LIST__ = $cart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?>
				<tr>
					<td><?php echo $c['cartId']; ?></td>
					<td><?php echo $c['dishesName']; ?></td>
					<td><?php echo $c['dishesPrice']; ?></td>
					<td><?php echo $c['num']; ?></td>

				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<hr/>
			<h3>total：<?php echo $cart['price']; ?>元</h3><a href="<?php echo url('order/orderAdd',['orderId'=>\think\Session::get('orderId'),'price'=>$cart['price']]); ?>" class="btn btn-primary btn-round" data-background-color="green" style="width: 100%">确认订单</a>
		</div>
	</div>
</div>
