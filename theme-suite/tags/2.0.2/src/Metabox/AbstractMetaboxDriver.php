<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Metabox;

use tiFy\Contracts\Metabox\MetaboxDriver as MetaboxDriverContract;
use tiFy\Metabox\MetaboxDriver;
use tiFy\Plugins\ThemeSuite\ThemeSuiteAwareTrait;

abstract class AbstractMetaboxDriver extends MetaboxDriver
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
    public function parse(): MetaboxDriverContract
    {
        if (!$this->has('viewer.directory')) {
            $this->set('viewer.directory', $this->viewerDirectory());
        }

        parent::parse();

        return $this;
    }
}