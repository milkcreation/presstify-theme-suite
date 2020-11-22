<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite;

use tiFy\Container\ServiceProvider;
use tiFy\Contracts\Metabox\MetaboxDriver;
use tiFy\Plugins\ThemeSuite\Contracts\ArchiveComposingMetabox as ArchiveComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Contracts\GlobalComposingMetabox as GlobalComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Contracts\ImageGalleryMetabox as ImageGalleryMetaboxContract;
use tiFy\Plugins\ThemeSuite\Contracts\SingularComposingMetabox as SingularComposingMetaboxContract;
use tiFy\Plugins\ThemeSuite\Metabox\ImageGalleryMetabox;
use tiFy\Plugins\ThemeSuite\Metabox\Post\Composing\ArchiveMetabox;
use tiFy\Plugins\ThemeSuite\Metabox\Post\Composing\GlobalMetabox;
use tiFy\Plugins\ThemeSuite\Metabox\Post\Composing\SingularMetabox;
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
        ArchiveComposingMetaboxContract::class,
        GlobalComposingMetaboxContract::class,
        ImageGalleryMetaboxContract::class,
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

        $this->registerMetaboxDrivers();
    }

    /**
     * Déclaration de la collection de pilote d'affichage.
     *
     * @return void
     */
    public function registerMetaboxDrivers(): void
    {
        $this->getContainer()->add(ImageGalleryMetaboxContract::class, function () {
            return (new ImageGalleryMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'));
        });

        $this->getContainer()->add(ArchiveComposingMetaboxContract::class, function () {
            return (new ArchiveMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });

        $this->getContainer()->add(GlobalComposingMetaboxContract::class, function () {
            return (new GlobalMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });

        $this->getContainer()->add(SingularComposingMetaboxContract::class, function () {
            return (new SingularMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });
    }
}