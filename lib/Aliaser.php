<?php namespace StaticProxy;

/**
 * Static Proxy Aliaser
 *
 * A helper class to alias class names as Static Proxy
 *
 * @author danielgsims
 */
class Aliaser
{
    /**
     * Create a class alias for StaticProxy
     *
     * @param string $name The fully qualified class name to alias as StaticProxy
     */
    public function register($name)
    {
        class_alias('StaticProxy\StaticProxy', $name);
    }

    /**
     * Register many aliases for Static Proxy
     *
     * @param array $names Array of fully qualified class names to alias as StaticProxy
     * @param string $prefix Prefix to be applied for class names, can be used for namespaces etc.
     */
    public function registerList(array $names, $prefix = null)
    {
        foreach ($names as $name) {
            $class = $prefix 
                        ? $prefix . $name 
                        : $name;

            $this->register($class);
        }
    }
}
