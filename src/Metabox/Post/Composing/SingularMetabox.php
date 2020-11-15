<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Metabox\Post\Composing;

use tiFy\Plugins\ThemeSuite\Metabox\AbstractMetaboxDriver;

class SingularMetabox extends AbstractMetaboxDriver
{
    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            'name'     => '_singular_composing',
            'title'    => __('Compo. page de contenu', 'tify'),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function viewerDirectory(): string
    {
        return $this->ts()->resources('views/metabox/post/composing/singular');
    }
}