### ini解析
##### 将ini配置转成数组,将数组转成ini配置.支持配置文件读写.

### 环境要求 : 
##### > 5.4

### 安装方式 : 
##### composer require dongqibin/ini

### 一般示例 : 
##### 获取文件内的配置信息 : 
```php
$iniClass->loadFile($configFile)->getAll();
```
	
##### 将配置信息写入文件 : 
```php
$iniClass->load($config)->write();
```

### 使用方式 : 
###### 从文件加载配置 loadFile($file)
###### 从数组加载配置 load($config)
###### ini转数组 : decode()
###### 数组转ini : encode()
###### 写入文件 : write()
###### 获取配置 : getAll()
###### 设置配置路径 : setFile()
###### 获取配置路径 : getFile()

