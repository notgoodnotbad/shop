<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - <?php echo ($meta_title); ?> </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/Admin/css/common.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>">商品<?php echo ($meta_title); ?></a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>
    <div style="clear:both"></div>
</h1>

    <div class="main-div">
        <form method="post" action="<?php echo U();?>">
            <table cellspacing="1" cellpadding="3" width="100%">
                                <tr>
                    <td class="label">品牌名称</td>
                    <td>
                        <input type='text' name='name' maxlength='60' value='<?php echo ($name); ?>'/>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">品牌网址</td>
                    <td>
                        <input type='text' name='url' maxlength='60' value='<?php echo ($url); ?>'/>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">品牌LOGO</td>
                    <td>
                        <input type='file' name='' maxlength='60'/>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">排序</td>
                    <td>
                        <input type='text' name='sort' maxlength='60' value='<?php echo ($sort); ?>'/>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">品牌简介</td>
                    <td>
                        <textarea  name='intro' cols='60' rows='4'  ><?php echo ($intro); ?></textarea>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">是否显示</td>
                    <td>
                        <input type='radio' class='status' name='status' value='1'/> 是<input type='radio' class='status' name='status' value='0'/> 否                        <span class='require-field'>*</span>
                    </td>
                </tr>
                

                <tr>
                    <td colspan="2" align="center"><br/>
                        <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
                        <input type="submit" class="button ajax-post" value=" 确定 "/>
                        <input type="reset" class="button" value=" 重置 "/>
                    </td>
                </tr>
            </table>
        </form>
    </div>

<div id="footer">
    共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
  <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.2.js"></script>
  <script type="text/javascript" src="http://admin.shop.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery.form.js"></script>
  <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/common.js"></script>

    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#logo_uploader').uploadify({
                height: 30,  //c插件高
                width: 100,
                'buttonText': '上传图片',  //指定按钮上面的文字
                'debug': true,//是否调试
                'fileSizeLimit': '1MB',  //最大上传大小
                'swf': 'http://admin.shop.com/Public/Admin/uploadify/uploadify.swf',   //FLASH插件地址
                'uploader': "<?php echo U('Upload/index');?>",   //处理上传插件上传上来的文件
//                'fileObjName' :''  上传该文件时以什么名字上传m默认filedata
                'fileTypeExts': '*.gif; *.jpg; *.png', //允许上传的文件格式
                'formData':{'dir':'brand'},//上传文件时,告知控制器方法文件上传后保存的路径
                'onUploadSuccess': function (file, data, response) {   //文件上传成功后,data是服务器相应后文件的路径
                    $('.upload-img-box').show();//显示div
                    $('.upload-img-box .upload-pre-item img').attr('src', '/Uploads/' + data)
                },
                'onUploadError': function (file, data, response) {   //文件上传成功后,data是服务器相应后文件的路径
                    alert('预览失败');
                }
            })
        })
    </script>

<script type="text/javascript">
    $(function(){
        $('.status').val
        ([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    })
</script>
</body>
</html>