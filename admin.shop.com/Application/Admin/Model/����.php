<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/7
 * Time: 23:56
 */
namespace Admin\Model;


use Think\Model;
use Think\Page;

class BrandModel extends Model
{
    //>>验证数据规格
    //开启批处理
    protected $patchValidate = true;
    // 自动验证定义
    protected $_validate = array(
        array('name','require','姓名不能为空'),
        array('name','','姓名不能重复','','unique'),
        array('intro','require','简介不能为空')
    );

//    //伪删除数据,并为数据加上_del
//    public function remove($id)
//    {
//        return parent::save(array('id'=>$id,'status'=>-1));
//    }

    //首
    public function getList(){
        return $this->where(array('status'=>array('gt',-1)))->select();
    }

    //分页列表
    public function pageListHtml($wheres=array()){
        $wheres['status']=array('gt',-1);
        //生成分页html
        $pagesize=5;
        $totalpage=$this->where($wheres)->count();
        $page=new Page($totalpage,$pagesize);
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageHtml=$page->show();


        //生成分页列表数据
        if($page->firstRow>$totalpage){   //限定如果起始行数大于总行数,就留在最后一页
            $page->firstRow=$totalpage-$page->listRows;    //总页数-每页行数=最后一页,将最后一页的行数再赋值给即将访问页的第一行
        }
        $row=$this->where($wheres)->limit($page->firstRow,$page->listRows)->select();

        //将结果保存返回
        return array('pageHtml'=>$pageHtml,'rows'=>$row);
    }

    //修改status状态
    public function changStatus($id,$status=-1){
        dump(312);
        exit;
        $data=array('id'=>array('in',$id),'status'=>$status);
        if($status==-1){
            $data['name']=array('exp',"concat(name,'_del')");
        }
       return $this->save($data);
    }


}