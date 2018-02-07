<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"E:\wamp64\www\Ordersys\public/../application/index\view\user\manuserDetail.html";i:1517755273;}*/ ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">用户信息中心</h4>
                        <p class="category"><?php echo $data['userAccount']; ?>用户的信息管理中心</p>
                    </div>

                    <div class="card-content">
                        <form action="<?php echo url('user/changeUserInfo'); ?>" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">密码(6-10位)</label>
                                        <input type="password" id="userPass" class="form-control" name="userPass" min="5" maxlength="10" onkeyup="validate()">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">确认密码</label>
                                        <input type="password" id="userPassComf" class="form-control" min="5" maxlength="10" onkeyup="validate()" >
                                        <span id="tishi"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">职务</label>
                                            <select class="control-label" name="role" style="width: 100%">
                                                <?php if(is_array($role) || $role instanceof \think\Collection || $role instanceof \think\Paginator): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;if($role['roleId'] == $data['role']): ?>
                                                        <option value="<?php echo $role['roleId']; ?>" selected><?php echo $role['roleName']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $role['roleId']; ?>"><?php echo $role['roleName']; ?></option>
                                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <input type="text" id="ImgURL" name="ImgURL" placeholder="图片地址" class="form-control" value="" disabled>

                                        <button type="button" class="am-btn am-btn-default am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 浏览</button>
                                        <input id="doc-form-file" type="file" name="faceImg" onchange='PreviewImage(this)' multiple>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div id="imgPreview" class="am-u-sm-4 am-u-sm-centered am-u-end">
                                        <img id="img1" src="/<?php echo $data['faceImg']; ?>" alt="" style="width: 150px;height: 150px"/><!-- 显示缩略图 -->
                                    </div>
                                </div>

                            </div>
                            <input type="text" value="<?php echo $data['userId']; ?>" name="userId" hidden>

                            <input type="submit" class="btn btn-primary pull-right" id="persubmit" value="提交"/>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(function() {
        $('#doc-form-file').on('change', function() {
            var fileNames = '';
            $.each(this.files, function() {
                fileNames +=  this.name ;
            });
            $('#ImgURL').val(fileNames);
        });
    });
    //===【浏览文件上传地址写入文本框】结束

    //缩略图显示方法
    function PreviewImage(imgFile)
    {
        var filextension=imgFile.value.substring(imgFile.value.lastIndexOf("."),imgFile.value.length);
        filextension=filextension.toLowerCase();
        if ((filextension!='.jpg')&&(filextension!='.gif')&&(filextension!='.jpeg')&&(filextension!='.png')&&(filextension!='.bmp'))
        {
            alert("对不起，系统仅支持标准格式的照片，请您调整格式后重新上传，谢谢 !");
            document.getElementById("imgPreview").innerHTML="<img id=\"img1\" src=\"/<?php echo $data['faceImg']; ?>\" alt=\"\" style=\"width: 150px;height: 150px\"/>";
            imgFile.focus();
        }
        else
        {
            var path;
            if(document.all)//IE
            {
                imgFile.select();
                path = document.selection.createRange().text;
                document.getElementById("imgPreview").innerHTML="";
                document.getElementById("imgPreview").style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")";//使用滤镜效果
            }
            else//FF
            {
                path=window.URL.createObjectURL(imgFile.files[0]);// FF 7.0以上
                //path = imgFile.files[0].getAsDataURL();// FF 3.0
                document.getElementById("imgPreview").innerHTML = "<img id='img1' style=\"width: 150px;height: 150px\"  src='"+path+"'/>";
                //document.getElementById("img1").src = path;
            }
        }
    }
    function validate() {
        var pwd1 = document.getElementById("userPass").value;
        var pwd2 = document.getElementById("userPassComf").value;
        if (pwd1.length>5){
        <!-- 对比两次输入的密码 -->
        if (pwd1 == '' || pwd2 == ''){
            document.getElementById("tishi").innerHTML="两次密码都不能为空";
            document.getElementById("persubmit").disabled = true;
        }
        else if(pwd1 != pwd2){
            document.getElementById("tishi").innerHTML="两次密码不相同";
            document.getElementById("persubmit").disabled = true;
        }else if(pwd1 == pwd2) {
            document.getElementById("tishi").innerHTML="两次密码相同";
            document.getElementById("persubmit").disabled = false;
        }
        }else{
            document.getElementById("tishi").innerHTML="密码长度必须为6-10位";
            document.getElementById("persubmit").disabled = true;
        }
    }


</script>