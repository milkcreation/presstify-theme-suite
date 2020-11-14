<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Wordpress\Contracts\Query\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as post;

class ArticleHeaderPartial extends AbstractPartialDriver
{
    /**
     * @inheritDoc
     */
    protected function viewerDirectory(): string
    {
        return $this->ts()->resources('views/partial/article-header');
    }

    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            /** @var int|object|false|null */
            'post'     => null,
            'title'    => null,
            'subtitle' => null,
            /** @var string|bool visual */
            'visual'   => false
        ]);
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        if ($visual = $this->get('visual')) {
            $this->set('attrs.data-visual', 'true');
        }

        if ($this->get('post') === false) {
            $this->set([
                'title' => [
                    'title'    => $this->get('title'),
                    'subtitle' => $this->get('subtitle'),
                    'visual'   => $visual,
                    'post'     => false
                ],
            ]);

            return parent::render();
        } elseif ($article = ($p = $this->get('post', null)) instanceof QueryPostContract ? $p : post::create($p)) {
           if ($visual) {
                if (!$visual = $article->getThumbnail('header')) {
                    $this->set('attrs.data-visual', 'false');
                }
            }

            $this->set([
                'article' => $article,
                'title'   => [
                    'post' => $article
                ],
                'visual'  => $visual,
            ]);

            return parent::render();
        }

        return '';
    }
}