<?php namespace StaticProxy;

class StaticProxy
{
    private $class;
   
    public function __construct($class)
    {
        if (!class_exists($class)) {
            throw new Exception("Class {$class} does not exist.");
        }

        $this->class = (string) $class;
    }

    public function __call($method, $args)
    {
        if (!method_exists($this->class, $method)) {
            throw new Exception("Class {$this->class} does not have method {$method}");
        }

        return call_user_func_array($this->getSignature($method), $args);
    }

    private function getSignature($method)
    {
        return $this->class . "::{$method}";
    }

    public function alias($name)
    {
        class_alias('StaticProxy\StaticProxy', $name);
    }
}
