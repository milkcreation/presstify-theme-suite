<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Plugins\ThemeSuite\Contracts\ArticleFooterPartial as ArticleFooterPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\QueryPostComposing;
use tiFy\Wordpress\Contracts\Query\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as post;
use tiFy\Support\Proxy\Partial;

class ArticleFooterPartial extends AbstractPartialDriver implements ArticleFooterPartialContract
{
    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            /** @var bool */
            'enabled' => false,
            /** @var int|object|false|null */
            'post'    => null,
            'content' => null,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        $content = $this->get('content');

        if ($this->get('post') === false) {
            return parent::render();
        } elseif ($article = ($p = $this->get('post', null)) instanceof QueryPostContract ? $p : post::create($p)) {
            if ($article instanceof QueryPostComposing) {
                $enabled = $article->getSingularComposing('enabled', []);

                if ($enabled['children']) {
                    $children = Partial::get('article-children', ['post' => $article])->render();

                    if ($children) {
                        $this->set([
                            'children' => $children,
                            'enabled'  => true
                        ]);
                    }
                }
            }

            $this->set([
                'article' => $article,
            ]);
        }

        $this->set('enabled', $this->get('enabled') || !!$content);

        return parent::render();
    }
}