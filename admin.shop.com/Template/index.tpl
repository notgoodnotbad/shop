<extend name="Common/index"/>
<block name="table">
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th>ID <input type="checkbox" class="selectAll"/> </th>
            <?php foreach($filds as $fild){ ?>
            <th><?php echo $fild['comment']?></th>
            <?php }?>
            <th>操作</th>
        </tr>
        <volist name="rows" id="row">
            <tr>
                <td width="30">{$row.id}<input type="checkbox" name="id[]" class="ids" value="{$row.id}"/></td>
                <?php foreach($filds as $fild){
                if($fild['field']=='name'){
                echo '<td class="first-cell">{$row.name}</td>';
                }elseif($fild['field']=='status'){
                echo "<td align=\"center\"><a class=\"ajax-get\" href=\"{:U('changStatus',array('id'=>\$row['id'],'status'=>(1-\$row['status'])))}\"><img src=\"__IMG__/{\$row.status}.gif\"/></a></td>";
                }else{
                echo  "<td class=\"first-cell\">{\$row.{$fild['field']}}</td>";
                }
                }
                ?>

                <td align="center">
                    <a href="{:U('edit',array('id'=>$row['id']))}" title="编辑">编辑</a> |
                    <a  class="ajax-get" href="{:U('changStatus',array('id'=>$row['id']))}" title="移除">移除</a>
                </td>
            </tr>
        </volist>

    </table>
    <div id="turn-page" class="page">
        {$pageHtml}
    </div>
</block>