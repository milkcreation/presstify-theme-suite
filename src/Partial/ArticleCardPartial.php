<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Plugins\ThemeSuite\Query\QueryPost as ThemeSuiteQueryPost;
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
            'excerpt'  => 'teaser',
            'post'     => null,
            'readmore' => [
                'txt'   => __('Lire la suite', 'tify'),
                'title' => __('Consulter %s', 'tify'),
            ],
            'enabled'  => [
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

            $this->set([
                'article' => $article,
                'enabled' => $enabled,
            ]);

            return parent::render();
        }

        return '';
    }

    /**
     * @inheritDoc
     */
    protected function viewerDirectory(): string
    {
        return $this->ts()->resources('views/partial/article-card');
    }
}