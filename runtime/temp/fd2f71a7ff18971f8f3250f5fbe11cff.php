<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"E:\wamp64\www\Ordersys\public/../application/index\view\user\userListAjax.html";i:1517336145;}*/ ?>

					<div class="card-content table-responsive" id="uid">
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
										<td><img src="<?php echo $vo['faceImg']; ?>" style="width: 120px;height: 80px;padding: 10px" ></td>
										<?php endif; ?>
										<td class="text-primary"><?php echo $vo['roleName']; ?></td>
										<td> 操作按钮两个</td>

									</tr>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>
					</div>
