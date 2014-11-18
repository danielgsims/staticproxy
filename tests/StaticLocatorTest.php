<?php

class StaticLocatorTest extends PHPUnit_Framework_TestCase
{
    public function testStatic()
    {
        $s = new StaticProxy\StaticProxyLocator;
        $s->using("StaticGuy");

        $this->assertEquals($s->normal(1,2,3),[1,2,3]);
        $this->assertEquals($s->defaultArgs(),[1,2,3]);
        $this->assertEquals($s->defaultArgs(4),[4,2,3]);
        $this->assertEquals($s->defaultArgs(4,5),[4,5,3]);
        $this->assertEquals($s->defaultArgs(4,5,6),[4,5,6]);
    }

    public function testMethodError()
    {
        $this->setExpectedException('StaticProxy\Exception');
        $s = new StaticProxy\StaticProxyLocator;
        $s->using("StaticGuy");
        $s->missing();
    }
    
    public function testClassUndefined()
    {
        $this->setExpectedException('StaticProxy\Exception');
        $s = new StaticProxy\StaticProxyLocator;
        $s->using("NoClass");
        $s->method();
    }

    public function testClassNotSet()
    {
        $this->setExpectedException('StaticProxy\Exception');
        $s = new StaticProxy\StaticProxyLocator;
        $s->method();
    }

    public function testNotStatic()
    {
        $this->setExpectedException('StaticProxy\Exception');
        $s = new StaticProxy\StaticProxyLocator;
        $s->using("StaticGuy");
        $s->notStatic();
    }
}
