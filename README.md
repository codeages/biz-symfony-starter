# Biz & Symfony Starter

## PHP初始化

  * 安装依赖

    ```
    composer install
    ```

  * 初始化数据库

    创建数据库：
    ```
    CREATE DATABASE `example` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
    ```

    创建数据库表：
    ```
    bin/phpmig migrate
    ```

    示例程序会初始化`user`表。phpmig的使用见[文档](https://github.com/codeages/biz-framework-doc/blob/master/migration.md)。

  * 初始化应用

    ```
    app/console app:init
    ```

    此命令会创建一个用户名为`admin`，密码为`kaifazhe`的，角色为`超级管理员`的用户。


## 本地运行（需PHP>=5.4.0）

```
app/console server:run
```

## 前端初始化（需安装nodejs环境）

  * 依赖安装

    ```
    npm install
    ```

  * 开发模式

    ```
    npm run dev
    ```

## 单元测试

  * 执行所有单元测试

    ```
    phpunit -c app/ 
    ```

  * 执行某个单元测试

    ```
    phpunit -c app TEST_CAST_FILEPATH
    ```
