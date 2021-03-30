#### 安装

1. 通过composer下载安装包

```shell
composer require papiyas/api
```

2. 发布资源
```shell
php artisan vendor:publish --provider="Papiyas\Api\ApiServiceProvider"
```

3. 修改项目本地默认语言包目录
```
# config/app.php

- 'locale' => 'en',
+ 'locale' => 'zh_CN',
```

#### 使用方式

```php

# routes/api.php
use Illuminate\Support\Facades\Route;
use Papiyas\Api\Facades\Api;

Route::get('/success', function () {
    return Api::success([
        // success data
        'api' => 'call it successful!'
    ]);
});

use App\Enums\ApiCodeEnum;

Route::get('/failure', function () {
    
    return Api::failure(
        ApiCodeEnum::FAILURE,
        /**
         * 第二个参数为自定义返回错误信息，默认情况下会自动去
         * resource/lang/zh_CN/api.php文件读取对应的信息
         * 假设api.php中为
         * 'failure' => '失败',
         * 则返回前端的错误信息即为'失败'. 如果想要覆盖默认提示则
         * 填写第二个参数即可。 
         */  
        '错误结果'
    );
});
```

```shell
#启动服务后直接通过127.0.0.1/api/success或failure即能对上述代码进行演示
php artisan serve
```


