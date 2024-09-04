<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>创建任务</title>

    <link rel="stylesheet" href="/layui/css/layui.css">

</head>
<body>
<form class="layui-form" action="" id="editForm">
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input type="text" name="name" size="100" id="name" required value=""  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-inline">
            <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">过期时间</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" id="expired_at" name="expired_at" placeholder="yyyy-MM-dd">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">创建</button>
        </div>
    </div>
</form>

<script src="/layui/layui.js"></script>
<script>
    //Demo
    layui.use('form', function(){
        var laydate = layui.laydate;
        // 渲染
        laydate.render({
            elem: '#expired_at',
        });

        var form = layui.form;
        var $ = layui.$;
        //监听提交
        form.on('submit(formDemo)', function(data){
            $.ajax({
                url: '/task/store' ,
                data: $('#editForm').serialize(),
                type: "POST",
                dataType: "json",
                success:function (data) {
                    console.log(data);
                    if (data.code !== 0) {
                        layer.msg(data.msg);
                    } else {
                        layer.msg('创建成功');
                        location.href='/task/index';
                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
