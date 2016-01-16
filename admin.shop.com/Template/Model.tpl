namespace Admin\Model;


use Think\Model;
use Think\Page;

class <?php echo $name?>Model extends BaseModel
{
    //>>验证数据规格
    //开启批处理
    // 自动验证定义
protected $_validate = array(
  <?php foreach($filds as $fild){
        if($fild['field']=='id' || $fild['null']=='YES'){
             continue;
        }
        echo "array('{$fild['field']}','require','{$fild['comment']}不能为空'),\r\n";
        }
        ?>
);
}