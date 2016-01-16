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
    
    <link rel="stylesheet" href="http://admin.shop.com/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>">商品<?php echo ($meta_title); ?></a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>
    <div style="clear:both"></div>
</h1>

    <div class="main-div">
        <div id="tabbar-div">
            <p>
                <span class="tab-front">通用信息</span>
                <span class="tab-back">详细描述</span>
                <span class="tab-back">会员价格</span>
                <span class="tab-back">商品属性</span>
                <span class="tab-back">商品相册</span>
                <span class="tab-back">关联文章</span>
            </p>
        </div>
        <form method="post" action="<?php echo U();?>">
            <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                    <td class="label">商品名称</td>
                    <td>
                        <input type='text' name='name' maxlength='60' value='<?php echo ($name); ?>'/>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">简称</td>
                    <td>
                        <input type='text' name='short_name' maxlength='60' value='<?php echo ($short_name); ?>'/>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品分类</td>
                    <td>
                        <input type="hidden" name="goods_category_id" class="goods_category_id" value="<?php echo ($goods_category_id); ?>"/>
                        <input type='text' name='goods_category_name' class="goods_category_name" maxlength='60' value='请选择最子分类' disabled="disabled"/><span class='require-field' >*</span>

                        <style type="text/css">
                            .ztree{
                                margin-top: 10px;
                                border: 1px solid #617775;
                                background: #f0f6e4;
                                width: 220px;
                                height: auto;
                                overflow-y: scroll;
                                overflow-x: auto;
                            }
                        </style>
                        <ul id="treeDemo" class="ztree"></ul>
                    </td>

                </tr>
                <tr>
                    <td class="label">商品品牌</td>
                    <td>
                        <?php echo arr2select(brand_id,$brands);?>
                        <!--<select name="brand">-->
                            <!--<option value="">&#45;&#45;请选择&#45;&#45;</option>-->
                            <!--<?php if(is_array($brands)): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brand): $mod = ($i % 2 );++$i;?>-->
                            <!--<option value="<?php echo ($brand["id"]); ?>"><?php echo ($brand["name"]); ?></option>-->
                            <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                        <!--</select>-->
                    </td>
                </tr>
                                <tr>
                    <td class="label">供货商</td>
                    <td>
                        <?php echo arr2select('supplier_id',$rows);?>
                    </td>
                </tr>
                                <tr>
                    <td class="label">本店价格</td>
                    <td>
                        <input type='text' name='shop_price' maxlength='60' value='<?php echo ($shop_price); ?>'/>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">市场价格</td>
                    <td>
                        <input type='text' name='market_price' maxlength='60' value='<?php echo ($market_price); ?>'/>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">商品LOGO</td>
                    <td>
                        <input type='file' name='' maxlength='60'/>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">库存</td>
                    <td>
                        <input type='text' name='stock' maxlength='60' value='<?php echo ($stock); ?>'/>                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">商品状态</td>
                    <td>
                        <input type='radio' class='goods_status' name='goods_status' value='1'/> 精品<input type='radio' class='goods_status' name='goods_status' value='2'/> 新品<input type='radio' class='goods_status' name='goods_status' value='4'/> 热销                        <span class='require-field'>*</span>
                    </td>
                </tr>
                                <tr>
                    <td class="label">是否显示</td>
                    <td>
                        <input type='radio' class='status' name='status' value='1'/> 是<input type='radio' class='status' name='status' value='0'/> 否                        <span class='require-field'>*</span>
                    </td>
                </tr>
            </table>

            <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
                <tr>
                    <td colspan="2">
                        <textarea id="intro" name="intro"></textarea>
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
                <tr>
                    <td class="label">会员价格</td>
                    <td>
                        <input type='text' name='name1' maxlength='60' value='<?php echo ($name); ?>'/> <span
                            class="require-field">*</span>
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
                <tr>
                    <td class="label">商品属性</td>
                    <td>
                        <input type='text' name='name2' maxlength='60' value='<?php echo ($name); ?>'/> <span
                            class="require-field">*</span>
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
                <tr>
                    <td class="label">商品相册</td>
                    <td>
                        <input type='text' name='name3' maxlength='60' value='<?php echo ($name); ?>'/> <span
                            class="require-field">*</span>
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="3" width="100%"  style="display: none">
                <tr>
                    <td class="label">关联文章</td>
                    <td>
                        <input type='text' name='name5' maxlength='60' value='<?php echo ($name); ?>'/> <span
                            class="require-field">*</span>
                    </td>
                </tr>
            </table>
            <div style="text-align: center">
                <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
                <input type="submit" class="button" value=" 确定 "/>
                <input type="reset" class="button" value=" 重置 "/>
            </div>
        </form>
    </div>

<div id="footer">
    共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
  <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.2.js"></script>
  <script type="text/javascript" src="http://admin.shop.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery.form.js"></script>
  <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/common.js"></script>

    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/zTree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript">
        $(function(){
            /*******************1.样式切换和表切换*******************************/
            $('#tabbar-div span').click(function(){
                //找到span标签,将其样式删除 再添加
                $('#tabbar-div span').removeClass('tab-front').addClass('tab-back');
                $(this).removeClass('tab-back').addClass('tab-front');
                //点击不同的span,切换到不同的表
                var index=$(this).index();  //得到span标签的索引值
//                console.debug(index);
                $('.main-div form table').hide();//隐藏所有表
                $('.main-div form table').eq(index).show();//显示span索引对应的表
            })

            /*******************2.显示分类树*******************************/
            //树结构设置
            var setting={
                data:{
                    simpleData:{
                        enable:true,
                        pIdKey:'parent_id',//设置缩进关系
                    }
                },
                callback:{
                    //选中节点时显示父分类数据
                    onClick:function(event,treeId,treeNode){  //treeNode就是点击的节点
                        $('.goods_category_name').val(treeNode.name); //父类名称
                        $('.goods_category_id').val(treeNode.id)//父类id
                    },
                    //判定选中的是不是父分类,如果是父分类禁止选中
                    beforeClick:function(treeId, treeNode){
                        if(treeNode.isParent){
                            layer.msg('必须选中最子分类!', {
                                time:1000,  //等待时间后关闭
                                offset: 0,  //设置位置
                                icon:2,  //设置提示框中的图标
                            });
                            //返回false,不让选中
                            return !treeNode.isParent;
                        }
                    }
                    }
                }

            //>>树节点数据
            var zNodes=<?php echo ($zNodes); ?>;
            //>>找到ul,将ul变为树结构,并保存这个树结构
            var treeObj=$.fn.zTree.init($("#treeDemo"), setting, zNodes);
            <?php if(empty($id)): ?>//表示添加,  展开所有的节点
                    treeObj.expandAll(true);
            <?php else: ?>
            //表示编辑. 从treeObj中找到需要被选中的节点对象
            var parent_id = <?php echo ($parent_id); ?>;
            var node=treeObj.getNodeByParam('id',parent_id);//根据传过来的id的父id,找到父id的id节点
            treeObj.selectNode(node);//选中这个节点
            $('.parent_name').val(node.name);//将选中的name和id赋值给表单
            $('.parent_id').val(node.id);<?php endif; ?>



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