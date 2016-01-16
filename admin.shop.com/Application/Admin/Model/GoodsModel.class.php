<?php
namespace Admin\Model;


use Think\Model;
use Think\Page;

class GoodsModel extends BaseModel
{
    //>>验证数据规格
    //开启批处理
    // 自动验证定义
protected $_validate = array(
  array('name','require','商品名称不能为空'),
array('short_name','require','简称不能为空'),
array('sn','require','货号不能为空'),
array('goods_category_id','require','商品分类不能为空'),
array('brand_id','require','商品品牌不能为空'),
array('supplier_id','require','供货商不能为空'),
array('shop_price','require','本店价格不能为空'),
array('market_price','require','市场价格不能为空'),
array('logo','require','商品LOGO不能为空'),
array('stock','require','库存不能为空'),
array('goods_status','require','商品状态不能为空'),
array('status','require','是否显示不能为空'),
);
}