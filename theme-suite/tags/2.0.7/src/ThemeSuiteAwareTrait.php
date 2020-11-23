<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite;

use Exception;
use tiFy\Plugins\ThemeSuite\Contracts\ThemeSuite as ThemeSuiteContact;

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
     * @param ThemeSuiteContact $ts
     *
     * @return static
     */
    public function setThemeSuite(ThemeSuiteContact $ts): self
    {
        $this->ts = $ts;

        return $this;
    }
}