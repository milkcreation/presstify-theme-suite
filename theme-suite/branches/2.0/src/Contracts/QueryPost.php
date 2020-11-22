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
     * Récupération du titre alternatif.
     *
     * @return string
     */
    public function getAltTitle(): string;

    /**
     * Récupération de la bannière des page de flux.
     *
     * @param array $attrs
     *
     * @return string
     */
    public function getBanner(array $attrs = []): string;

    /**
     * Récupération du slogan.
     *
     * @return string
     */
    public function getBaseline(): string;

    /**
     * Récupération du titre des publications apparentées.
     *
     * @return string
     */
    public function getChildrenTitle(): string;

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
     * Récupération de l'image d'entête.
     *
     * @param array $attrs
     *
     * @return string
     */
    public function getHeader(array $attrs = []): string;

    /**
     * Récupération du titre des éléments associés.
     *
     * @return string
     */
    public function getRelatedTitle(): string;

    /**
     * Récupération d'options de la page de contenu.
     *
     * @param string|null $key Clé d'indice de la valeur à récupérer. Syntaxe à point permise. null pour tous.
     * @param mixed $default Valeur de retour par défaut.
     *
     * @return mixed|ParamsBag
     */
    public function getSingularComposing(?string $key = null, $default = null);

    /**
     * Récupération du sous-titre.
     *
     * @return string
     */
    public function getSubtitle(): string;
}