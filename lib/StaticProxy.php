<?php namespace StaticProxy;

/**
 * Static Proxy
 *
 * A class that acts a proxy for calling Static methods non-statically
 *
 * @author danielgsims
 */
class StaticProxy
{
    /**
     * The name of the class that is being proxied
     *
     * @var string
     */
    private $class;
   
    /**
     * Setup a proxy for the supplied class
     *
     * @param string $class The name of the class to proxy
     */
    public function __construct($class)
    {
        if (!class_exists($class)) {
            throw new Exception("Class {$class} does not exist.");
        }

        $this->class = (string) $class;
    }

    /**
     * Take any method and attempt to call it statically from the defined class
     *
     * @param string $method The name of the method being called
     * @param array $args The arguments that were supplied to the method
     */
    public function __call($method, $args)
    {
        if (!method_exists($this->class, $method)) {
            throw new Exception("Class {$this->class} does not have method {$method}");
        }

        $signature =  $this->class . "::{$method}";

        return call_user_func_array($signature, $args);
    }

    /**
     * Create a class alias for StaticProxy
     *
     * @param string $name The fully qualified class name to alias as StaticProxy
     */
    public function alias($name)
    {
        class_alias('StaticProxy\StaticProxy', $name);
    }
}
