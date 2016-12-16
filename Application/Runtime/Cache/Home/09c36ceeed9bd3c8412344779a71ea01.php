<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>voting</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="/favicon.ico" rel="Shortcut Icon"/>
<link href="/favicon.ico" rel="Bookmark"/>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="<?php echo (ADMIN_CSS_URL); ?>style.css" type="text/css">
<script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>jquery.more.js"></script>
<script type="text/javascript">
	$(function(){
		if ($.cookie("current")!= null){
	    	var num = $.cookie("current");
	    	$('.sort-title').find('li').eq(num).addClass('active');
    	}
		$('.sort-title').find('li').click(function(){
			var index = $('.sort-title').find('li').index(this);
			$.cookie("current", index);
			$(this).addClass('active');
			$('.active').removeClass('active');
		});
	});

		var isloader = false;
    	var pageindex=1;
   		var pagesize=10;
		function loadmore(btn){
			if(isloader){
				return;
			}
			isloader = true;
			var action=$('#action').val();
	        pageindex++;
	        var loader = "<img src='/public/images/loader.gif' alt=''/>";
	        $(btn).html(loader);
	        $.ajax({
	            type: "post",
	            url: "index",
	            data: {action:action, pageindex:pageindex, pagesize:pagesize},
	           	dataType: "json",
	            success: function(data){
	            	isloader=false;
	        		$(btn).html("加载更多");
	                if(data==0){
	                	isloader=true;
	                    $(btn).html("没有更多了");
	                }
	                insertHtml(data);
	            },
	            error:function(data,err){
	                isloader=false;
	                alert('数据有误了！');
	                $(btn).html("加载中...");
	            }
	        });
		}

		function insertHtml(arr){
			var parentdiv = $('.sort-list>ul');
	        for(var i=0;i<arr.length;i++){
	        	var openDiv = $('<li></li>').appendTo($('#add'));
	        	//var openDiv = document.createElement("li");
	            strHtml="<div class=\"sort-num\">当前票数："+arr[i]['vote_count']+"</div><div class=\"sort-main clearfix\"><div class=\"left\"><a href=\"#\"><img src=\""+arr[i]['photo']+"\" title=\""+arr[i]['real_name']+"\" alt=\""+arr[i]['real_name']+"\"></a></div><div class=\"right\"><a href=\"#\"><h3>"+arr[i]['real_name']+"<span>";
				if(arr[i]['sex']==1){
				    strHtml+= "男";
				}else{
				    strHtml+= "女";
				} 
				strHtml+="</span></h3><p>"+arr[i]['college']+"<span>"+arr[i]['class']+"</span></p></a><a class=\"vote-btn\" href=\"###\">投票</a></div><a class=\"detail-btn\" href=\"alert-"+arr[i]['id']+"-opration-alert.html\">改</a></div>";
	            openDiv.html(strHtml);
	        }
   		}

</script>
</head>
<body>
<div class="m-page">
<h2 style=" text-align:center; background:#ffffff; box-shadow:0 0 1em #141414" >这里是修改页面</h2>
	<div class="sort-title">
		<ul class="clearfix">
			<input type="hidden" name="action" id="action" value="<?php echo ($action); ?>">
			<li>
				<a href="alert.html">全部<i></i></a>
			</li>
			<li>
				<a href="alert-count.html">按票数<i></i></a>
			</li>
			<li>
				<a href="alert-sex.html">按性别<i></i></a>
			</li>
		</ul>
	</div>
	<div class="sort-list">
		<ul id="add">
		<?php if(is_array($resut)): foreach($resut as $key=>$vo): ?><li>
				<div class="sort-num">当前票数：<?php echo ($vo["vote_count"]); ?></div>
				<div class="sort-main clearfix">
					<div class="left">
						<a href="#">
							<img src="<?php echo ($vo["photo"]); ?>" width="105" title="<?php echo ($vo["real_name"]); ?>" alt="<?php echo ($vo["real_name"]); ?>">
						</a>
					</div>
					<div class="right">
						<a href="#">
							<h3><?php echo ($vo["real_name"]); ?><span><?php if($vo["sex"] == 1): ?>男<?php else: ?>女<?php endif; ?></span></h3>
							<p><?php echo ($vo["college"]); ?><span><?php echo ($vo["class"]); ?></span></p>
						</a>
						<a class="vote-btn" href="###">投票</a>
					</div>
					<!--<a class="detail-btn" href="<?php echo U('alert',array('id'=>$vo['id'],'opration'=>'alert'));?>">改</a>-->
					<a class="detail-btn" href="alert-<?php echo ($vo['id']); ?>-opration-alert.html">改</a>
				</div>
			</li><?php endforeach; endif; ?>
		</ul>
        <a class="more-btn" href="###" id="get_more" onclick="loadmore(this)" >查看更多</a>
	</div>
</div>
</body>
</html>