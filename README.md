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
