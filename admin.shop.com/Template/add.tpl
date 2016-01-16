<extend name="Common/add"/>
<block name="add">
    <div class="main-div">
        <form method="post" action="{:U()}">
            <table cellspacing="1" cellpadding="3" width="100%">
                <?php foreach($filds as $fild): ?>
                <tr>
                    <td class="label"><?php echo $fild['comment']?></td>
                    <td>
                        <?php
                    if(!isset($fild['fild_type'])){
                          if($fild['fild_type']=='sort'){
                       echo "<input type='text' name='{\$sort}' maxlength='60' value='{\$sort|default=20}' />";
                        }else{
                        echo "<input type='text' name='{$fild['field']}' maxlength='60' value='{\${$fild['field']}}'/>";
                        }
                        }elseif($fild['fild_type']=='textarea'){
                        echo "<textarea  name='{$fild['field']}' cols='60' rows='4'  >{\${$fild['field']}}</textarea>";
                        }elseif($fild['fild_type']=='radio'){
                        foreach($fild['fild_option'] as $k=>$v){
                        echo "<input type='radio' class='{$fild['field']}' name='{$fild['field']}' value='{$k}'/> {$v}";
                        }
                        }elseif($fild['fild_type']=='file'){
                        echo "<input type='file' name='{$field['field']}' maxlength='60'/>";
                        }
                        ?>
                        <span class='require-field'>*</span>
                    </td>
                </tr>
                <?php endForeach ;?>


                <tr>
                    <td colspan="2" align="center"><br/>
                        <input type="hidden" name="id" value="{$id}"/>
                        <input type="submit" class="button ajax-post" value=" 确定 "/>
                        <input type="reset" class="button" value=" 重置 "/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</block>
<block name="js">
    <script type="text/javascript" src="__UPLOADIFY__/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#logo_uploader').uploadify({
                height: 30,  //c插件高
                width: 100,
                'buttonText': '上传图片',  //指定按钮上面的文字
                'debug': true,//是否调试
                'fileSizeLimit': '1MB',  //最大上传大小
                'swf': '__UPLOADIFY__/uploadify.swf',   //FLASH插件地址
                'uploader': "{:U('Upload/index')}",   //处理上传插件上传上来的文件
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
</block>