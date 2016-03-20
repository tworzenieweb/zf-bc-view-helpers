<?php

namespace Tworzenieweb\Helper;

/**
 * @author Luke Adamczewski
 * @package Tworzenieweb\Helper
 */
class JobleadsHelper extends AbstractBCViewHelper
{
    const HELPER_ALIAS = 'jobleads';

    /**
     * @return string
     */
    public function __invoke()
    {
        return $this->doSomeLogic();
    }

    /**
     * @return string
     */
    private function doSomeLogic()
    {
        return 'foo';
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::HELPER_ALIAS;
    }
}