<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>JiiHOME 管理中心 - 添加新商品 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/jiimadeeee/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/jiimadeeee/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/jiimadeeee/Public/Admin/Js/jquery-1.10.2.min.js"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo $btn_url; ?>"><?php echo $btn_name; ?></a>
    </span>
    <span class="action-span1"><a href="/jiimadeeee/index.php/Admin/index/index">JiiHOME 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo $title ?> </span>
    <div style="clear:both"></div>
</h1>


<style>
#pic_list li{float:left;list-style-type:none;margin:8px;}
#lun_pic_list li{float:left;list-style-type:none;margin:8px;}
#old_desc_list li{float:left;list-style-type:none;margin:20px;}
#old_img_list li{float:left;list-style-type:none;margin:20px;}
#cat_list li{
    list-style:none;
    display: inline-block;
    margin-right: 20px;
}
#attr_list{
    margin-top:20px ;
}
.attr{
    margin: 5px 0;
}
.attr li{
    list-style:none;
    display: inline-block;
    margin-right: 20px;
}
</style>
<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" >通用信息</span>
            <span class="tab-back" >商品属性</span>
            <span class="tab-back" >商品描述</span>
            <span class="tab-back" >商品轮播图</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/jiimadeeee/index.php/Admin/Goods/edit" method="post">
            <!--通用信息-->
            <table width="90%" class="general-table" align="center">
            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="<?php echo $data['goods_name'] ?>"size="30" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cat_id">
                        <option value="">请选择...</option>
                        <?php foreach($catData as $k => $v): if($v['id']==$data['cat_id']){ $select = 'selected="selected"'; }else{ $select = ""; } ?>
                        <?php echo '<option ' .$select.' value="'.$v['id'].'">'.str_repeat('-',4*$v['level']).$v['name'].'</option>'; ?>
                        <?php endforeach; ?>
                        </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">扩展分类：</td>
                    <td id="cat_list">
                        <li>
                        <a href="javascript:void(0)" onclick="addCat(this)">[+]</a>
                        <select name="ext_cat_id[]">
                        <option value="">请选择...</option>
                        <?php foreach($catData as $k => $v): ?>
                        <?php echo '<option value="'.$v['id'].'">'.str_repeat('-',4*$v['level']).$v['name'].'</option>'; ?>
                        <?php endforeach; ?>
                        </select>
                        </li>
                        <?php foreach($gcData as $k1 => $v1): ?>
                        <li>
                        <a href="javascript:void(0)" onclick="addCat(this)">[-]</a>
                        <select name="ext_cat_id[]">
                        <?php foreach($catData as $k => $v): if($v['id']==$v1['cat_id']){ $select = 'selected="selected"'; }else{ $select = ''; } ?>
                        <?php echo '<option '.$select.' value="'.$v['id'].'">'.str_repeat('-',4*$v['level']).$v['name'].'</option>'; ?>
                        <?php endforeach; ?>
                        </select>
                        </li>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_on_sale" value="1" <?php if($data['is_on_sale']=='1') echo 'checked="checked"'; ?>/> 是
                        <input type="radio" name="is_on_sale" value="0" <?php if($data['is_on_sale']=='0') echo 'checked="checked"'; ?>/> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">是否报价系统中商品：</td>
                    <td>
                        <input type="radio" name="is_quote" value="1" <?php if($data['is_quote']=='1') echo 'checked="checked"'; ?> /> 是
                        <input type="radio" name="is_quote" value="0" <?php if($data['is_quote']=='0') echo 'checked="checked"'; ?>/> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">加入推荐：</td>
                    <td>
                        <input type="checkbox" name="is_new" value="1" <?php if($data['is_new']=='1') echo 'checked="checked"'; ?>/> 新品
                        <input type="checkbox" name="is_hot" value="1" <?php if($data['is_hot']=='1') echo 'checked="checked"'; ?>/> 热销
                    </td>
                </tr>
                <tr>
                    <td class="label">商品标签：</td>
                    <td>
                        <input type="text" name="tag" value="<?php echo $data['tag'] ?>"  /> (多种标签属性用逗号‘,’隔开，建议不超过两个)
                    </td>
                </tr>
                <tr>
                    <td class="label">推荐排序：</td>
                    <td>
                        <input type="text" name="sort_id" size="5" value="<?php echo $data['sort_id'] ?>"/>
                    </td>
                </tr>
        </table>

        <!--商品属性-->
        <table width="90%" style="display:none" class="general-table" align="center">
            <tr>
                <td class="label">商品类型：</td>
                <td>
                    <?php buildSelect('type','type_id','id','type_name',$data['type_id']) ?>
                    <div id='attr_list'>
                        <?php
 foreach($attData as $k => $v){ if($v[0]['attr_type'] == 2): ?>
                        <div class="attr">
                           <?php $attrId = array(); foreach($v as $k1 => $v1): if(in_array($v['attr_id'],$attrId)){ $pot = '-'; }else{ $pot = '+'; $attrId[] = $v['attr_id']; } ?>
                            <li>
                                <a  onclick="addNewAttr(this)" href="javascript:void(0)">[<?php echo $pot; ?>]</a>
                                <input type="hidden" name="goods_attr_id[]" value="<?php echo $v1['id'] ?>">
                                <?php echo $v1['attr_name']; $attr = explode(',',$v1['attr_option_values']); ?>
                                <select name="attr_value[<?php echo $v1['attr_id'] ?>][]">
                                    <option value="">请选择...</option>
                                    <?php foreach($attr as $k2 => $v2 ): if($v2 == $v1['attr_value']){ $select = 'selected="selected"'; }else{ $select = ''; } ?>
                                    <option <?php echo $select?> value="<?php echo $v2?>"><?php echo $v2?></option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                           <?php endforeach; ?>
                        </div>
                        <?php endif; } ?>

                        <?php
 foreach($attData as $k => $v){ if($v[0]['attr_type'] == 3): ?>
                        <div class="attr">
                            <?php $attrId = array(); foreach($v as $k1 => $v1): if(in_array($v['attr_id'],$attrId)){ $pot = '-'; }else{ $pot = '+'; $attrId[] = $v['attr_id']; } ?>
                            <li>
                                <a  onclick="addNewAttr(this)" href="javascript:void(0)">[<?php echo $pot; ?>]</a>
                                <input type="hidden" name="goods_attr_id[]" value="<?php echo $v1['id'] ?>">
                                <?php echo $v1['attr_name']; ?>
                                <select name="attr_value[<?php echo $v1['attr_id'] ?>][]">
                                    <option value="">请选择...</option>
                                    <?php foreach($v1['attr_option_values'] as $k2 => $v2 ): if($k2 == $v1['attr_value']){ $select = 'selected="selected"'; }else{ $select = ''; } ?>
                                    <option <?php echo $select?> value="<?php echo $k2?>"><?php echo $v2?></option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; } ?>

                        <?php
 foreach($attData as $k => $v){ if($v[0]['attr_type'] == 1): ?>
                        <div class="attr">
                            <li>
                                <input type="hidden" name="goods_attr_id[]" value="<?php echo $v[0]['id'] ?>">
                                <?php echo $v[0]['attr_name']; ?>
                                <input type="text" name="attr_value[<?php echo $v[0]['attr_id'] ?>][]" value="<?php echo $v[0]['attr_value'] ?>">
                            </li>
                        </div>
                        <?php endif; } ?>
                    </div>
                </td>
            </tr>

          </table>
            <!--商品描述-->
            <table width="90%" style="display:none" class="general-table" align="center">
                <tr>
                    <td>
                        <ul id="pic_list">
                            <li>
                                <input type="file" name="pic[]" accept="image/*" multiple>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul id="old_desc_list">
                            <?php foreach($descData as $k => $v): ?>
                            <li>
                                <div style="width: 150px;height: 180px;">
                                  <div style="width: 150px;height: 150px;" onmouseover="showDel(this)" onmouseout="hideDel(this)">
                                      <div style="z-index: 999;width: 150px;height: 30px;background: yellowgreen;position: absolute;opacity:0.8;display: none;">
                                        <input type="button" class="desc_del" desc_id="<?php echo $v['id']; ?>" style="width: 150px;height: 30px;opacity:1;" value="删除"></br>
                                      </div>
                                      <img src="<?php echo $v['img_src'] ?>" style="width: 150px;height: 150px;">
                                  </div>
                                  <div style="width: 150px;height: 30px;background: yellowgreen;">
                                      <span style="font-size: 14px;line-height: 30px;padding-left:20px;width:30px;">排序：</span>
                                      <span style="width:80px;height: 20px;margin-left: 10px; "><input onblur="changeSort(this)" type="text" desc_id="<?php echo $v['id']; ?>" value="<?php echo $v['sort_id']; ?>" style="width: 40px;height: 16px;"></span>
                                  </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
            </table>
            <!--商品轮播图-->
            <table width="90%" style="display:none" class="general-table" align="center">
                <tr>
                    <td>
                        <ul id="lun_pic_list">
                            <li>
                                <input type="file" name="lun_pic[]" accept="image/*" multiple>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul id="old_img_list">
                            <?php foreach($imgData as $k => $v): ?>
                            <li>
                                <div style="width: 150px;height: 180px;">
                                    <div style="width: 150px;height: 150px;" onmouseover="showDelImg(this)" onmouseout="hideDelImg(this)">
                                        <div style="z-index: 999;width: 150px;height: 30px;background: yellowgreen;position: absolute;opacity:0.8;display: none;">
                                            <input type="button" class="img_del" desc_id="<?php echo $v['id']; ?>" style="width: 150px;height: 30px;opacity:1;" value="删除"></br>
                                        </div>
                                        <img src="<?php echo $v['img_src'] ?>" style="width: 150px;height: 150px;">
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
            </table>
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>
<script>
$('#tabbar-div p span').click(function(){
	//获取点击的哪个
	var i = $(this).index();
	//隐藏所有table
	$('.general-table').hide();
	//显示点击的
	$('.general-table').eq(i).show();
	//改变所有
	$('.tab-front').removeClass('tab-front').addClass('tab-back');
	$(this).removeClass('tab-back').addClass('tab-front');
});
</script>
<script>

