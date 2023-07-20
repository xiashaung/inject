## 登录校验

```php
use Xiashaung\Inject\CheckLogin;

$obj = new CheckLogin();
//1 校验方法是否不需要登录
//2 校验类是否整个需要登录
//3 校验方法是否需要登录
$res = $obj->check($class,$mehtod);


//如果给定的是匿名函数 需要单独校验
$res = $obj->checkFunction($func);
if ($res){
  //登录校验....
}else{
  //不需要登录....
}
```

### 所有方法需要登录校验

```php

use Xiashaung\Inject\Attribute\NeedLogin;

#[NeedLogin]
class OrderController
{

}
```

### 其中某个方法不需要登录校验

```php

use Xiashaung\Inject\Attribute\NeedLogin;
use Xiashaung\Inject\Attribute\NoNeedLogin;

#[NeedLogin]
class OrderController
{
    #[NoNeedLogin]
    public function orderInfo()
    {
    
    }
}

```

### 只有某个方法需要登录校验

```php

use Xiashaung\Inject\Attribute\NeedLogin;

class OrderController
{
    #[NeedLogin]
    public function orderInfo()
    {
    
    }
}

```
