<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\WWW\TP5.0\public/../application/index\view\upload\index2.html";i:1478593747;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>文件上传示例</title>
<style>
body {
    font-family:"Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size:16px;
    padding:5px;
}
.form{
    padding: 15px;
    font-size: 16px;
}

.form .text {
    padding: 3px;
    margin:2px 10px;
    width: 240px;
    height: 24px;
    line-height: 28px;
    border: 1px solid #D4D4D4;
}
.form .btn{
    margin:6px;
    padding: 6px;
    width: 120px;

    font-size: 16px;
    border: 1px solid #D4D4D4;
    cursor: pointer;
    background:#eee;
}
.form .file{
    margin:6px;
    padding: 6px;
    width: 220px;

    font-size: 16px;
    border: 1px solid #D4D4D4;
    cursor: pointer;
    background:#eee;
}

a{
    color: #868686;
    cursor: pointer;
}
a:hover{
    text-decoration: underline;
}
h2{
    color: #4288ce;
    font-weight: 400;
    padding: 6px 0;
    margin: 6px 0 0;
    font-size: 28px;
    border-bottom: 1px solid #eee;
}
div{
    margin:8px;
}
.info{
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.copyright{
    margin-top: 24px;
    padding: 12px 0;
  border-top: 1px solid #eee;
}


</style>
</head>
<body>
<h2>文件上传示例</h2>
<FORM method="post" enctype="multipart/form-data" class="form" action="<?php echo url('up'); ?>">
选择文件：<INPUT type="file" class="file" name="file2"><br/>
<INPUT type="submit" class="btn" value=" 提交 ">
</FORM>

<div class="copyright">
    <a title="官方网站" href="http://www.thinkphp.cn">ThinkPHP</a> 
    <span>V5</span> 
    <span>{ 十年磨一剑-为API开发设计的高性能框架 }</span>
</div>
</body>
</html>