$('.desc_del').click(function() {
    //选择删除按钮所在LI标签
    var li = $(this).parent().parent().parent().parent();
    //获取desc_id属性
    var did = $(this).attr("desc_id");

    $.ajax({
        type: "GET",
        url: "<?php echo U('ajaxDelDesc','',FALSE);?>/descid/" + did,
        success: function (data) {
            //把图片从页面删除
            li.remove();
        }
    });
})
$('.img_del').click(function() {
    //选择删除按钮所在LI标签
    var li = $(this).parent().parent().parent().parent();
    //获取desc_id属性
    var did = $(this).attr("desc_id");

    $.ajax({
        type: "GET",
        url: "<?php echo U('ajaxDelImg','',FALSE);?>/descid/" + did,
        success: function (data) {
            //把图片从页面删除
            li.remove();
        }
    });
})
    function showDel(mon) {
        $(mon).find('div').css('display','inline');
    }
    function hideDel(mot) {
        $(mot).find('div').css('display','none');
    }
    function showDelImg(mon) {
        $(mon).find('div').css('display','inline');
    }
    function hideDelImg(mot) {
        $(mot).find('div').css('display','none');
    }
    function changeSort(mot) {
        var did = $(mot).attr("desc_id");
        var val = $(mot).val();
        $.ajax({
            type: "GET",
            url: "<?php echo U('ajaxChangeSort','',FALSE);?>",
            data:{did:did,sort:val},
        success: function (e) {
            if(e){
                alert('修改排序成功！');
            }else{
                alert('修改排序失败！');
            }
        }
    });
    }
