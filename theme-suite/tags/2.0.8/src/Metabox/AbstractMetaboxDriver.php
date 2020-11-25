<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Metabox;

use tiFy\Metabox\MetaboxDriver;
use tiFy\Plugins\ThemeSuite\ThemeSuiteAwareTrait;

abstract class AbstractMetaboxDriver extends MetaboxDriver
{
    use ThemeSuiteAwareTrait;
}