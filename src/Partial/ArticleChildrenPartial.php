<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Plugins\ThemeSuite\Contracts\ArticleChildrenPartial as ArticleChildrenPartialContract;
use tiFy\Plugins\ThemeSuite\Query\QueryPost as ThemeSuiteQueryPost;
use tiFy\Wordpress\Contracts\Query\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as post;

class ArticleChildrenPartial extends AbstractPartialDriver implements ArticleChildrenPartialContract
{
    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            'enabled'    => [
                'children' => true
            ],
            'post'       => null,
            'per_page'   => -1,
            'paged'      => 1,
            'query_args' => [],
            'title'      => __('Autre contenu en relation', 'tify'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        if ($article = ($p = $this->get('post', null)) instanceof QueryPostContract ? $p : post::create($p)) {
            if (!$article->isHierarchical()) {
                return '';
            }

            if ($article instanceof ThemeSuiteQueryPost) {
                $enabled = array_merge($article->getSingularComposing('enabled', []), $this->get('enabled', []));
            } else  {
                $enabled = $this->get('enabled', []);
            }

            if (!$enabled['children']) {
                return '';
            }

            if (!$items = $article->getChildren($this->get('per_page'), $this->get('paged'), array_merge(
                ['orderby' => ['menu_order' => 'ASC']],
                $this->get('query_args', [])
            ))) {
                return '';
            }

            $this->set([
                'article' => $article,
                'items'   => $items,
                'enabled' => $enabled
            ]);

            return parent::render();
        }

        return '';
    }
}
