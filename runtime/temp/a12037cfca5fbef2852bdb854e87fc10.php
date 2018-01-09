<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:63:"D:\WWW\TP5.0\public/../application/index\view\index\test28.html";i:1477649836;s:57:"D:\WWW\TP5.0\public/../application/index\view\layout.html";i:1477649570;s:63:"D:\WWW\TP5.0\public/../application/index\view\index\header.html";i:1477649962;s:63:"D:\WWW\TP5.0\public/../application/index\view\index\footer.html";i:1477640739;}*/ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>[title]</title>
<link charset="utf-8" rel="stylesheet" href="__PUBLIC__/common.css">
</head>
<body>
    这里是公共模板头部
 <h2>用户列表（<?php echo $count; ?>）</h2> 
<?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
<div class="info">
ID：<?php echo $user['user_id']; ?><br/>
昵称：<?php echo $user['nickname']; ?><br/>
邮箱：<?php echo $user['email']; ?><br/>
生日：<?php echo $user['birthday']; ?><br/>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<div class="copyright">
    <a title="官方网站" href="http://www.thinkphp.cn">ThinkPHP</a> 
    <span>V5</span> 
    <span>{ 十年磨一剑-为API开发设计的高性能框架 }</span>
</div>
这里是公共模板底部
</body>
</html>