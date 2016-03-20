<?php

namespace Tworzenieweb\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * @author Luke Adamczewski
 * @package Tworzenieweb\Helper
 */
abstract class AbstractBCViewHelper extends AbstractHelper implements BCViewHelperInterface
{
    /**
     * @inheritdoc
     */
    public function getBCHelper()
    {
        $helper = new LegacyViewHelper();
        $helper->injectHelper($this);

        return $helper;
    }

    /**
     * @inheritdoc
     */
    abstract public function getName();
}