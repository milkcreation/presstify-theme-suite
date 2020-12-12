<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite;

use tiFy\Container\ServiceProvider;
use tiFy\Contracts\Metabox\MetaboxDriver;
use tiFy\Contracts\Partial\Partial as PartialManagerContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArchiveComposingMetabox as ArchiveComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleBodyPartial as ArticleBodyPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleCardPartial as ArticleCardPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleChildrenPartial as ArticleChildrenPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleFooterPartial as ArticleFooterPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleHeaderPartial as ArticleHeaderPartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\ArticleTitlePartial as ArticleTitlePartialContract;
use tiFy\Plugins\ThemeSuite\Contracts\GlobalComposingMetabox as GlobalComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Contracts\ThemeSuite as ThemeSuiteContract;
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
        ThemeSuiteContract::class,
        ArticleBodyPartialContract::class,
        ArticleCardPartialContract::class,
        ArticleChildrenPartialContract::class,
        ArticleFooterPartialContract::class,
        ArticleHeaderPartialContract::class,
        ArticleTitlePartialContract::class,
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
            $this->getContainer()->get(ThemeSuiteContract::class)->boot();
        });
    }

    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->getContainer()->share(ThemeSuiteContract::class, function (): ThemeSuiteContract {
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
        $this->getContainer()->add(ArticleBodyPartialContract::class, function (): ArticleBodyPartialContract {
            return new ArticleBodyPartial(
                $this->getContainer()->get(ThemeSuiteContract::class),
                $this->getContainer()->get(PartialManagerContract::class)
            );
        });

        $this->getContainer()->add(ArticleCardPartialContract::class, function (): ArticleCardPartialContract {
            return new ArticleCardPartial(
                $this->getContainer()->get(ThemeSuiteContract::class),
                $this->getContainer()->get(PartialManagerContract::class)
            );
        });

        $this->getContainer()->add(ArticleChildrenPartialContract::class, function (): ArticleChildrenPartialContract {
            return new ArticleChildrenPartial(
                $this->getContainer()->get(ThemeSuiteContract::class),
                $this->getContainer()->get(PartialManagerContract::class)
            );
        });

        $this->getContainer()->add(ArticleFooterPartialContract::class, function (): ArticleFooterPartialContract {
            return new ArticleFooterPartial(
                $this->getContainer()->get(ThemeSuiteContract::class),
                $this->getContainer()->get(PartialManagerContract::class)
            );
        });

        $this->getContainer()->add(ArticleHeaderPartialContract::class, function (): ArticleHeaderPartialContract {
            return new ArticleHeaderPartial(
                $this->getContainer()->get(ThemeSuiteContract::class),
                $this->getContainer()->get(PartialManagerContract::class)
            );
        });

        $this->getContainer()->add(ArticleTitlePartialContract::class, function (): ArticleTitlePartialContract {
            return new ArticleTitlePartial(
                $this->getContainer()->get(ThemeSuiteContract::class),
                $this->getContainer()->get(PartialManagerContract::class)
            );
        });

        $this->getContainer()->add(NavMenuPartialPartialContract::class, function (): NavMenuPartialPartialContract {
            return new NavMenuPartial(
                $this->getContainer()->get(ThemeSuiteContract::class),
                $this->getContainer()->get(PartialManagerContract::class)
            );
        });
    }

    /**
     * Déclaration de la collection de pilote de metaboxes.
     *
     * @return void
     */
    public function registerMetaboxDrivers(): void
    {
        $this->getContainer()->share(ImageGalleryMetaboxContract::class, function (): ImageGalleryMetaboxContract {
            return (new ImageGalleryMetabox())->setThemeSuite($this->getContainer()->get(ThemeSuiteContract::class));
        });

        $this->getContainer()->share(ArchiveComposingMetaboxContract::class, function () {
            return (new ArchiveMetabox())
                ->setThemeSuite($this->getContainer()->get(ThemeSuiteContract::class))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });

        $this->getContainer()->share(GlobalComposingMetaboxContract::class, function () {
            return (new GlobalMetabox())
                ->setThemeSuite($this->getContainer()->get(ThemeSuiteContract::class))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });

        $this->getContainer()->share(SingularComposingMetaboxContract::class, function () {
            return (new SingularMetabox())
                ->setThemeSuite($this->getContainer()->get(ThemeSuiteContract::class))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });
    }
}