<?php namespace StaticProxy;

class Aliaser
{
    public function register($name)
    {
        class_alias('StaticProxy\StaticProxy', $name);
    }

    public function registerList(array $names)
    {
        foreach ($names as $name) {
            $this->register($name);
        }
    }
}


