# README

## PHP初始化

### 依赖安装

```
composer install
```

### 程序初始化

```
bin/phpmig migrate
app/console app:init
```

phpmig的使用见[文档](https://github.com/codeages/biz-framework-doc/blob/master/migration.md)。

`app:init`命令会初始化一个用户名为`admin`，密码为`kaifazhe`的超管账号，为方便开发，在开发环境下可以通过`/_dev/login`登陆，生产环境则必须通过用户中心的模式登陆系统。


### 本地运行（需PHP>=5.4.0）

```
app/console server:run
```

## 前端初始化（需安装nodejs环境）

### 依赖安装

```
npm install
```

### 开发模式

```
npm run dev
npm run dev port:3038 #改变端口
```

```
#此命令默认会绑定到0.0.0.0:3030，但不会生成真实文件，但可以通过http://127.0.0.1:3030/bundles浏览到文件目录
#本项目中的打包配置文件位于app/Resources/assets/config/parameters.js，
其中output.publicPath指定为'/bundles/'，
所以开发模式下打包后的前端文件可以通过http://127.0.0.1:3030/bundles/xxx/xxx.js访问
#开发模式下，需在symfony的配置文件app/config/parameters.yml中配置以下字段:
assets:
    packages:
        webpack:
            base_urls:
                - 'http://127.0.0.1:3030'
```

### 最终编译

```
#会生成实体文件，本项目会生成到web/bundles/
npm run compile
npm run compile:debug  #不压缩
```

```
#测试编译后的前端文件，设置cdn_enabled: false即可
```

## 单元测试

### 执行所有单元测试

```
phpunit -c app/ 
```

### 执行某个单元测试

```
phpunit -c app TEST_CAST_FILEPATH
```
