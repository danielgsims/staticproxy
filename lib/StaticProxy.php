<?php namespace StaticProxy;

class StaticProxy
{
    private $namespace;
    private $class;

    public function __construct($class = "", $namespace = "")
    {
        $this->setNamespace($namespace);
        $this->setClass($class);
    }

    final protected function setNamespace($namespace = "")
    {
        $this->namespace = (string) $namespace;
    }

    final protected function setClass($class)
    {
        $this->class = (string) $class;

        return $this;
    }

    public function __call($method, $args)
    {
        $this->classCheck();
        $this->validateMethod($method, $args);

        return call_user_func_array($this->getSignature($method), $args);
    }

    private function classCheck()
    {
        if (!$this->class) {
            throw new Exception("Must set class with Serializer::using method");
        }

        $fqClass = $this->getFullyQualifiedClass();

        if (!class_exists($fqClass)) {
            throw new Exception("Class {$fqClass} does not exist.");
        }
    }

    public function getFullyQualifiedClass()
    {
        return $this->namespace
            ? $this->namespace . "\\" . $this->class
            : $this->class;
    }

    public function getSignature($method)
    {
        return $this->getFullyQualifiedClass() . "::{$method}";
    }

    public function validateMethod($method, $args)
    {
        $fqClass = $this->getFullyQualifiedClass();

        //Check if class has method
        if (!method_exists($fqClass, $method)) {
            throw new Exception("Class {$fqClass} does not have method {$method}");
        }

        $r = new \ReflectionMethod($this->getSignature($method));

        if (!$r->isStatic()) {
            throw new Exception("Class {$fqClass} method {$method} must be static.");
        }

        $argCount = count($args);
        $paramCount = $r->getNumberOfRequiredParameters();

        if ($argCount < $paramCount) {

            $message = "Class {$fqClass} method {$method} takes at least {$paramCount} arguments, {$argCount} given.";
            throw new Exception($message);
        }
    }
}
