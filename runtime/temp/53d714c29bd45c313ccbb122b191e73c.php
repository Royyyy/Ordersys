<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:62:"E:\wamp64\www\Ordersys/application/index\view\index\index.html";i:1515579296;s:63:"E:\wamp64\www\Ordersys/application/index\view\index\header.html";i:1515589488;s:63:"E:\wamp64\www\Ordersys/application/index\view\index\footer.html";i:1515470837;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="__PUBLIC__img/apple-icon.png" />
    <link rel="icon" type="image/png" href="__PUBLIC__img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>点我点餐系统登录页面</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="__PUBLIC__css/bootstrap.min.css" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="__PUBLIC__css/material-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="__PUBLIC__css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!--  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'/> -->

    <link href="__PUBLIC__css/material-icons.css" rel="stylesheet" />
</head>

<body>


    <div class="main-panel">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Profile</a>
                </div>

            </div>
        </nav>
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header" data-background-color="purple">
								<h4 class="title">Edit Profile</h4>
								<p class="category">Complete your profile</p>
							</div>
							<div class="card-content">
								<form>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group label-floating">
												<label class="control-label">Company (disabled)</label>
												<input type="text" class="form-control" disabled>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label">Username</label>
												<input type="text" class="form-control" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group label-floating">
												<label class="control-label">Email address</label>
												<input type="email" class="form-control" >
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Fist Name</label>
												<input type="text" class="form-control" >
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Last Name</label>
												<input type="text" class="form-control" >
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group label-floating">
												<label class="control-label">Adress</label>
												<input type="text" class="form-control" >
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group label-floating">
												<label class="control-label">City</label>
												<input type="text" class="form-control" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group label-floating">
												<label class="control-label">Country</label>
												<input type="text" class="form-control" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group label-floating">
												<label class="control-label">Postal Code</label>
												<input type="text" class="form-control" >
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>About Me</label>
												<div class="form-group label-floating">
													<label class="control-label"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
													<textarea class="form-control" rows="5"></textarea>
												</div>
											</div>
										</div>
									</div>

									<a href="<?php echo url('User/index'); ?>"><button type="submit" class="btn btn-primary pull-right">Update Profile</button></a>
									<div class="clearfix"></div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>


<!--<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="#">
                        Home
                    </a>
                </li>
                <li>
                    <a href="#">
                        Company
                    </a>
                </li>
                <li>
                    <a href="#">
                        Portfolio
                    </a>
                </li>
                <li>
                    <a href="#">
                        Blog
                    </a>
                </li>
            </ul>
        </nav>
        <p class="copyright pull-right">
            &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
        </p>
    </div>
</footer>
</div>
</div>
</body>

<!--   Core JS Files   -->
<script src="__DIR__js/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="__DIR__js/bootstrap.min.js" type="text/javascript"></script>
<script src="__DIR__js/material.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src=".__DIR__js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="__DIR__js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

<!-- Material Dashboard javascript methods -->
<script src="__DIR__js/material-dashboard.js"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="__DIR__js/demo.js"></script>

</html>
-->
