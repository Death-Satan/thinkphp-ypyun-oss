# thinkphp6 又拍云 filesystem

基于 [jellybool/flysystem-upyun](https://github.com/JellyBool/flysystem-upyun) 轻度封装tp
## 安装

---
```shell
composer require death_satan/thinkphp-aliyun-oss
```
---

## 初始化
### 修改配置 *config/filesystem.php* 文件

---
```php
<?php

return [
    // 默认磁盘
    'default' => env('filesystem.driver', 'local'),
    // 磁盘列表
    'disks'   => [
        'local'  => [
            'type' => 'local',
            'root' => app()->getRuntimePath() . 'storage',
        ],
        'public' => [
            // 磁盘类型
            'type'       => 'local',
            // 磁盘路径
            'root'       => app()->getRootPath() . 'public/storage',
            // 磁盘路径对应的外部URL路径
            'url'        => '/storage',
            // 可见性
            'visibility' => 'public',
        ],
        //新增一个磁盘
        'ypyun'=>[
            'type'            => 'Ypyun',//设置驱动
            'bucket'          => 'your-bucket-name', //设置一个默认的存储桶地域
            'operator'             => 'yourOperatorName',//操作员名称
            'password'          => 'https', //操作员密码
            'domain'   => '域名',//域名
            'protocol'         => 'http',//通道类型
        ]
        // 更多的磁盘配置信息
    ],
];

```
---

## 使用方法
### 通过filesystem使用

---
```php 
//通过门面使用
think\facade\Filesystem::disk('ypyun')
//在控制器中通过注入使用
class TestControl{

    public function Test(\think\Filesystem $filesystem)
    {
        $aliyun = $filesystem->disk('ypyun');
    }
}
```
---

### 文件上传

```php 
<?php
namespace app\controller;

use app\BaseController;
use app\Request;
use think\facade\Filesystem;

class Index extends BaseController
{
    public function index(Request $request)
    {
        //获取上传文件
        $file = $request->file('image');
        //通过filesystem进行上传
        $url = Filesystem::disk('ypyun')->putFile('images', $file);
        if (!$url) new \exception('上传失败');

        dd('上传成功,文件位置:' . $url);
    }
}
```