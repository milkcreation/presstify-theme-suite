<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite;

use tiFy\Container\ServiceProvider;
use tiFy\Contracts\Metabox\MetaboxDriver;
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
        'metabox.driver.archive-composing',
        'metabox.driver.global-composing',
        'metabox.driver.singular-composing',
        'metabox.driver.image-gallery'
    ];

    /**
     * @inheritDoc
     */
    public function boot()
    {
        if (($wp = $this->getContainer()->get('wp')) && $wp->is()) {
            add_action('after_setup_theme', function () {
                $this->getContainer()->get('theme-suite')->boot();
            });
        }
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
        $this->getContainer()->add('metabox.driver.image-gallery', function () {
            return (new ImageGalleryMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'));
        });

        $this->getContainer()->add('metabox.driver.archive-composing', function () {
            return (new ArchiveMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });

        $this->getContainer()->add('metabox.driver.global-composing', function () {
            return (new GlobalMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });

        $this->getContainer()->add('metabox.driver.singular-composing', function () {
            return (new SingularMetabox())->setThemeSuite($this->getContainer()->get('theme-suite'))
                ->setHandler(function (MetaboxDriver $box, WP_Post $wp_post) {
                    $box->set('post', post::create($wp_post));
                });
        });
    }
}