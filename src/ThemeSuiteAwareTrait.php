<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite;

use Exception;
use tiFy\Plugins\ThemeSuite\Contracts\ThemeSuite;

trait ThemeSuiteAwareTrait
{
    /**
     * Instance de l'application.
     * @var ThemeSuite|null
     */
    private $ts;

    /**
     * Récupération de l'instance de l'application.
     *
     * @return ThemeSuite|null
     */
    public function ts(): ?ThemeSuite
    {
        if (is_null($this->ts)) {
            try {
                $this->ts = ThemeSuite::instance();
            } catch (Exception $e) {
                $this->ts;
            }
        }

        return $this->ts;
    }

    /**
     * Définition de l'application.
     *
     * @param ThemeSuite $ts
     *
     * @return static
     */
    public function setThemeSuite(ThemeSuite $ts): self
    {
        $this->ts = $ts;

        return $this;
    }
}