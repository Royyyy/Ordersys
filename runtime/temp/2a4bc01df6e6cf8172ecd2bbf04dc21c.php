<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"E:\wamp64\www\Ordersys\public/../application/index\view\user\userList.html";i:1517564301;}*/ ?>
<div class="content" id="uid">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" data-background-color="purple">
						<h4 class="title">用户列表</h4>
					</div>
					<div class="card-content table-responsive">
						<table class="table">
							<thead class="text-primary">
							<th>编号</th>
							<th>用户名</th>
							<th>头像</th>
							<th>职位</th>
							<th>操作</th>
							</thead>
							<tbody>
								<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<tr>
										<td><?php echo $vo['userId']; ?></td>
										<td><?php echo $vo['userAccount']; ?></td>
										<?php if($vo['faceImg'] == null): ?>
										<td><img src="/static/img/person.png" style="width: 120px;height: 80px;padding: 10px" ></td>
										<?php else: ?>
										<td><img src="/<?php echo $vo['faceImg']; ?>" style="width: 120px;height: 80px;padding: 10px" ></td>
										<?php endif; ?>
										<td class="text-primary"><?php echo $vo['roleName']; ?></td>
										<td><a id="{vo.userId}"><img src="/static/img/liulan.png" style="height: 30px;width: 40px;" onclick="doit('<?php echo $vo['userId']; ?>')"></a></td>

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
    function doit(userId) {
        var url = "<?php echo url('user/manuserDetail'); ?>";
        $("#uid").load(url,{"userId" : userId});
    }

</script>
<!--<script>-->
	<!--function page(page) {-->
		<!--$.get("<?php echo url('user/userList'); ?>",{page:page},function (data) {-->
			<!--$('#uid').html(data);-->
        <!--});-->
    <!--}-->
<!--</script>-->
