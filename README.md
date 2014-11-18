StaticProxy
===========

StaticProxy is a thin class that acts as a proxy for calling static methods. You can use StaticProxy when 
you would like to injet an instance as opposed to calling static methods directly.

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
