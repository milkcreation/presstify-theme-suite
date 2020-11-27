<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Query;

use tiFy\Wordpress\Query\QueryPost as BaseQueryPost;
use tiFy\Plugins\ThemeSuite\Contracts\QueryPostComposing;

class QueryPost extends BaseQueryPost implements QueryPostComposing
{
    use QueryPostComposingTrait;
}