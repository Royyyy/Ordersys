<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"E:\wamp64\www\Ordersys\public/../application/index\view\order\showorder.html";i:1516957015;}*/ ?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<?php if(is_array($sort) || $sort instanceof \think\Collection || $sort instanceof \think\Paginator): $i = 0; $__LIST__ = $sort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?>
			<div class="col-md-8" id="<?php echo $so['dsId']; ?>" style="position: relative">

				<div class="card">
					<div class="card-header" data-background-color="green">
						<h4 class="title">订单列表</h4>
					</div>
					<div class="card-content">
						asdasd

					</div>
				</div>
			</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
</div>

