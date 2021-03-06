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
    #pic_list li{float:left;list-style-type:none;}
    #old_desc_list li{float:left;list-style-type:none;margin:20px;}
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
    #cat_list li{
        list-style:none;
        display: inline-block;
        margin-right: 20px;
    }
    #goods-list{
        padding-top: 30px;
    }
    #goods-list li{
        list-style:none;
        display: inline-block;
        margin-right: 20px;
    }
</style>
<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" >基本信息</span>
            <span class="tab-back" >文章内容</span>
            <span class="tab-back" >推荐物品</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/jiimadeeee/index.php/Admin/Article/edit/id/1.html" method="post">
            <!--通用信息-->
            <table width="90%" class="general-table" align="center">
                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <tr>
                    <td class="label">文章标题：</td>
                    <td><input type="text" name="article_name" value="<?php echo $data['article_name'] ?>" size="30" />
                        <span class="require-field">*</span></td>
                </tr>

                <tr>
                    <td class="label">是否显示：</td>
                    <td>
                        <input type="radio" name="is_index" value="1" <?php if($data['is_index']=='1') echo 'checked="checked"'; ?>/> 是
                        <input type="radio" name="is_index" value="0" <?php if($data['is_index']=='0') echo 'checked="checked"'; ?>/> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cate_id">
                            <?php foreach($catData as $k => $v): if($v['id']==$data['cate_id']){ $select = 'selected="selected"'; }else{ $select = ""; } ?>
                            <?php echo '<option ' .$select.' value="'.$v['id'].'">'.str_repeat('-',4*$v['level']).$v['name'].'</option>'; ?>
                            <?php endforeach; ?>
                        </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">推荐排序：</td>
                    <td>
                        <input type="text" name="sort_id" size="5" value="<?php echo $data['sort_id'] ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">封面图：</td>
                    <td>
                        <input type="file" name="pic" accept="image/*" ><span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">文章简介：</td>
                    <td>
                        <textarea name="article_brief" id="" cols="40" rows="5"><?php echo $data['article_brief'] ?></textarea>
                    </td>
                </tr>
            </table>
            <!--文章详情-->
            <table width="90%" style="display:none" class="general-table" align="center">
                <tr>
                    <td>
                        <ul id="pic_list">
                            <li>
                                <input type="file" name="desc_pic[]" accept="image/*" multiple>
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
            <!--推荐商品-->
            <table width="90%" style="display:none" class="general-table" align="center">
                <tr>
                    <td>
                        <input type="text" placeholder="根据商品名称搜索">
                        <input type="button" value="搜索" onclick="searchGoods(this)">
                    </td>
                </tr>
                <tr>
                    <td id="goods-list">
                        <?php foreach($goodsData as $k => $v): ?>
                        <li>
                            <a  onclick="delGoods(this)" href="#">[-]</a>
                            <select name="goods[]"><option value="<?php echo $v['id'] ?>" ><?php echo $v['goods_name'] ?></option></select>
                        </li>
                        <?php endforeach; ?>
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

    function searchGoods(a) {
        let key = $(a).prev().val();
        if(key != ''){
            $.ajax({
                type: "GET",
                url: "<?php echo U('ajaxGetgoods','',FALSE); ?>/keyword/" + key,
                dataType: "json",
                success: function (data) {
                    if(data.length == 0){
                        alert('搜索无此商品！');
                    }else{
                        var li = '<li>';
                        li += '<a  onclick="delGoods(this)" href="#">[-]</a>';
                        li += '<select name="goods[]"><option value="" >请选择搜索商品</option>';
                        $(data).each(function (k,v) {
                            li += '<option value="'+v.id+'" >'+v.goods_name+'</option>'
                        });
                        li += '</select></li>';
                        $('#goods-list').append(li);
                    }
                }
            });
        }
    }

    function delGoods(a) {
        if(confirm('确定要删除嘛？')){
            let li = $(a).parent();
            li.remove();
        }
    }

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
    function showDel(mon) {
        $(mon).find('div').css('display','inline');
    }
    function hideDel(mot) {
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


<div id="footer">
版权所有 &copy; 2018 宁波几和网络科技有限公司，并保留所有权利。</div>
</body>
</html>