<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Partial\PartialDriver;
use tiFy\Plugins\ThemeSuite\ThemeSuiteAwareTrait;

abstract class AbstractPartialDriver extends PartialDriver
{
    use ThemeSuiteAwareTrait;

    /**
     * @inheritDoc
     */
    public function viewDirectory(): string
    {
        return $this->ts()->resources("views/partial/{$this->getAlias()}");
    }
}