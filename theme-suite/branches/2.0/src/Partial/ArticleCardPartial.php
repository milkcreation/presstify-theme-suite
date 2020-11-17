<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Plugins\ThemeSuite\Query\QueryPost as ThemeSuiteQueryPost;
use tiFy\Support\Proxy\Partial;
use tiFy\Wordpress\Contracts\Query\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as post;

class ArticleCardPartial extends AbstractPartialDriver
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
            $enabled = ($article instanceof ThemeSuiteQueryPost)
                ? array_merge($article->getSingularComposing('enabled', []), $this->get('enabled', []))
                : $this->get('enabled', []);

            if ($this->get('holder') !== false) {
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
                $this->set(compact('holder'));
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