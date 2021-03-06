[![Code Climate](https://codeclimate.com/github/tworzenieweb/zf-bc-view-helpers/badges/gpa.svg)](https://codeclimate.com/github/tworzenieweb/zf-bc-view-helpers) [![Test Coverage](https://codeclimate.com/github/tworzenieweb/zf-bc-view-helpers/badges/coverage.svg)](https://codeclimate.com/github/tworzenieweb/zf-bc-view-helpers/coverage) [![Build Status](https://travis-ci.org/tworzenieweb/zf-bc-view-helpers.svg?branch=master)](https://travis-ci.org/tworzenieweb/zf-bc-view-helpers)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tworzenieweb/zf-bc-view-helpers/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tworzenieweb/zf-bc-view-helpers/?branch=master)

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

```php
$jobleadsHelper = new JobleadsHelper();

// for ZF1
$view = new Zend_View();
$name = $jobleadsHelper->getName();
$helper = $jobleadsHelper->getBCHelper();
$view->registerHelper($helper, $name);

$view->{$name}(); // will execute a helper or just $view->jobleads();

// for ZF2
$renderer = new PhpRenderer();
$helpers = new HelperPluginManager();
$helpers->setInvokableClass($name, get_class($jobleadsHelper));
$renderer->setHelperPluginManager($helpers);

$renderer->{$name}(); // will execute a helper or just $renderer->jobleads();
```

Of course you can use factory class for instantiating the helper and passing necessary dependancies.
