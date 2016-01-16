<?php
namespace Admin\Controller;


use Think\Controller;
use Think\Page;

class GoodsCategoryController extends BaseController
{
    protected $meta_title='商品分类';
    public function index()
    {
        //>>1.显示列表
        //>>2.使用jquery插件treegrid插件完成树状结构列表
        $rows=$this->model->getTreeList();
        $this->assign('rows',$rows);
        $this->assign('meta_title',$this->meta_title);
        $this->display('index');
//        dump(cookie());
    }

   //>>添加分类
    public function add(){
        //>>1.添加分类,父分类使用jquery的ztree树状结构插件完成
        //>>2.添加页面之前准备分类 数据
        //>>3.设置带有缩进的树状结构
        //>>4.全部显示节点数据
        //>>5.父分类设为不可写,禁用
        //>>6.当没有选中分类时,默认顶级分类
        //>>7.当选择父分类时,将父分类的名字放到父分类中
        //>>8.在模型中添加分类到数据库,使用NestedSet(嵌套集合)插件计算节点的左右边界,并准备sql改变边界
        //>>9.在模型中创建执行sql的接口对象
        if (IS_POST) {
//            $suppliermodel=D('Supplier');
            if ($this->model->create() !== false) {
                if ($this->model->add() !== false) {
                    $this->success('添加成功', U('index'));
                    return;  //成功就跳出
                }
            }
            $this->error('操作失败' . show_model_error($this->model));

        } else {
            //>>返回一个json数据
            $zNodes=$this->model->getTreeList(true,'id,name,parent_id');
            $this->assign('zNodes',$zNodes);
            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->display('add');
        }
    }

    public function edit($id)
    {
        //>>1.通过get请求时,回显数据和回显所有缩进分类
        //>>2.get请求时自动选择ztree插件上的父分类
        //>>3.在表单元素上回显父分类
        //>>4.在model中移动某个节点到其他分类下
        //>5.在model中更新数据库
//        $this->model=D('Supplier');
        if (IS_POST) {
            if ($this->model->create() !== false) {
//                dump($id);
//                exit;
                if ($this->model->save() !== false) {
                    $this->success('修改成功', U('index'));
                } else {
                    $this->error('操作失败'.show_model_error($this->model));
                }
            }
        } else {
            $row = $this->model->find($id);
            $this->assign($row);
            $this->assign('meta_title', '编辑'.$this->meta_title);
            //>>回显父分类
            $zNodes=$this->model->getTreeList(true,'id,name,parent_id');
            $this->assign('zNodes',$zNodes);
            $this->display('add');
        }
    }

}