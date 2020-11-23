<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Column;

use tiFy\Column\AbstractColumnDisplayPostTypeController;
use tiFy\Plugins\ThemeSuite\Query\QueryPost as post;
use tiFy\Plugins\ThemeSuite\ThemeSuiteAwareTrait;

class ComposingColumn extends AbstractColumnDisplayPostTypeController
{
    use ThemeSuiteAwareTrait;

    /**
     * @inheritDoc
     */
    public function header()
    {
        return $this->item->getTitle() ? : __('Composition', 'theme');
    }

    /**
     * @inheritDoc
     */
    public function content($column_name = null, $post_id = null, $null = null)
    {
        return $this->viewer('index', ['post' => post::create($post_id)]);
    }
}