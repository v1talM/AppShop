# AppShop server system 

## 运行环境要求 environment

*  PHP版本不低于5.5.9  php >= 5.5.9
*  开启OpenSSL PHP扩展  OpenSSL PHP Extension
*  开启PDO扩展  PDO PHP Extension
*  开启Mbstring扩展  Mbstring PHP Extension
*  开启Tokenizer扩展  Tokenizer PHP Extension
*  需要安装redis 并开启扩展
*  安装composer

## 安装 installation
- - -
项目根目录下执行命令 `composer install`

### 配置数据库 databases
- - -
项目根目录下执行命令 `php artisan migrate`

### 填充必要数据 migration
- - -
项目根目录下执行命令 `php artisan db:seed`

> 执行该命令后会在数据库填充商品分类、默认管理员、测试收货地址

## linux安装注意 
- - -
###  设置目录权限
将项目下的storage目录赋予权限:
`sudo chmod -R 775 your_path/storage`

that's all

