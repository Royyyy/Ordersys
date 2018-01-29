<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"E:\wamp64\www\Ordersys\public/../application/index\view\dishes\disheslist.html";i:1516077104;s:63:"E:\wamp64\www\Ordersys\application\index\view\index\header.html";i:1515597443;s:63:"E:\wamp64\www\Ordersys\application\index\view\index\footer.html";i:1515607050;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="static/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="static/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>点我点餐系统登录页面</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="static/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="static/css/material-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="static/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!--  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'/> -->

    <link href="static/css/material-icons.css" rel="stylesheet" />
</head>

<body>


    <div class="main-panel">

		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header" data-background-color="purple">
								<h4 class="title">登陆界面</h4>
								<p class="category">欢迎来到点我点餐系统</p>
							</div>
							<thead>
							<tr>
								<th>菜品编号
								<th>菜品名称
								<th>菜品简介
								<th>菜品图片
								<th>菜品详情
								<th>是否推荐
								<th>菜品单价
								<th>菜品类别编号
								<th>菜品类别
							</th>
							</thead>


							<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<tr>
								<td><?php echo $vo['dishesId']; ?>
								<td><?php echo $vo['dishesName']; ?>
								<td><?php echo $vo['dishesDiscript']; ?>
								<td><?php echo $vo['dishesImg']; ?>
								<td><?php echo $vo['dishesTxt']; ?>
								<td><?php echo $vo['recommend']; ?>
								<td><?php echo $vo['dishesPrice']; ?>
								<td><?php echo $vo['dsId']; ?>
								<td><?php echo $vo['dsName']; ?>



							</tr>
							<?php endforeach; endif; else: echo "" ;endif; ?>

						</div>
					</div>

				</div>
			</div>
		</div>




</body>

<!--   Core JS Files   -->
<script>
    function reflash2(){
        // 刷新验证码
        var verifyimg = $(".verifyimg").attr("src");
//        return alert(verifyimg.indexOf('?'));

//        $(".reloadverify").click(function(){

            if( verifyimg.indexOf('?')>0){
                $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
//        });
    }
</script>
<script src="static/js/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="static/js/bootstrap.min.js" type="text/javascript"></script>
<script src="static/js/material.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="static/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="static/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

<!-- Material Dashboard javascript methods -->
<script src="static/js/material-dashboard.js"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="static/js/demo.js"></script>

</html>

