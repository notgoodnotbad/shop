<?php
namespace Admin\Model;


use Think\Model;
use Think\Page;

class BrandModel extends BaseModel
{
    //>>验证数据规格
    //开启批处理
    // 自动验证定义
protected $_validate = array(
  array('name','require','品牌名称不能为空'),
array('url','require','品牌网址不能为空'),
array('logo','require','品牌LOGO不能为空'),
array('sort','require','排序不能为空'),
array('status','require','是否显示不能为空'),
);
}