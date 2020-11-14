<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Contracts;

use tiFy\Contracts\Support\ParamsBag;
use tiFy\Wordpress\Contracts\Query\QueryPost as BaseQueryPost;

interface QueryPost extends BaseQueryPost
{
    /**
     * Récupération d'options d'affichage des pages de flux.
     *
     * @param string|null $key Clé d'indice de la valeur à récupérer. Syntaxe à point permise. null pour tous.
     * @param mixed $default Valeur de retour par défaut.
     *
     * @return mixed|ParamsBag
     */
    public function getArchiveComposing(?string $key = null, $default = null);

    /**
     * Récupération d'options d'affichage généraux.
     *
     * @param string|null $key Clé d'indice de la valeur à récupérer. Syntaxe à point permise. null pour tous.
     * @param mixed $default Valeur de retour par défaut.
     *
     * @return mixed|ParamsBag
     */
    public function getGlobalComposing(?string $key = null, $default = null);

    /**
     * Récupération d'options de la page de contenu.
     *
     * @param string|null $key Clé d'indice de la valeur à récupérer. Syntaxe à point permise. null pour tous.
     * @param mixed $default Valeur de retour par défaut.
     *
     * @return mixed|ParamsBag
     */
    public function getSingularComposing(?string $key = null, $default = null);
}