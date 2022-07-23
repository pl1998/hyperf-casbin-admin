#### 基于hyperf开发的后台框架。


* casbin 权限控制:https://github.com/donjan-deng/hyperf-casbin
* 官网文档:https://casbin.org/docs/zh-CN/overview


* 复制配置文件
```shell
cp .env.example .env
```
* 数据迁移
```php
 php bin/hyperf.php gen:auth-env
php bin/hyperf.php migrate
```
