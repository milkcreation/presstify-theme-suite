<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Contracts\Partial\Partial as PartialManager;
use tiFy\Partial\PartialDriver;
use tiFy\Plugins\ThemeSuite\ThemeSuite as ThemeSuiteContract;
use tiFy\Plugins\ThemeSuite\ThemeSuiteAwareTrait;

abstract class AbstractPartialDriver extends PartialDriver
{
    use ThemeSuiteAwareTrait;

    /**
     * @param ThemeSuiteContract $themeSuite
     * @param PartialManager $partialManager
     */
    public function __construct(ThemeSuiteContract $themeSuite, PartialManager $partialManager)
    {
        $this->setThemeSuite($themeSuite);

        parent::__construct($partialManager);
    }

    /**
     * @inheritDoc
     */
    public function viewDirectory(): string
    {
        return $this->ts()->resources("views/partial/{$this->getAlias()}");
    }
}