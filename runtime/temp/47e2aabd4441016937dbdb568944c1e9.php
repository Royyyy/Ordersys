<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"E:\wamp64\www\Ordersys\public/../application/index\view\dishes\dishesSortList.html";i:1517828433;}*/ ?>
<div class="content" id="uid">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="purple">
						<h4 class="title">菜品分类列表</h4>
					</div>
					<div class="card-content table-responsive">
						<table class="table">
							<thead class="text-primary">
							<th>编号</th>
							<th>菜名分类类名</th>
							<th>操作</th>
							</thead>
							<tbody>
							<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<tr id="tr_<?php echo $vo['dsId']; ?>">
								<td><?php echo $vo['dsId']; ?></td>
								<td><?php echo $vo['dsName']; ?></td>
								<td><a id="<?php echo $vo['dsId']; ?>"><img src="/static/img/liulan.png" style="height: 30px;width: 40px;" onclick="doit('<?php echo $vo['dsId']; ?>')"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="<?php echo $vo['dsId']; ?>"><img src="/static/img/close.png" style="height: 30px;width: 40px;" onclick="disp_confirm('<?php echo $vo['dsId']; ?>')"></a> </td>

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
    function doit(dsId) {
        var url = "<?php echo url('dishes/manDishesSortDetail'); ?>";
        $("#uid").load(url,{"dsId" : dsId});
    }

    function disp_confirm(dsId) {

        var r = confirm('你确定要删除数据吗？');
        if (r == true)
        {
            result = deleteReg(dsId);
            if (result){

            }else{

            }
        } else {}
    }

    function deleteReg(dsId){
        $.ajax({
            type:'post',
            url:"<?php echo url('dishes/dishesSortDel'); ?>",
            data:{
                "dsId":dsId
            },
            success:function(data){
                if(data==1){
                    alert("删除成功");
                    $("#tr_"+dsId).remove();//主要就是这个删除成功后移除这行数据
                }
            }

        })
    }
</script>

