<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"E:\wamp64\www\Ordersys\public/../application/index\view\dishes\dishesAddView.html";i:1517762376;}*/ ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">菜品添加</h4>
                        <p class="category"></p>
                    </div>

                    <div class="card-content">
                        <form action="<?php echo url('dishes/dishesAdd'); ?>" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">菜名（15个字以内）</label>
                                        <input type="text" id="dishesName" class="form-control" name="dishesName" maxlength="15" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">菜品简介（20个字以内）</label>
                                        <input type="text" id="dishesDiscript" name="dishesDiscript" class="form-control" maxlength="20"  required>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">菜品价格（只能输入数字）</label>
                                        <input type="text" id="dishesPrice" name="dishesPrice" class="form-control" maxlength="20"  onkeyup="if(!this.value.match(/^[\+\-]?\d*?\.?\d*?$/))this.value=this.t_value;else this.t_value=this.value;if(this.value.match(/^(?:[\+\-]?\d+(?:\.\d+)?)?$/))this.o_value=this.value;" onblur="if(!this.value.match(/^(?:[\+\-]?\d+(?:\.\d+)?|\.\d*?)?$/))this.value=this.o_value;else{if(this.value.match(/^\.\d+$/))this.value=0+this.value;if(this.value.match(/^\.$/))this.value=0;this.o_value=this.value}" required>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">是否为推荐菜</label>
                                        <select class="control-label" name="recommend" style="width: 100%">
                                            <option value="1" selected>是</option>
                                            <option value="0" selected>否</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">分类</label>
                                        <select class="control-label" name="dsId" style="width: 100%">
                                            <?php if(is_array($sort) || $sort instanceof \think\Collection || $sort instanceof \think\Paginator): $i = 0; $__LIST__ = $sort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sort): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo $sort['dsId']; ?>"><?php echo $sort['dsName']; ?></option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
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
                                        <input id="doc-form-file" type="file" name="dishesImg" onchange='PreviewImage(this)' multiple>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div id="imgPreview" class="am-u-sm-4 am-u-sm-centered am-u-end">
                                        <img id="img1" src="" alt="" style="width: 150px;height: 150px"/><!-- 显示缩略图 -->
                                    </div>
                                </div>

                            </div>
                            <input type="submit" class="btn btn-primary pull-right" id="dishesaddsubmit" value="提交"/>
                            <div class="clearfix"></div>
                        </form>
                    </div>

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
            document.getElementById("imgPreview").innerHTML="<img id=\"img1\" src=\"\" alt=\"\" style=\"width: 150px;height: 150px\"/>";
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



</script>