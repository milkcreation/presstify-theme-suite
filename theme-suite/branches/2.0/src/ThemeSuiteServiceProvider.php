<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite;

use tiFy\Container\ServiceProvider;
use tiFy\Contracts\Metabox\MetaboxDriver;
use tiFy\Plugins\ThemeSuite\Contracts\ArchiveComposingMetabox as ArchiveComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleBodyPartial as ArticleBodyPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleCardPartial as ArticleCardPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleChildrenPartial as ArticleChildrenPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleFooterPartial as ArticleFooterPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleHeaderPartial as ArticleHeaderPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleTitlePartial as ArticleTitlePartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\GlobalComposingMetabox as GlobalComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Contracts\ImageGalleryMetabox as ImageGalleryMetaboxContract;
use tiFy\Plugins\ThemeSuite\Contracts\NavMenuPartial as NavMenuPartialPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\SingularComposingMetabox as SingularComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Metabox\ImageGalleryMetabox;
use tiFy\Plugins\ThemeSuite\Metabox\Post\Composing\ArchiveMetabox;
use tiFy\Plugins\ThemeSuite\Metabox\Post\Composing\GlobalMetabox;
use tiFy\Plugins\ThemeSuite\Metabox\Post\Composing\SingularMetabox;
use tiFy\Plugins\ThemeSuite\Partial\ArticleBodyPartial;
use tiFy\Plugins\ThemeSuite\Partial\ArticleCardPartial;
use tiFy\Plugins\ThemeSuite\Partial\ArticleChildrenPartial;
use tiFy\Plugins\ThemeSuite\Partial\ArticleFooterPartial;
use tiFy\Plugins\ThemeSuite\Partial\ArticleHeaderPartial;
use tiFy\Plugins\ThemeSuite\Partial\ArticleTitlePartial;
use tiFy\Plugins\ThemeSuite\Partial\NavMenuPartial;
use tiFy\Wordpress\Query\QueryPost as post;
use WP_Post;

class ThemeSuiteServiceProvider extends ServiceProvider
{
    /**
     * Liste des noms de qualification des services fournis.
     * @internal requis. Tous les noms de qualification de services à traiter doivent être renseignés.
     * @var string[]
     */
    protected $provides = [
        'theme-suite',
        'theme-suite.partial.article-body',
        'theme-suite.partial.article-card',
        'theme-suite.partial.article-children',
        'theme-suite.partial.article-footer',
        'theme-suite.partial.article-header',
        'theme-suite.partial.article-title',
        'theme-suite.partial.nav-menu',
        ArchiveComposingMetaboxContract::class,
        ArticleBodyPartialContract::class,
        ArticleCardPartialContract::class,
        ArticleChildrenPartialContract::class,
        ArticleFooterPartialContract::class,
        ArticleHeaderPartialContract::class,
        ArticleTitlePartialContract::class,
        GlobalComposingMetaboxContract::class,
        ImageGalleryMetaboxContract::class,
        NavMenuPartialPartialContract::class,
        SingularComposingMetaboxContract::class,
    ];

    /**
     * @inheritDoc
     */
    public function boot()
    {
        events()->listen('wp.booted', function () {
            $this->getContainer()->get('theme-suite')->boot();
        });
    }

    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->getContainer()->share('theme-suite', function () {
            return new ThemeSuite(config('theme-suite', []), $this->getContainer());
        });

        $this->registerPartialDrivers();

        $this->registerMetaboxDrivers();
    }

    /**
     * Déclaration de la collection de pilote de portion d'affichage.
     *
     * @return void
     */
    public function registerPartialDrivers(): void
    {
        $this->getContainer()->share(ArticleBodyPartialContract::class, function () {
            return new ArticleBodyPartial();
        });

        $this->getContainer()->share(ArticleCardPartialContract::class, function () {
            return (new ArticleCardPartial())->setThemeSuite($this->getContainer()->get('theme-suite'));
        });

        $this->getContainer()->share(ArticleChildrenPartialContract::class, function () {
            return new ArticleChildrenPartial();
        });

        $this->getContainer()->share(ArticleFooterPartialContract::class, function () {
            return new ArticleFooterPartial();
        });

        $this->getContainer()->share(ArticleHeaderPartialContract::class, function () {
            return new ArticleHeaderPartial();
        });

        $this->getContainer()->share(ArticleTitlePartialContract::class, function () {
            return new ArticleTitlePartial();
        });

        $this->getContainer()->share(NavMenuPartialPartialContract::class, function () {
            return new NavMenuPartial();
        });
    }

    /**
     * Déclaration de la collection de pilote de metaboxes.
     *
     * @return void
     */
    public function registerMetaboxDrivers(): void
    {
        $this->getContainer()->share(ImageGalleryMetaboxContract::class, function () {
            return (new ImageGalleryMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'));
        });

        $this->getContainer()->share(ArchiveComposingMetaboxContract::class, function () {
            return (new ArchiveMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });

        $this->getContainer()->share(GlobalComposingMetaboxContract::class, function () {
            return (new GlobalMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });

        $this->getContainer()->share(SingularComposingMetaboxContract::class, function () {
            return (new SingularMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });
    }
}