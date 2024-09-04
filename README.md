配置：php 8.3 + mysql 8.3 + laravel 11
运行：
1. 项目目录执行 composer update，若网络问题请挂代理。
2. 复制.env.example为.env
3. 编辑.env文件，将其中的数据库连接DB_CONNECTION=sqlite改为mysql，然后根据自己数据库信息配置
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=
DB_PREFIX=t_
配置SESSION_DRIVER=file

4. mysql中新建数据库test,将demo.sql导入创建数据表。
5. 执行 php artisan key:generate
6. 执行php artisan serve，格努提示在浏览器中打开地址 http://127.0.0.1:8000
