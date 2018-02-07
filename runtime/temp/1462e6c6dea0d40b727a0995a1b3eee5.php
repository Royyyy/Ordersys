<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"E:\wamp64\www\Ordersys\public/../application/index\view\order\orderDetailChef.html";i:1517839260;}*/ ?>
<div class="content" id="uid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title"><?php echo $vo['orderId']; ?>号订单详情</h4>
                        <p class="category">时间:<?php echo date("Y-m-d H:i",$vo['orderBeginDate']); ?>~<?php echo date("Y-m-d H:i",$vo['orderEndDate']); ?>,经手人：<?php echo $vo['userAccount']; ?></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                            <th>ID</th>
                            <th>菜品名字</th>
                            <th>价格</th>
                            <th>数量</th>
                            <th>操作</th>

                            </thead>
                            <tbody>
                            <?php if(is_array($dishes) || $dishes instanceof \think\Collection || $dishes instanceof \think\Paginator): $i = 0; $__LIST__ = $dishes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;if($d['state'] == 0): ?>
                            <tr id="tr_<?php echo $d['odId']; ?>">
                                <td><?php echo $d['odId']; ?></td>
                                <td><?php echo $d['dishesName']; ?></td>
                                <td>$<?php echo $d['dishesPrice']; ?></td>
                                <td><?php echo $d['num']; ?></td>
                                <td><a><img src="/static/img/cook.png" style="height: 40px;width: 50px;" onclick="disp_confirm('<?php echo $d['odId']; ?>')"></a></td>
                            </tr>
                            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function disp_confirm(odId) {

        var r = confirm('菜品烹饪完成？');
        if (r == true)
        {
            result = cdsReg(odId);
            if (result){

            }else{

            }
        } else {}
    }

    function cdsReg(odId){
        $.ajax({
            type:'post',
            url:"<?php echo url('order/changeDishesState'); ?>",
            data:{
                "odId":odId
            },
            success:function(data){
                if(data==1){
                    alert("完成");
                    $("#tr_"+odId).remove();//主要就是这个删除成功后移除这行数据
                }
            }

        })
    }
</script>