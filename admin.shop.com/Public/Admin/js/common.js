//页面加载完毕
$(function(){
    //添加全选状态
   $('.selectAll').click(function(){
       //全选时,所有复选框也选中,根据全选框的值为复选框赋值
       $('.ids').prop('checked',$(this).prop('checked'));
   })

    //当选中所有的复选框时,全选框选中
    $('.ids').click(function(){
        //根据没有选中的复选框的长度为0(表示全选中)
        $('.selectAll').prop('checked',$('.ids:not(:checked)').length==0)
    })

    $('.ajax-get').click(function(){
        //发送ajax请求
        var url=$(this).attr('href')
        $.get(url,showAjax)
        //取消默认操作
        return false;
    });

    $('.ajax-post').click(function(){
        var form=$(this).closest('form')   //找到表单对象
        if(form.length!=0){   //判断是否是表单提交
            var url=form.attr('action');  //请求的url地址
            var parmer=form.serialize();//参数序列化
            //form.ajaxSubmit({success:showAjax})  //使用jquery.form插件实现数据的提交
            $.post(url,parmer,showAjax)//发送请求
        }else{
            var url=$(this).attr('url');  //删除的处理方法
            var parmer=$('.ids:checked').serialize()  //选中的id全部传递序列化
            //console.debug(parmer);
            //console.debug(url);
            //return;
            $.post(url,parmer,showAjax);
        }

        return false;
    })


    function showAjax(data){
        console.debug(data);
        var icon;
        if(data.status){
            icon=1; //成功符号
        }else{
            icon=2;//失败符号
        }
        layer.msg(data.info,{
            time:1000,//等待1秒后关闭
            offset:1, //位置
            icon:icon   //设置图标中的符号
            //提示框隐藏后执行的函数
        },function(){
            if(data.url){
                console.debug('哈哈哈');
                location.href=data.url  //跳转到url
            }
        });
    }


})
