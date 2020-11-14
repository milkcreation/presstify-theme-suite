<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Wordpress\Contracts\Query\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as post;

class ArticleTitlePartial extends AbstractPartialDriver
{
    /**
     * @inheritDoc
     */
    protected function viewerDirectory(): string
    {
        return $this->ts()->resources('views/partial/article-title');
    }

    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            'tag'      => 'h1',
            'title'    => null,
            'subtitle' => '',
            'icon'     => null,
            /** @var int|object|false|null */
            'post'     => null,
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
            $this->set([
                'article'  => $article,
                'title'    => $article->getTitle(),
                'subtitle' => $article->getSubtitle(),
            ]);

            return parent::render();
        }

        return '';
    }
}