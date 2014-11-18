<?php namespace StaticProxy;

class StaticProxyLocator extends StaticProxy
{
    public function usingNamespace($namespace)
    {
        $this->setNamespace($namespace);
    }

    public function using($class)
    {
        $this->setClass($class);
    }
}
