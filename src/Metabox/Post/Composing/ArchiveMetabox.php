<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Metabox\Post\Composing;

use tiFy\Plugins\ThemeSuite\Contracts\ArchiveComposingMetabox as ArchiveComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Metabox\AbstractMetaboxDriver;

class ArchiveMetabox extends AbstractMetaboxDriver implements ArchiveComposingMetaboxContract
{
    /**
     * @inheritDoc
     */
    public function defaultParams(): array
    {
        return array_merge(parent::defaults(), [
            'banner'        => true,
            'banner_format' => false,
            'excerpt'       => true,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            'name'  => '_archive_composing',
            'title' => __('Compo. page de flux', 'tify'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function viewDirectory(): string
    {
        return $this->ts()->resources('views/metabox/post/composing/archive');
    }
}