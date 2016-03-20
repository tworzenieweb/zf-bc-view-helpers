Zend Framework ViewHelpers BC Compatibility
=======

This is a small project to help making cross-version view helpers.
So you can register the same helper class for both ZF1 and ZF2 using additional `getBCHelper` method.

See tests for example code use

```php
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
```