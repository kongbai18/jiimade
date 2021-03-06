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
    #edit-price{
        position: fixed;
        width: 20%;
        height: 200px;
        left: 35%;
        top:150px;
        border: 1px solid black;
        background: white;
        display: none;
    }
    #close{
        height: 20px;
        text-align: right;
        padding: 10px;
    }
    .deli{
        text-align: center;
        margin-top: 40px;
    }

</style>
<div id="edit-price" >
    <div id="close"><input type="button" value="关闭" onclick="closeList()"></div>
    <div class="list-div" id="order-goods">
    </div>
    <div class="deli">
        修改交易价格：<input type="text" name="price" style="margin-right: 50px;">
    </div>
    <div class="deli">
    <input type="button" value="确认修改" onclick="comEdit()">
    </div>
</div>
<div class="form-div">
    <form action="" name="searchForm">
        <img src="/jiimadeeee/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search" />

        <!-- 关键字 -->
        订单号 <input type="text" name="orderId" size="15" value="<?php echo I('get.orderId') ?>" />
        <input type="submit" id="search" value="搜索" class="button" />
    </form>
</div>

<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>订单号</th>
                <th>下单时间</th>
                <th>总价格</th>
                <th>积分抵扣</th>
                <th>修改扣除</th>
                <th>交易价格</th>
                <th>修改价格</th>
            </tr>
            <?php foreach($data['data'] as $k => $v): ?>
            <tr class="tron">
                <td align="center"><?php echo $v['order_id'] ?></td>
                <td align="center"><?php echo date('Y-m-d H:i:s',$v['add_time']) ?></td>
                <td align="center"><?php echo $v['price'] ?></td>
                <td align="center"><?php echo $v['deduction'] ?></td>
                <td align="center"><?php echo $v['modify_price'] ?></td>
                <td align="center"><?php echo $v['last_price'] ?></td>
                <td align="center"><a href="javascript:void(0)" onclick="editPrice(&apos;<?php echo $v['order_id'] ?>&apos;)">修改价格</a></td>
            </tr>
            <?php endforeach; ?>
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo $data['page'] ?>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>
</form>
 <!--引入高亮显示-->
<script type="text/javascript" src="/jiimadeeee/Public/Admin/Js/tron.js"></script>
<script>
    function editPrice(id){
        var li = "<input type='hidden' name='order_id' value='"+id+"'>";
        $('#order-goods').html(li);
        $('#edit-price').css('display','inline');
    }
    function closeList() {
        $('#edit-price').css('display','none');
    }
    function comEdit() {
        var orderId = $("input[ name='order_id']").val();
        var price = $("input[ name='price']").val();
        var re = /^[0-9]+.?[0-9]*/;
        if(re.test(price)){
            if(price > 0){
                $.ajax({
                    type: 'post',
                    url: "<?php echo U('Order/editPrice') ?>",
                    dataType: 'json',
                    data: {orderId:orderId,price:price},
                    success: function(data) {
                        $('#edit-price').css('display','none');
                        if(data){
                            $("#search").trigger("click");
                        }else{
                            alert('修改失败！');
                        }
                    }
                });
            }else{
                alert('交易价必须大于0');
            }
        }else{
            alert('交易价必须为数字类型！');
        }
    }
</script>


<div id="footer">
版权所有 &copy; 2018 宁波几和网络科技有限公司，并保留所有权利。</div>
</body>
</html>