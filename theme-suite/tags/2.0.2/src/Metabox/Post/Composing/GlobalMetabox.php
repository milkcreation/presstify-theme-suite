<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Metabox\Post\Composing;

use tiFy\Plugins\ThemeSuite\Metabox\AbstractMetaboxDriver;
use WP_Post;

class GlobalMetabox extends AbstractMetaboxDriver
{
    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        parent::boot();

        add_action('add_meta_boxes', function () {
            /** @var WP_Post|null $post */
            global $post;

            if ($post instanceof WP_Post) {
                remove_meta_box('postimagediv', $post->post_type, 'side');
            }
        });
    }

    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            'name'     => '_global_composing',
            'title'    => __('Compo. générale', 'tify'),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function viewerDirectory(): string
    {
        return $this->ts()->resources('views/metabox/post/composing/global');
    }
}