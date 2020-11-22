<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Metabox\Post\Composing;

use tiFy\Contracts\Metabox\MetaboxDriver as MetaboxDriverContract;
use tiFy\Plugins\ThemeSuite\Contracts\GlobalComposingMetabox as GlobalComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Metabox\AbstractMetaboxDriver;
use WP_Post;

class GlobalMetabox extends AbstractMetaboxDriver implements GlobalComposingMetaboxContract
{
    /**
     * @inheritDoc
     */
    public function boot(): MetaboxDriverContract
    {
        parent::boot();

        add_action('add_meta_boxes', function () {
            /** @var WP_Post|null $post */
            global $post;

            if ($post instanceof WP_Post) {
                remove_meta_box('postimagediv', $post->post_type, 'side');
            }
        });

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function defaultParams(): array
    {
        return array_merge(parent::defaults(), [
            'baseline'  => false,
            'alt_title' => false,
            'subtitle'  => false,
            'thumbnail' => true
        ]);
    }

    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            'name'  => '_global_composing',
            'title' => __('Compo. générale', 'tify'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function viewDirectory(): string
    {
        return $this->ts()->resources('views/metabox/post/composing/global');
    }
}