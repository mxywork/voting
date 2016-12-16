<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>菜园plus-团体管理</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo (ADMIN_IMG_URL); ?>favicon.ico" />
    <link href="<?php echo (ADMIN_CSS_URL); ?>reset.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo (ADMIN_CSS_URL); ?>master.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#img').click(function(){
                $(this).attr("src","/index.php/Home/User/verify");
            });
            $('#user').focus(function(){
                $(this).attr('placeholder','');
            });
            $('#user').blur(function(){
                $(this).attr('placeholder','请填写用户名');
                $('#user').css('border','2px solid #FFFFFF');
            });
            $('#pwd').focus(function(){
                $(this).attr('placeholder','');
            });
            $('#pwd').blur(function(){
                $(this).attr('placeholder','请填写密码');
                $('#pwd').css('border','2px solid #FFFFFF');
            });
            $('#verify').focus(function(){
                $(this).attr('placeholder','');
            });
            $('#verify').blur(function(){
                $(this).attr('placeholder','请填写验证码');
                $('#verify').css('border','2px solid #FFFFFF');
            });
        });
        function sub(){
            var user = $('#user').val();
            var pwd = $('#pwd').val();
            var verify = $('#verify').val();
            if(!user){
                $('#user').css('border','2px solid red');
                return false;
            }
            if(!pwd){
                $('#pwd').css('border','2px solid red');
                return false;
            }
            if(!verify){
                $('#verify').css('border','2px solid red');
                return false;
            }
        }
    </script>
</head>

<body>
<div class="login">
    <div class="cai">
        <div class="cc"><img height="100" width="100" src="<?php echo (ADMIN_IMG_URL); ?>cai.png" /></div>
        <form method="post" action="/index.php/Home/User/login" name="login">
            <input type="text" name="user_name" id="user" value="" placeholder="请填写用户名" />
            <br />
            <input type="password" name="password" id="pwd" placeholder="请填写密码" />
            <br />
            <input class="yzm" type="text" name="verify" id="verify" placeholder="请填写验证码"/>
            <img class="img" src="/index.php/Home/User/verify" id="img" alt="验证码" title="点击刷新"/>
            <br />
            <!--<input type="checkbox" name="remember" value="1"/>记住密码--->
            <input class="sub" type="submit" value="Sign In" onclick="return sub();" />
            <br />
        </form>
    </div>
</div>
</body>
</html>