<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Contracts\Partial\PartialDriver as PartialDriverContract;
use tiFy\Partial\PartialDriver;
use tiFy\Plugins\ThemeSuite\ThemeSuiteAwareTrait;

abstract class AbstractPartialDriver extends PartialDriver
{
    use ThemeSuiteAwareTrait;

    /**
     * Chemin absolu du répertoire des gabarits d'affichage.
     *
     * @return string
     */
    abstract protected function viewerDirectory(): string;

    /**
     * @inheritDoc
     */
    public function parse(): PartialDriverContract
    {
        if (!$this->has('viewer.directory')) {
            $this->set('viewer.directory', $this->viewerDirectory());
        }

        parent::parse();

        return $this;
    }
}