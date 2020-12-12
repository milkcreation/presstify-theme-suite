<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Partial;

use tiFy\Plugins\ThemeSuite\Contracts\ArticleHeaderPartial as ArticleHeaderPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\QueryPostComposing;
use tiFy\Wordpress\Contracts\Query\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as post;

class ArticleHeaderPartial extends AbstractPartialDriver implements ArticleHeaderPartialContract
{
    /**
     * @inheritDoc
     */
    public function defaultParams(): array
    {
        return array_merge(parent::defaultParams(), [
            /**
             * @var bool
             */
            'enabled'    => false,
            /**
             * @var bool|array
             */
            'breadcrumb' => true,
            /**
             * @var int|object|false|null
             */
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
        $breadcrumb = $this->get('breadcrumb');
        $content = $this->get('content');
        $title = $this->get('title');

        if (!is_array($breadcrumb)) {
            $this->set('breadcrumb', []);
        }

        if ($this->get('post') === false) {
            if (! empty($content)) {
                $this->set('attrs.class', $this->get('attrs.class') . ' ArticleHeader--with_content');
            } else {
                $content = false;
            }

            if (is_string($title)) {
                $title =  [
                    'content' => $title,
                    'post'    => false,
                ];
            } elseif (is_array($title)) {
                $title = array_merge(['post' => false], $title);
            }

            $this->set(compact('content', 'title'));
        } elseif ($article = ($p = $this->get('post', null)) instanceof QueryPostContract ? $p : post::create($p)) {
            if ($article instanceof QueryPostComposing) {
                $enabled = $article->getSingularComposing('enabled', []);

                if (is_null($content)) {
                    $content = ($header = $article->getHeader()) && $enabled['header'] ? $header : false;
                }
            }

            if ($content !== false) {
                $this->set('attrs.class', $this->get('attrs.class') . ' ArticleHeader--with_content');
            }

            $title = ['post' => $article];

            $this->set(compact('article', 'content', 'title'));
        }

        $this->set('enabled', $this->get('enabled') || !!$breadcrumb || !!$title || !!$content);

        return parent::render();
    }
}