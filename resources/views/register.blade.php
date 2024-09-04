<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>注册界面</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
</head>
<body>
<form class="layui-form" action="" id="registerForm">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-block">
            <input type="text" name="name"  id="name" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
            <input type="password" name="password1" id="password1" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">重复密码</label>
        <div class="layui-input-inline">
            <input type="password" name="password2" id="password2" required lay-verify="required" placeholder="请再次输入密码" autocomplete="off" class="layui-input">
        </div>

    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">注册</button>
            <a href="/user/login">去登录</a>
        </div>
    </div>
</form>

<script src="/layui/layui.js"></script>
<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form;
        var $ = layui.$;
        //监听提交
        form.on('submit(formDemo)', function(data){
            $.ajax({
                url: '/user/registerStore',
                data: $('#registerForm').serialize(),
                type: "POST",
                dataType: "json",
                success:function (data) {
                    console.log(data);
                    if (data.code !== 0) {
                        layer.msg(data.msg);
                    } else {
                        layer.msg('注册成功');
                        location.href='/user/login';
                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
