<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Plugins\ThemeSuite\Contracts\ArticleBodyPartial as ArticleBodyPartialContract;
use tiFy\Plugins\ThemeSuite\Query\QueryPost as ThemeSuiteQueryPost;
use tiFy\Wordpress\Contracts\Query\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as post;

class ArticleBodyPartial extends AbstractPartialDriver implements ArticleBodyPartialContract
{
    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            /** @var int|object|false|null */
            'post'    => null,
            'enabled' => [
                'content' => true,
            ],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        if ($this->get('post') === false) {
            $this->set('content', apply_filters('the_content', $this->get('content')));

            return parent::render();
        } elseif ($article = ($p = $this->get('post', null)) instanceof QueryPostContract ? $p : post::create($p)) {
            if ($article instanceof ThemeSuiteQueryPost) {
                $enabled = array_merge($article->getSingularComposing('enabled', []), $this->get('enabled', []));
            } else {
                $enabled = $this->get('enabled', []);
            }

            $this->set([
                'article' => $article,
                'content' => $enabled['content'] ? trim($article->getContent()) : '',
                'enabled' => $enabled,
            ]);

            return parent::render();
        }

        return '';
    }
}