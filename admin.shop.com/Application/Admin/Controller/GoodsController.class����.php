<?php
namespace Admin\Controller;


use Think\Controller;
use Think\Page;

class GoodsController extends BaseController
{
    protected $meta_title='商品';

    //>>1.准备商品分类数据
    //>>2.展示表单元素中展示分类的名字和隐藏域中保存分类的id
    //>>3.验证添加商品只能选择最子分类
    //>>4.添加页面展示前,准备需要的数据
    protected function _edit_view_before(){
        //1.查询出商品分类
        $goodscategorymodel=D('GoodsCategory');//创建商品分类对象
        $rows=$goodscategorymodel->getTreelist(true,'id,name,parent_id');
        $this->assign('zNodes',$rows);//将数据分配到页面上

        //2.查询出商品品牌数据
        $brandmodel=D('Brand');
        $brands=$brandmodel->getList('id,name');
        $this->assign('brands',$brands);
        //dump($brans);

        //3.查询出供应商数据,为页面提供数据
        $supplierModel=D('Supplier');
        $rows=$supplierModel->getList('id,name');
        $this->assign('rows',$rows);
    }
}