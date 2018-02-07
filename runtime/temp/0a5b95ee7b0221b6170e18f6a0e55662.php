<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"E:\wamp64\www\Ordersys\public/../application/index\view\order\showOrderChef.html";i:1517837881;}*/ ?>
<div class="content" id="uid">
	<div class="container-fluid">
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
							<th>开单时间</th>

							<th>操作</th>
							</thead>
							<tbody>
								<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<tr id="tr_<?php echo $vo['orderId']; ?>">
										<td><?php echo $vo['orderId']; ?></td>
										<td><?php echo $vo['userAccount']; ?></td>
										<td class="text-primary">$<?php echo $vo['price']; ?></td>
										<td><?php echo date("Y-m-d H:i",$vo['orderBeginDate']); ?></td>

										<td><a id="<?php echo $vo['orderId']; ?>"><img src="/static/img/liulan.png" style="height: 30px;width: 40px;" onclick="doit('<?php echo $vo['orderId']; ?>')"></a></td>
									</tr>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</tbody>

						</table>
						<div>
							<?php echo $page; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $(".content").on("click",".pagination a",function(){
        var url=$(this).attr("data-page");

        getPage(url);
    });
    function getPage(url)
    {
        $.get(url, function(result){
            $(".content").html(result);

        });
	}

    function doit(orderId) {
        var url = "<?php echo url('order/orderDetailChef'); ?>";
        $("#uid").load(url,{"orderId" : orderId});
    }
</script>
