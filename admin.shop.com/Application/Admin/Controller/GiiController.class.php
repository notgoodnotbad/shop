<?php
namespace Admin\Controller;


use Think\Controller;

class GiiController extends Controller
{
    public function index(){
        if(IS_POST){
            header('Content-Type: text/html;charset=utf-8');
            //得到数据表名,
            $table_name=I('post.name');
            //根据表名生成tp框架的规范
            $name=parse_name($table_name,1);
            //>>根据表名得到数据表的注解
            $sql="select TABLE_COMMENT from information_schema.`TABLES` where TABLE_SCHEMA='".C('DB_NAME')."'and TABLE_NAME='{$table_name}'";
            $model=M();
            $row=$model->query($sql);
            $meta_title=$row[0]['table_comment'];

            //>>查询表中所有字段信息,提供数据
            $sql="show full columns from ".$table_name;
            $filds=$model->query($sql);
//            dump($filds);
//            exit;
            foreach($filds as $k=>&$fild){
                if($fild['field']=='id'){
                    unset($filds[$k]);//删除id字段
                }
                $coment=$fild['comment'];
                if(strpos($coment,'@')!==false){
                    $pattern='/(.*)@([a-z]*)\|?(.*)/';   //正则表达式匹配注解
                    preg_match($pattern,$coment,$result);  //使用正则表达式匹配$comment字段
                    $fild['comment']=$result[1];    //得到第一个子表达式
                    $fild['fild_type']=$result[2];  //第二个子表达式
                    if(!empty($result[3])){    //判断第三个子表达式是否有值,有值就将字符串装换成变量
                        parse_str($result[3],$option_value);
                        $fild['fild_option']=$option_value;
                    }
                }
            }
//            dump($filds);
//            exit;
            unset($fild);//删除变量,以免影响后面的使用同样的变量出现错误

            //>>引入模板文件,定义模板目录
            defined('TPL_PATH') or define('TPL_PATH',ROOT_PATH.'Template/');
            require TPL_PATH.'Controller.tpl';


            //得到代码,并将将代码模板生成控制器,得到缓存代码
            $controller_content="<?php\r\n".ob_get_clean();
            //>>创建控制器文件
            $controller_path=APP_PATH.'Admin/Controller/'.$name.'Controller.class.php';
            //>>将代码保存到文件
            file_put_contents($controller_path,$controller_content);


            //>>生成模型
            ob_start(); //开启ob缓存
            require TPL_PATH.'Model.tpl';
            //>>保存缓存代码
            $model_content="<?php\r\n".ob_get_clean();
            //创建model文件
            $model_path=APP_PATH.'Admin/Model/'.$name.'Model.class.php';
            //将代码保存到文件
            file_put_contents($model_path,$model_content);


            //生成add模板
            ob_start();
            require TPL_PATH.'add.tpl';
            $add_content=ob_get_clean();
            $add_dir=APP_PATH.'Admin/View/'.$name;   //存放文件的文件夹
            if(!is_dir($add_dir)){   //如果不存在就创建
                mkdir($add_dir,0777,true);
            }
            $add_path=$add_dir.'/add.html';
//            dump($add_path);
//            exit;


            //生成index页面
            ob_start();
            require TPL_PATH.'/index.tpl'; //引入模板文件
            $index_content=ob_get_clean();
            $index_dir=APP_PATH.'/Admin/View/'.$name;   //生成文件存放目录
            if(!is_dir($index_dir)){
                mkdir($index_dir,0777,true);
            }
            $index_path=$add_dir.'/index.html';   //创建文件
            file_put_contents($index_path,$index_content);  //将模板代码放到文件中


            file_put_contents($add_path,$add_content);
            $this->success('生成成功',U('index'));
        }else{
            $this->assign('meta_title','代码生成器');
            $this->display('index');
        }
    }
}