</script>
<script>
    function addCat(a) {
        let li = $(a).parent();
        if($(a).text() == '[+]'){
            var newLi = li.clone();
            newLi.find('a').text('[-]');
            newLi.find('select').val('');
            $('#cat_list').append(newLi);
        }else{
            li.remove();
        }
    }
</script>
<!--根据商品类型获取商品属性-->
<script>
$("select[name=type_id]").change(function(){
	var typeId = $(this).val();
	var self = <?php echo $data['type_id']; ?>;
    var attr = '';
	//如果选择了类型就执行AJAX
	if(typeId > 0){
        if(typeId == self){
            var data = <?php echo json_encode($attData); ?>;
            var li = '';
            for(i in data){
                if(data[i][0]['attr_type'] == '2'){
                    li += '<div class="attr">';
                    $(data[i]).each(function (k,v) {
                        li += '<li>';
                        if(k == '0'){
                            li += '<a  onclick="addNewAttr(this)" href="javascript:void(0)">[+]</a>';
                        }else{
                            li += '<a  onclick="addNewAttr(this)" href="javascript:void(0)">[-]</a>';
                        }
                        li += v.attr_name+':';
                        li += '<input type="hidden" name="goods_attr_id[]" value="'+v.id+'">';
                        li += '<select name="attr_value['+v.id+'][]"><option value="" >请选择...</option>';
                        //把可选值转换为数组
                        var _attr = v.attr_option_values.split(',');
                        //循环每个值制作option
                        for(var i=0;i<_attr.length;i++){
                            if(_attr[i] == v.attr_value){
                                li += '<option value="'+_attr[i]+'" selected="selected">'+_attr[i]+'</option>';
                            }else{
                                li += '<option value="'+_attr[i]+'">'+_attr[i]+'</option>';
                            }
                        }
                        li += '</select>';
                        li += '</li>';
                    });
                    li += '</div>';
                }
            }

            for(i in data){
                if(data[i][0]['attr_type'] == '3'){
                    li += '<div class="attr">';
                    $(data[i]).each(function (k,v) {
                        li += '<li>';
                        if(k == '0'){
                            li += '<a  onclick="addNewAttr(this)" href="javascript:void(0)">[+]</a>';
                        }else{
                            li += '<a  onclick="addNewAttr(this)" href="javascript:void(0)">[-]</a>';
                        }
                        li += v.attr_name+':';
                        li += '<input type="hidden" name="goods_attr_id[]" value="'+v.id+'">';
                        li += '<select name="attr_value['+v.id+'][]"><option value="" >请选择...</option>';
                        for(p in v.attr_option_values){
                            if(p == v.attr_value){
                                li += '<option value="'+p+'" selected="selected">'+v.attr_option_values[p]+'</option>';
                            }else{
                                li += '<option value="'+p+'">'+v.attr_option_values[p]+'</option>';
                            }
                        }
                        li += '</select>';
                        li += '</li>';
                    });
                    li += '</div>';
                }
            }

            for(i in data){
                if(data[i][0]['attr_type'] == '1'){
                    li += '<div class="attr">';
                    $(data[i]).each(function (k,v) {
                        li += '<li>';
                        li += '<input type="hidden" name="goods_attr_id[]" value="'+v.id+'">';
                        li += v.attr_name+':';
                        if(v.attr_value == null){
                            li += '<input type="hidden" name="goods_attr_id[]" value="">';
                            li += '<input type="text" name="attr_value['+v.attr_id+'][]" value="" />';
                        }else {
                            li += '<input type="hidden" name="goods_attr_id[]" value="'+v.id+'">';
                            li += '<input type="text" name="attr_value['+v.attr_id+'][]" value="'+v.attr_value+'" />';
                        }
                        li += '</li>';
                    });
                    li += '</div>';
                }
            }
            //把拼好的LI放到页面中
            $('#attr_list').html(li);
        }else{
            $.ajax({
                type: "GET",
                url: "<?php echo U('ajaxGetAttr','',FALSE); ?>/type_id/" + typeId,
                dataType: "json",
                success: function (data) {
                    /*******把服务器返还的属性循环拼成LI字符串********/
                    let li = '';
                    $(data).each(function (k, v) {
                        if (v.attr_type == '2') {
                            li += '<div class="attr"><li>';
                            li += '<a  onclick="addNewAttr(this)" href="javascript:void(0)">[+]</a>';
                            li += v.attr_name + ':';
                            li += '<select name="attr_value[' + v.id + '][]"><option value="" >请选择...</option>';
                            //把可选值转换为数组
                            var _attr = v.attr_option_values.split(',');
                            //循环每个值制作option
                            for (var i = 0; i < _attr.length; i++) {
                                li += '<option value="' + _attr[i] + '">' + _attr[i] + '</option>';
                            }
                            li += '</select>';
                            li += '</li></div>';
                        }
                    });
                    $(data).each(function (k, v) {
                        if (v.attr_type == '3') {
                            $.ajax({
                                type: "GET",
                                url: "<?php echo U('ajaxGetcolor','',FALSE); ?>",
                                data: {colorId: v.attr_option_values},
                                async: false,
                                dataType: "json",
                                success: function (dat) {
                                    li += '<div class="attr"><li>';
                                    li += '<a  onclick="addNewAttr(this)" href="#">[+]</a>';
                                    li += v.attr_name + ':';
                                    li += '<select name="attr_value[' + v.id + '][]"><option value="" >请选择...</option>';
                                    //把可选值转换为数组
                                    var _attr = v.attr_option_values.split(',');
                                    for (var i = 0; i < dat.length; i++) {
                                        li += '<option value="' + _attr[i] + '">' + dat[i] + '</option>';
                                    }
                                    li += '</select>';
                                    li += '</li></div>';
                                }
                            });
                        }
                    });
                    $(data).each(function (k, v) {
                        if (v.attr_type == '1') {
                            li += '<div class="attr"><li>';
                            li += '<a  onclick="addNewAttr(this)" href="#">[+]</a>';
                            li += v.attr_name + ':';
                            li += '<input type="text" name="attr_value[' + v.id + '][]" />';
                            li += '</li></div>';
                        }
                    });
                    //把拼好的LI放到页面中
                    $('#attr_list').html(li);
                }
            });
        }
	}else{
		$('#attr_list').html('');
	}
});
//点击属性的【+】号
function addNewAttr(a){
	var li = $(a).parent();
	if($(a).text() == '[+]'){
		var newLi = li.clone();
		newLi.find("option:selected").removeAttr('selected');
		newLi.find("input[name='goods_attr_id[]']").val('');
		newLi.find('a').text('[-]');
		li.parent().append(newLi);
	}else{
		//获取该属性ID
		var gaid = li.find("input[name='goods_attr_id[]']").val();
		if(gaid == ''){
		  li.remove();
		}else{
			if(confirm('如果删除这个属性，那么相关库存量也会删除，确定删除吗？')){
				$.ajax({
					type : "GET",
					url : "<?php echo U('ajaxDelAttr?goods_id='.$data['id'],'',FALSE) ?>/gaid/"+gaid,
					success : function(data){
						li.remove();
					}
				});
			}
		}
	}
}
</script>

<div id="footer">
版权所有 &copy; 2018 宁波几和网络科技有限公司，并保留所有权利。</div>
</body>
</html>