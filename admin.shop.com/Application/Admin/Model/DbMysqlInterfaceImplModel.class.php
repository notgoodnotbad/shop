<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/15
 * Time: 0:33
 */
namespace Admin\Model;


class DbMysqlInterfaceImplModel implements DbMysqlInterfaceModel{
    /**
     * DB connect
     *
     * @access public
     *
     * @return resource connection link
     */
    public function connect()
    {
        // TODO: Implement connect() method.
    }

    /**
     * Disconnect from DB
     *
     * @access public
     *
     * @return viod
     */
    public function disconnect()
    {
        // TODO: Implement disconnect() method.
    }

    /**
     * Free result
     *
     * @access public
     * @param resource $result query resourse
     *
     * @return viod
     */
    public function free($result)
    {
        // TODO: Implement free() method.
    }

    /**
     * Execute simple query
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return resource|bool query result
     */
    public function query($sql, array $args = array())
    {
       $sql=$this->bulidSQL(func_get_args());
         return $result=M()->execute($sql);
        // TODO: Implement query() method.
    }

    /**
     * Insert query method
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return int|false last insert id
     */
    public function insert($sql, array $args = array())
    {
        $args=func_get_args();
        $sql=array_shift($args);//弹出sql
        $table_name=array_shift($args);//弹出表名
        $sql=str_replace('?T',$table_name,$sql);//替换表名
        $args=array_shift($args);//弹出字段值和字段名
        $values=''; //保存字段名和字段值
        foreach($args as $k=>$v){
            $values.="{$k}='{$v}',";
        }
        $values=rtrim($values,',');
//        dump($values);
        $sql=str_replace('?%',$values,$sql);//替换字段名和值
        //执行sql
        $model=M();
        $result=$model->execute($sql);
        if($result===false){
            return false;
        }else{
            return $model->getLastInsID();//得到最后的id
        }
        // TODO: Implement insert() method.
    }

    /**
     * Update query method
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return int|false affected rows
     */
    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
    }

    /**
     * Get all query result rows as associated array
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array (two level array)
     */
    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.
    }

    /**
     * Get all query result rows as associated array with first field as row key
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array (two level array)
     */
    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
    }

    /**
     * Get only first row from query
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array
     */
    public function getRow($sql, array $args = array())
    {
       $tempSQL=$this->bulidSQL(func_get_args());
        //执行sql语句
        $rows=M()->query($tempSQL);
        return empty($rows)?false:$rows[0];
//        empty($tempSQL)?false
        // TODO: Implement getRow() method.
    }

    /**
     * Get first column of query result
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array one level data array
     */
    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
    }

    /**
     * Get one first field value from query result
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return string field value
     */
    public function getOne($sql, array $args = array())
    {
        $tempSQL=$this->bulidSQL(func_get_args());
        $model=M();
        $rows=$model->query($tempSQL);//得到二维数组
        $row=$rows[0];//得到一维数组
        $values=array_values($row);
        return $values[0];
//        exit;
        // TODO: Implement getOne() method.
    }

    /*
     * 拼装sql语句
     * */
    public function bulidSQL($arguments){
        $sql=array_shift($arguments);//从数组中弹出第一个参数
//        dump($arguments);
        $sqls=preg_split('/\?[FNT]/',$sql);  //将sql语句分隔
        $tempSQL='';  //保存sql
        //拼装sql语句
        foreach($sqls as $k=>$v){
            $tempSQL.=$v.$arguments[$k];
        }
        return $tempSQL;
    }

}
