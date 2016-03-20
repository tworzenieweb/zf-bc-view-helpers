<?php

namespace Tworzenieweb\Helper;

/**
 * @author Luke Adamczewski
 * @package Tworzenieweb\Helper
 */
interface BCViewHelperInterface
{
    /**
     * Get helper method name to be used in view
     * For ex. if we want to use $this->foo() in view we need to return 'foo' as name
     *
     * @return string
     */
    public function getName();

    /**
     * @return LegacyViewHelper
     */
    public function getBCHelper();
}