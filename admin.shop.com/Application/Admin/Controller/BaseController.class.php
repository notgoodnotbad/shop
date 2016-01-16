<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/11
 * Time: 15:34
 */
namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{

    protected $model;
    public function _initialize()
    {
//        CONTROLLER_NAME;     获得浏览器上的控制器名
        $this->model = D(CONTROLLER_NAME);   //将当前模型保存到模型属性中
    }

    public function index()
    {
//        $this->model=D('Brand');
        $keyword = I('get.keyword');
        $wheres = array();  //存放查询条件
        if (!empty($keyword)) {
            $wheres['name'] = array('like', "%{$keyword}%");
        }
        $rows = $this->model->pageListHtml($wheres);
        $this->assign($rows);
        //>>将当前页面的url地址保存到cookie中
        cookie('__NOWURL__', $_SERVER['REQUEST_URI']);
//        dump($_COOKIE);
//        exit;
        $this->assign('meta_title',$this->meta_title);
        $this->display('index');
//        dump(cookie());
    }

    /**
     *
     * @param $id    //根据id
     * @param $status //修改status的状态,为-1时表示删除
     */
    public function changStatus($id, $status = -1)
    {
//        $this->model=D('Brand');
        if ($this->model->changStatus($id, $status) !== false) {
//                    dump(cookie('__NOWURL__'));
//        exit;
            //>>跳转到cookie保存的路径下
            $this->success('操作成功', U('index'));
        } else {
            $this->error('操作失败'.show_model_error($this->model));
        }
    }

    public function add()
    {
        if (IS_POST) {
//            $suppliermodel=D('Supplier');
            if ($this->model->create() !== false) {
                if ($this->model->add() !== false) {
                    $this->success('添加成功', cookie('__NOWURL__'));
                    return;  //成功就跳出
                }
            }
            $this->error('操作失败' . show_model_error($this->model));

        } else {
            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->_edit_view_before();  //调用子类方法,如果不需要准备数据就为空,需要准本数据就在子类中覆盖此方法
            $this->display('add');
        }
    }

    public function edit($id)
    {
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
            $this->_edit_view_before();  //调用子类方法,如果不需要准备数据就为空,需要准本数据就在子类中覆盖此方法
            $this->display('add');
        }
    }

    //用于被子类覆盖,为添加和编辑页面时准备数据
    protected function _edit_view_before(){

    }
}