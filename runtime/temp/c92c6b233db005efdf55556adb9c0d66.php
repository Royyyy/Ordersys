<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"E:\wamp64\www\Ordersys\public/../application/index\view\user\table.html";i:1517839571;}*/ ?>

<div class="row">
	<?php if(is_array($table) || $table instanceof \think\Collection || $table instanceof \think\Paginator): $i = 0; $__LIST__ = $table;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<div class="col-md-4">
			<a href="<?php echo url('index/order/setTableNum',['tableId'=>$vo['tableId'],'waiterId'=>\think\Session::get('userId')]); ?>" onclick="return confirm('您确定要选择这张桌子吗?')">
				<div class="card">
					<div class="card-header card-chart" data-background-color="purple">
						<div class="ct-chart" id="dailySalesChart"></div>
					</div>
					<div class="card-content">
						<h4 class="title"><?php echo $vo['tableId']; ?>  号桌</h4>
						<p class="category"><span class="text-success">空桌</span></p>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach; endif; else: echo "" ;endif; ?>
</div>
