StaticProxy
===========

StaticProxy is a thin class that acts as a proxy for calling static methods. You can use StaticProxy when 
you would like to inject an instance as opposed to calling static methods directly.

```

class Foo
{
    public static function doSomething()
    {
        return "do something";
    }
}

$s = new StaticProxy("Foo");
$s->doSomething();

```

#Why?

Sometimes, you have a dependency that only functions with static methods:

```
class MyController
{
    public function index(Request $request)
    {
        Validator::validate($request);
        
        //do something
    }
}
```

Ideally, you would want to avoid static methods to make your code loosely coupled. You can use a proxy to make this happen.

```
class MyController
{
    private $validator;

    public function __construct(StaticProxy $validator)
    {
        $this->validator = $validator;
    }

    public function index(Request $request)
    {
        $this->validator->validate($request);
    }
}
```

This class is useful when you need to decouple static calls from your code but are unable to rewrite your
dependencies, or do not have the means to create individual adapters.

#Alias

In the above example, we had to typehint that we were using a static proxy, but that's not ideal. Instead, we can use the Aliaser
to register aliases of StaticProxy.

```
class MyController
{
    private $validator;

    public function __construct(Acme\Validator $validator)
    {
        $this->validator = $validator;
    }

    public function index(Request $request)
    {
        $this->validator->validate($request);
    }
}

$a = new Aliaser;
$a->register("Acme\Validator");

$s = new StaticProxy("Foo");
$c = new MyController($s);
```
