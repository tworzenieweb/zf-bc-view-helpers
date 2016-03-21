<?php

namespace Tworzenieweb\Helper;

use Mockery;
use Mockery\MockInterface;
use PHPUnit_Framework_TestCase;
use Zend_View;

/**
 * @author Luke Adamczewski
 * @package Tworzenieweb\Helper
 */
class LegacyViewHelperWrapperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var BCViewHelperInterface|MockInterface
     */
    private $helper;

    /**
     * @var LegacyViewHelper
     */
    private $helperWrapper;

    public function setUp()
    {
        $this->helper = Mockery::mock('\Tworzenieweb\Helper\JobleadsHelper')->makePartial();
        $this->helperWrapper = new LegacyViewHelper();
        $this->helperWrapper->injectHelper($this->helper);
    }

    public function testInnerHelperInvokeMethodShouldBeInvoked()
    {
        $args = [1, 2, 3];
        $this->assertTrue(true, is_callable($this->helperWrapper));
        $this->helper->shouldReceive('__invoke')->once()->withArgs($args);

        $this->helperWrapper->__invoke($args);
    }

    public function testHelperWrapperShouldBeCompatibleWithZendView()
    {
        $view = new Zend_View();
        $name = $this->helperWrapper->getName();
        $view->registerHelper($this->helperWrapper, $name);
        $this->helper->shouldReceive('__invoke')->once()->with(1, 2, 3);

        $view->{$name}(1, 2, 3);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testItShouldFailWhenHelperIsNotCallable()
    {
        $notCallableMock = Mockery::mock('\Tworzenieweb\Helper\BCViewHelperInterface');
        $this->helperWrapper->injectHelper($notCallableMock);
        $this->helperWrapper->__invoke();
    }
}
