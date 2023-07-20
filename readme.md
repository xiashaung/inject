## 说明

    1.  自动为路由组 web,api提供注入服务

## 其他文档

- [登录校验](doc/login.md)

## 使用示例

```php
namespace App\Http\Controllers;

use Xiashaung\Inject\Attribute\Inject;
use App\Services\OrderService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    #[Inject]
    //使用inject标注需要注入服务,OrderService 自动使用服务容器解析实例,如果 OrderService 里有静态方法 make ,自动调用
    protected OrderService $orderService;

```

## 其他方法使用

```php
//解析给定的类并为属性自动注入,返回实例
inject($classname,$args)->method()
```

## 其他路由组

    在AppServiceProvider的boot方法中添加

```php
Route::pushMiddlewareToGroup('group_name', Xiashaung\Inject\Middleware\ControllerInject::class);
```     
