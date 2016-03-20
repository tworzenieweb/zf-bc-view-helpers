<?php

namespace Tworzenieweb\Helper;

use InvalidArgumentException;
use RuntimeException;
use Zend_View;
use Zend_View_Helper_Interface;
use Zend_View_Interface;

/**
 * @author Luke Adamczewski
 * @package Tworzenieweb\Helper
 */
class LegacyViewHelper extends Zend_View implements Zend_View_Helper_Interface
{
    /**
     * @var BCViewHelperInterface|callable
     */
    private $helper;

    /**
     * @var Zend_View_Interface
     */
    private $view;

    /**
     *
     * @param BCViewHelperInterface $helper
     */
    public function injectHelper(BCViewHelperInterface $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @return string
     */
    public function __invoke()
    {
        if (is_callable($this->helper)) {
            $helper = $this->helper;

            return $helper(func_get_args());
        }

        throw new RuntimeException(sprintf('Provided helper of class %s must be invokable', get_class($this->helper)));
    }

    /**
     * @param string $name
     * @param mixed $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ($name === $this->helper->getName()) {
            $helper = $this->helper;

            return $helper($arguments);
        }

        throw new InvalidArgumentException(sprintf('Method %s is not exist', $name));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->helper->getName();
    }

    /**
     * Set the View object
     *
     * @param  Zend_View_Interface $view
     *
     * @return Zend_View_Helper_Interface
     */
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    /**
     * Strategy pattern: helper method to invoke
     *
     * @return mixed
     */
    public function direct()
    {
    }
}