<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>任务列表</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <style>
        <style type="text/css">
                              #pages{
                                  text-align:center;
                              }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a,
        .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #428bca;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination > li:first-child > a,
        .pagination > li:first-child > span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .pagination > li:last-child > a,
        .pagination > li:last-child > span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            color: #2a6496;
            background-color: #eee;
            border-color: #ddd;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .pagination > .active > a:hover,
        .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .clear{
            clear: both;
        }
    </style>
    </style>
</head>
<body>
<a href="/task/create"  class="layui-btn">新增任务</a>  当前用户: {{ $username }}    <a href="/user/logout">退出登录</a>
<table class="layui-table">
    <colgroup>
        <col width="150">
        <col width="200">
        <col>
    </colgroup>
    <thead>
    <tr>
        <th>编号</th>
        <th>标题</th>
        <th>创建时间</th>
        <th>过期时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->title }}</td>
        <td>{{ $user->created_at }}</td>
        <td>{{ $user->expired_at }}</td>
        <td><a href="/task/edit/{{ $user->id }}">编辑</a> <a  data-id="{{ $user->id }}" class="task_delete" >删除</a></td>
    </tr>
    @endforeach
    </tbody>
</table>
{{ $data->appends(['limit' => request()->input('limit', 10)])->links()  }}

<script src="/layui/layui.js"></script>
<script>
    layui.use('layer', function() {
        var $ = layui.$;
        $('.task_delete').on('click', function(e) {
            e.preventDefault(); // 阻止默认的链接行为
            var taskId = $(this).data('id'); // 获取data-id的值
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            layer.confirm('是否确认删除？', {icon: 3}, function(){

                $.ajax({
                    url: '/task/delete/' + taskId ,
                    type: "POST",
                    dataType: "json",
                    success:function (data) {
                        console.log(data);
                        if (data.code !== 0) {
                            layer.msg(data.msg);
                        } else {
                            layer.msg('删除成功');
                            location.reload()
                        }
                    }
                });
            }, function() {
                // 取消
            })

        })

    });
</script>
</body>
</html>
