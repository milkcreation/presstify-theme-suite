<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Plugins\ThemeSuite\Query\QueryPost as ThemeSuiteQueryPost;
use tiFy\Wordpress\Contracts\Query\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as post;

class ArticleHeaderPartial extends AbstractPartialDriver
{
    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            'breadcrumb' => true,
            /** @var int|object|false|null */
            'post'       => null,
            'title'      => null,
            'content'    => null,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        if (($breadcrumb = $this->get('breadcrumb')) && !is_array($breadcrumb)) {
            $this->set('breadcrumb', []);
        }

        $content = $this->get('content');

        if ($this->get('post') === false) {
            if ($content !== false) {
                $this->set('attrs.class', $this->get('attrs.class') . ' ArticleHeader--with_content');
            }

            if (($title = $this->get('title')) && is_string($title)) {
                $this->set('title', [
                    'content' => $title,
                    'post'    => false,
                ]);
            }

            $this->set([
                'title' => $this->get('title'),
            ]);

            return parent::render();
        } elseif ($article = ($p = $this->get('post', null)) instanceof QueryPostContract ? $p : post::create($p)) {
            if ($article instanceof ThemeSuiteQueryPost) {
                $enabled = array_merge($article->getArchiveComposing('enabled', []), $this->get('enabled', []));

                if (is_null($content)) {
                    $content = $article->getHeader() ?: false;
                }
            } else {
                $enabled = $this->get('enabled', []);
            }

            if ($content !== false) {
                $this->set('attrs.class', $this->get('attrs.class') . ' ArticleHeader--with_content');
            }

            $this->set([
                'article' => $article,
                'title'   => [
                    'post' => $article,
                ],
                'content' => $content,
                'enabled' => $enabled
            ]);

            return parent::render();
        }

        return '';
    }
}