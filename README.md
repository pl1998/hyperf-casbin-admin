### 基于hyperf+casbin开发的通用管理后台。


#### 依赖
* [casbin包](https://github.com/donjan-deng/hyperf-casbin)
* [casbin 官网文档](ttps://casbin.org/docs/zh-CN/overview)
* [hyperf-auth](https://github.com/qbhy/hyperf-auth)

#### 复制配置文件并配置好mysql、redis信息
```shell
cp .env.example .env
composer install
```
#### 执行初始化构建命令

```php
php bin/hyperf.php admin:install
```

#### 默认账号密码:`dmin@hyperf.com` `hyperfyyds`


