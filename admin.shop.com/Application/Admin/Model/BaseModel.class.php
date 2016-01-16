<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/11
 * Time: 16:36
 */
namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model
{

    protected $patchValidate = true;

    //查询表中数据
    public function getList($field='*')
    {
        return $this->field($field)->where(array('status' => array('gt', -1)))->select();
    }

    public function pageListHtml($wheres = array())
    {
        $wheres['status'] = array('gt', -1);
        //生成分页html
        $pagesize = 2;
        $totalpage = $this->where($wheres)->count();
        $page = new Page($totalpage, $pagesize);
        $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageHtml = $page->show();
        //生成分页列表数据
        if ($page->firstRow >=$totalpage) {   //限定如果起始行数大于总行数,就留在最后一页

            $page->firstRow = $totalpage - $page->listRows;    //总页数-每页行数=最后一页,将最后一页的行数再赋值给即将访问页的第一行
        }
        if($page->firstRow<0){
            $page->firstRow=0;   //判定当删除第一条时,页面跳转到首页
        }
//        dump($totalpage);
//        exit;
        $row = $this->where($wheres)->limit($page->firstRow, $page->listRows)->select();

        //将结果保存返回
        return array('pageHtml' => $pageHtml, 'rows' => $row);
    }

    public function changStatus($id, $status = -1)
    {
//        var_dump($id);
//        exit;

        $data = array('id' => array('in',$id), 'status' => $status);
//        dump($data);
//        exit;
        if ($status == -1) {
            $data['name'] = array('exp', "concat(name,'_del')");
        }
        return parent::save($data);
    }
}