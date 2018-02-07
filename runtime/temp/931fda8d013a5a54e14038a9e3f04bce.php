<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"E:\wamp64\www\Ordersys\public/../application/index\view\dishes\dishesList.html";i:1517828449;}*/ ?>
<div class="content" id="uid">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="purple">
						<h4 class="title">菜品列表</h4>
					</div>
					<div class="card-content table-responsive">
						<table class="table">
							<thead class="text-primary">
							<th>编号</th>
							<th>菜名</th>
							<th>图片</th>
							<th>是否推荐菜</th>
							<th>价格</th>
							<th>菜品分类</th>
							<th>操作</th>
							</thead>
							<tbody>
							<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<tr id="tr_<?php echo $vo['dishesId']; ?>">
								<td><?php echo $vo['dishesId']; ?></td>
								<td><?php echo $vo['dishesName']; ?></td>
								<?php if($vo['dishesImg'] == null): ?>
								<td><img src="/static/img/dishes.png" style="width: 120px;height: 80px;padding: 10px" ></td>
								<?php else: ?>
								<td><img src="/<?php echo $vo['dishesImg']; ?>" style="width: 120px;height: 80px;padding: 10px" ></td>
								<?php endif; if($vo['recommend'] == 0): ?>
								<td>否</td>
								<?php else: ?>
								<td>是</td>
								<?php endif; ?>
								<td class="text-primary">$<?php echo $vo['dishesPrice']; ?></td>
								<td ><?php echo $vo['dsName']; ?></td>
								<td><a id="<?php echo $vo['dishesId']; ?>"><img src="/static/img/liulan.png" style="height: 30px;width: 40px;" onclick="doit('<?php echo $vo['dishesId']; ?>')"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="<?php echo $vo['dishesId']; ?>"><img src="/static/img/close.png" style="height: 30px;width: 40px;" onclick="disp_confirm('<?php echo $vo['dishesId']; ?>')"></a> </td>

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
    function doit(dishesId) {
        var url = "<?php echo url('dishes/manDishesDetail'); ?>";
        $("#uid").load(url,{"dishesId" : dishesId});
    }
    function disp_confirm(dishesId) {

        var r = confirm('你确定要删除数据吗？');
        if (r == true)
        {
            result = deleteReg(dishesId);
            if (result){

            }else{

            }
        } else {}
    }

    function deleteReg(dishesId){
        $.ajax({
            type:'post',
            url:"<?php echo url('dishes/dishesDel'); ?>",
            data:{
                "dishesId":dishesId
            },
            success:function(data){
                if(data==1){
                    alert("删除成功");
                    $("#tr_"+dishesId).remove();//主要就是这个删除成功后移除这行数据
                }
            }

        })
    }
</script>
