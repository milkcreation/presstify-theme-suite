<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite;

use tiFy\Container\ServiceProvider;

class ThemeSuiteServiceProvider extends ServiceProvider
{
    /**
     * Liste des noms de qualification des services fournis.
     * @internal requis. Tous les noms de qualification de services à traiter doivent être renseignés.
     * @var string[]
     */
    protected $provides = [
        'theme-suite',
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
    }
}