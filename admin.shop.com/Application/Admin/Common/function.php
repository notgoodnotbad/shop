<?php
header('Content-Type: text/html;charset=utf-8');
function show_model_error($model)
{
    //>>得到模型中的错误信息
    $errors = $model->getError();
    //>>将错误信息拼接到ul中
    $errorMsg = '<ul>';
    //判断是不是数组
    if (is_array($errors)) {
        foreach ($errors as $error) {
            $errorMsg .= "<li>{$error}</li>";
        }
    } else {
        $errorMsg .= "<li>{$errors}</li>";
    }
    $errorMsg .= '</ul>';
    return $errorMsg;
}

//返回数组中的一个字段值
if (!function_exists('array_column')) {
    function array_column($rows, $field)
    {
        $values = array();
        foreach ($rows as $row) {
            $values[] = $row[$field];
        }
        return $values;
    }


    //>>根据传进来的参数生成下拉html
    function arr2select($name,$rows,$valueid='id',$valuename='name'){
//        echo 'sdsd';
        $selecthtml="<select class='{$name}' name='{$name}'><option>--请选择--</option>";
        foreach($rows as $row){
            $selecthtml.="<option value='{$row[$valueid]}'>{$row[$valuename]}</option>";
        }
        $selecthtml.="</select>";
        return $selecthtml;
    }
}