<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Metabox\Post\Composing;

use tiFy\Plugins\ThemeSuite\Contracts\SingularComposingMetabox as SingularComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Metabox\AbstractMetaboxDriver;

class SingularMetabox extends AbstractMetaboxDriver implements SingularComposingMetaboxContract
{
    /**
     * @inheritDoc
     */
    public function defaultParams(): array
    {
        return array_merge(parent::defaults(), [
            'header'         => true,
            'children'       => false,
            'children_title' => false,
            'children_edit'  => false
        ]);
    }

    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            'name'  => '_singular_composing',
            'title' => __('Compo. page de contenu', 'tify'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function viewDirectory(): string
    {
        return $this->ts()->resources('views/metabox/post/composing/singular');
    }
}