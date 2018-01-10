<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"E:\wamp64\www\Ordersys\public/../application/index\view\index\index.html";i:1515602766;s:73:"E:\wamp64\www\Ordersys\public/../application/index\view\index\header.html";i:1515597443;s:73:"E:\wamp64\www\Ordersys\public/../application/index\view\index\footer.html";i:1515597837;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="__STATIC__img/apple-icon.png" />
    <link rel="icon" type="image/png" href="__STATIC__img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>点我点餐系统登录页面</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="__STATIC__css/bootstrap.min.css" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="__STATIC__css/material-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="__STATIC__css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!--  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'/> -->

    <link href="__STATIC__css/material-icons.css" rel="stylesheet" />
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
							<div class="card-content">
								<form action="<?php echo url('User/login'); ?>">
									<div class="col-md-3">
										<div class="form-group label-floating">
											<label class="control-label">用户名</label>
											<input type="text" class="form-control" name="userAccount">
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label">密码</label>
												<input type="password" class="form-control" name="userPass">
											</div>
										</div>
									</div>
									<div class="row" style="margin-left: 0.2%">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label">验证码</label>
												<input type="text" class="form-control" name="verify" data-error="验证码错误" required>
											</div>
										</div>
										<div class="col-md-2">
											<img id="verifyimg"class="verifyimg reloadverify" src="<?php echo url('User/verify'); ?>" alt="">
										</div>
									</div>

									<a href="<?php echo url('User/index'); ?>">Click me</a>
									<button type="submit" class="btn btn-primary pull-right">Update Profile</button>
									<div class="clearfix"></div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
<script>
    $(function(){
        // 刷新验证码
        var verifyimg = $(".verifyimg").attr("src");
        $(".reloadverify").click(function(){
            if( verifyimg.indexOf('?')>0){
                $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
    })
</script>



</body>

<!--   Core JS Files   -->
<script src="__STATIC__js/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="__STATIC__js/bootstrap.min.js" type="text/javascript"></script>
<script src="__STATIC__js/material.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="__STATIC__js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="__STATIC__js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

<!-- Material Dashboard javascript methods -->
<script src="__STATIC__js/material-dashboard.js"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="__STATIC__js/demo.js"></script>

</html>

