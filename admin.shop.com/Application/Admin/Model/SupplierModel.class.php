<?php
namespace Admin\Model;


use Think\Model;
use Think\Page;

class SupplierModel extends BaseModel
{
    //>>验证数据规格
    //开启批处理
    // 自动验证定义
protected $_validate = array(
  array('name','require','供应商名称不能为空'),
array('sort','require','排序不能为空'),
array('status','require','状态不能为空'),
);
}