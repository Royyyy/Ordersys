<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"E:\wamp64\www\Ordersys\public/../application/index\view\order\showOrder.html";i:1517828091;}*/ ?>
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
							<th>订单状态</th>
							<th>操作</th>
							</thead>
							<tbody>
								<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<tr id="tr_<?php echo $vo['orderId']; ?>">
										<td><?php echo $vo['orderId']; ?></td>
										<td><?php echo $vo['userAccount']; ?></td>
										<td class="text-primary">$<?php echo $vo['price']; ?></td>
										<td><?php echo date("Y-m-d H:i",$vo['orderBeginDate']); ?></td>
										<td>未付款</td>
										<td><a id="<?php echo $vo['orderId']; ?>"><img src="/static/img/liulan.png" style="height: 30px;width: 40px;" onclick="doit('<?php echo $vo['orderId']; ?>')"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a><img src="/static/img/free.png" style="height: 40px;width: 50px;" onclick="disp_confirm('free','<?php echo $vo['orderId']; ?>')"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a><img src="/static/img/pay.png" style="height: 30px;width: 40px;" onclick="disp_confirm('pay','<?php echo $vo['orderId']; ?>')"></a></td>
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
        var url = "<?php echo url('order/orderDetail'); ?>";
        $("#uid").load(url,{"orderId" : orderId});
    }

    function disp_confirm(str,orderId) {

        if (str=='pay'){
        var r = confirm('你确定要对改订单进行付款操作吗？');
        if (r == true)
        {
            result = payReg(orderId);
            if (result){

            }else{

            }
        } else {}
    }else if (str=='free'){
        var r = confirm('你确定要对改订单进行免单操作吗？');
        if (r == true)
        {
            result = freeReg(orderId);
            if (result){

            }else{

            }
        } else {}
    	}
	}
    function payReg(orderId){
        $.ajax({
            type:'post',
            url:"<?php echo url('order/orderPay'); ?>",
            data:{
                "orderId":orderId
            },
            success:function(data){
                if(data==1){
                    alert("付款操作成功");
                    $("#tr_"+orderId).remove();//主要就是这个成功后移除这行数据
                }
            }

        })
    }

    function freeReg(orderId){
        $.ajax({
            type:'post',
            url:"<?php echo url('order/orderFree'); ?>",
            data:{
                "orderId":orderId
            },
            success:function(data){
                if(data==1){
                    alert("免单操作成功");
                    $("#tr_"+orderId).remove();//主要就是这个成功后移除这行数据
                }
            }

        })
    }
</script>
