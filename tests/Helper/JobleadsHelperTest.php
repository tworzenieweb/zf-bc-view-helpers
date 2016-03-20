<?php

namespace Tworzenieweb\Helper;

use PHPUnit_Framework_TestCase;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;
use Zend_View;

/**
 * @author Luke Adamczewski
 * @package Tworzenieweb\Helper
 */
class JobleadsHelperTest extends PHPUnit_Framework_TestCase
{
    const EXPECTED_RETURN = 'foo';

    /**
     * @var JobleadsHelper
     */
    private $jobleadsHelper;

    public function setUp()
    {
        $this->jobleadsHelper = new JobleadsHelper();
    }

    public function testInvoke()
    {
        $this->assertEquals(self::EXPECTED_RETURN, $this->jobleadsHelper->__invoke());
    }

    public function testReturningCompatibleZFHelper()
    {
        $view = new Zend_View();
        $name = $this->jobleadsHelper->getName();
        $helper = $this->jobleadsHelper->getBCHelper();
        $this->assertInstanceOf('\Tworzenieweb\Helper\LegacyViewHelper', $helper);
        $view->registerHelper($helper, $name);

        $this->assertEquals(self::EXPECTED_RETURN, $view->{$name}());
    }

    public function testCompatibilityWithZF2View()
    {
        $renderer = new PhpRenderer();
        $helpers = new HelperPluginManager();
        $name = $this->jobleadsHelper->getName();
        $helpers->setInvokableClass($name, get_class($this->jobleadsHelper));
        $renderer->setHelperPluginManager($helpers);
        $this->assertEquals(self::EXPECTED_RETURN, $renderer->{$name}());
    }
}
