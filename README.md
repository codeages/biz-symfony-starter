# README

## 数据库变更脚本

### 查看所有命名

```
bin/phpmig
```

### 生成一个Migration脚本类

```
bin/phpmig generate ClassName ./migrations
```

第一个参数`ClassName`为本次Migration脚本类的类名，请根据实际情况取名，表明意图。
第二个参数`./migrations`为Migration脚本类的存放目录，请使用约定值`./migrations`。

### 运行所有为执行过的Migration脚本

```
bin/phpmig migrate
```

### 重新执行某个具体版本的Migration脚本

```
bin/phpming redo VERSION_NO
```

### 回退最后执行过的一个版本

```
bin/phpmig rollback
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

