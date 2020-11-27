<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Plugins\ThemeSuite\Contracts\ArticleCardPartial as ArticleCardPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\QueryPostComposing;
use tiFy\Support\Proxy\Partial;
use tiFy\Wordpress\Contracts\Query\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as post;

class ArticleCardPartial extends AbstractPartialDriver implements ArticleCardPartialContract
{
    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            'excerpt' => 'teaser',
            'post'    => null,
            'enabled' => [
                'excerpt'  => true,
                'readmore' => true,
                'title'    => true,
                'thumb'    => true,
            ],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        if ($article = ($p = $this->get('post', null)) instanceof QueryPostContract ? $p : post::create($p)) {
            if ($article instanceof QueryPostComposing) {
                $enabled = array_merge($article->getArchiveComposing('enabled', []), $this->get('enabled', []));

                $this->set('thumbnail', $article->getBanner());
            } else {
                $enabled = $this->get('enabled', []);
                $this->set('thumbnail', $article->getThumbnail('composing-banner'));
            }

            if (!$this->get('thumbnail') && ($this->get('holder') !== false)) {
                $holder = $this->get('holder', null);
                if (!is_string($holder)) {
                    $holder = Partial::get('holder', array_merge([
                        'attrs'  => [
                            'class' => '%s ArticleCard-thumbImg',
                        ],
                        'width'  => 480,
                        'height' => 270,
                    ], is_array($holder) ? $holder : []));
                }
                $this->set('thumbnail', $holder);
            }

            if ($this->get('readmore') !== false) {
                $readmore = $this->get('readmore', null);
                if (!is_string($readmore)) {
                    $readmore = Partial::get('tag', array_merge([
                        'attrs'   => [
                            'class' => '%s ArticleCard-readmoreLink',
                            'href'  => $article->getPermalink(),
                            'title' => sprintf(__('Consulter %s', 'tify'), $article->getTitle(true)),
                        ],
                        'content' => __('Lire la suite', 'tify'),
                        'tag'     => 'a',
                    ], is_array($readmore) ? $readmore : []));
                }
                $this->set(compact('readmore'));
            }

            $this->set([
                'article' => $article,
                'enabled' => $enabled,
            ]);

            return parent::render();
        }

        return '';
    }
}