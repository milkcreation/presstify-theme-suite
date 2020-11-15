<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Wordpress\Contracts\Query\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as post;
use tiFy\Support\Proxy\Partial;

class ArticleFooterPartial extends AbstractPartialDriver
{
    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            /** @var int|object|false|null */
            'post'     => null,
            'content'  => null
        ]);
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        if ($this->get('post') === false) {
            return parent::render();
        } elseif ($article = ($p = $this->get('post', null)) instanceof QueryPostContract ? $p : post::create($p)) {
            if ($content = Partial::get('article-children', ['post' => $article])->render()) {
                $this->set([
                    'article' => $article,
                    'content' => $content
                ]);

                return parent::render();
            }
        }

        return '';
    }
}