<?php
namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;
use Think\Page;

class GoodsCategoryModel extends BaseModel
{
    //>>验证数据规格
    //开启批处理
    // 自动验证定义
protected $_validate = array(
  array('name','require','分类名称不能为空'),
array('status','require','是否显示不能为空'),
);

public function getTreeList($isJSON=false,$field='*'){
  $rows=$this->field($field)->where(array('status'=>array('egt',0)))->order('lft')->select();
  if($isJSON){
    return json_encode($rows);
  }else{
    return $rows;
     }
  }

  public function add(){
    //1.计算边界
    //>>1.1生成执行sql的对象
    $dbMysql=new DbMysqlInterfaceImplModel();
    $nestedSets=new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');//创建一个计算边界的对象,这个对象通过传进来的数据生成sql,交给$dbmysql执行
    //>>将信息添加到某个父节点下,并且返回该节点的id
    return $nestedSets->insert($this->data['parent_id'],$this->data,'bottom');
    //>>2.存入数据库
  }

  public function save(){
    //1.计算边界
    //>>1.1生成执行sql的对象
    $dbMysql=new DbMysqlInterfaceImplModel();
    $nestedSets=new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');
    //将一个节点移动到另一个节点
    $nestedSets->moveUnder($this->data['id'],$this->data['parent_id']);
    //更新数据到数据库
    return parent::save();
  }

  /*
   * 修改父分类的状态时,同时修改子分类的状态
   *
   */
  public function changStatus($id, $status = -1)
  {
    //>>1.改变父分类的状态时,同时改变子孙分类
    $sql="select child.id from goods_category as child,goods_category as parent where parent.id={$id} and child.lft>=parent.lft and child.rgt<=parent.rgt";
    $rows=$this->query($sql);//得到当前分类下的所有子孙分类
//    //取出所有id保存到数组中
//    $id=array();
//    foreach($rows as $row){
//      $id[]=$row['id'];
//    }
    //使用系统函数获得一个二位数组中的一个字段值,但函数支持php5.5(自定义)
    $id=array_column($rows,'id');
    $data = array('id' => array('in',$id), 'status' => $status);
    if ($status == -1) {
      $data['name'] = array('exp', "concat(name,'_del')");
    }
    return parent::save($data);
  }
}