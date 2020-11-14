<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Query;

use tiFy\Support\ParamsBag;
use tiFy\Plugins\ThemeSuite\Contracts\QueryPost as QueryPostContract;
use tiFy\Wordpress\Query\QueryPost as BaseQueryPost;

class QueryPost extends BaseQueryPost implements QueryPostContract
{
    /**
     * Instance des paramètres d'affichage des pages de flux.
     * @var ParamsBag|null
     */
    protected $archiveComposing;

    /**
     * Clé de qualification de la composition des pages de flux.
     * @var string
     */
    protected $archiveComposingKey = '_archive_composing';

    /**
     * Instance des paramètres d'affichage généraux.
     * @var ParamsBag|null
     */
    protected $globalComposing;

    /**
     * Clé de qualification de la composition générale.
     * @var string
     */
    protected $globalComposingKey = '_global_composing';

    /**
     * Instance des paramètres d'affichage de la page de contenu.
     * @var ParamsBag|null
     */
    protected $singularComposing;

    /**
     * Clé de qualification de la composition d'une page de contenu.
     * @var string
     */
    protected $singularComposingKey = '_singular_composing';

    /**
     * Paramètres par défaut des pages de contenu.
     * @var array
     */
    protected $defaultsArchiveComposing = [];

    /**
     * Paramètres par défaut généraux.
     * @var array
     */
    protected $defaultsGlobalComposing = [];

    /**
     * Paramètres par défaut des pages de contenu.
     * @var array
     */
    protected $defaultsSingularComposing = [];

    /**
     * @inheritDoc
     */
    public function getArchiveComposing(?string $key = null, $default = null)
    {
        if (is_null($this->archiveComposing)) {
            $params = array_merge(
                $this->defaultsArchiveComposing, $this->getMetaSingle($this->archiveComposingKey, [])
            );

            $enabled = array_merge([
                'adjust'   => false,
                'banner'   => true,
                'date'     => false,
                'excerpt'  => true,
                'readmore' => true,
                'subtitle' => true,
                'title'    => true,
            ], $params['enabled'] ?? []);
            array_walk($enabled, function (&$opt) {
                $opt = filter_var($opt, FILTER_VALIDATE_BOOLEAN);
            });
            $params['enabled'] = $enabled;

            $this->archiveComposing = (new ParamsBag())->set($params);
        }

        return is_null($key) ? $this->archiveComposing : $this->archiveComposing->get($key, $default);
    }

    /**
     * @inheritDoc
     */
    public function getGlobalComposing(?string $key = null, $default = null)
    {
        if (is_null($this->globalComposing)) {
            $params = array_merge($this->defaultsGlobalComposing, $this->getMetaSingle($this->globalComposingKey, []));

            $enabled = $params['enabled'] ?? [];
            array_walk($enabled, function (&$opt) {
                $opt = filter_var($opt, FILTER_VALIDATE_BOOLEAN);
            });
            $params['enabled'] = $enabled;

            $this->globalComposing = (new ParamsBag())->set($params);
        }

        return is_null($key) ? $this->globalComposing : $this->globalComposing->get($key, $default);
    }

    /**
     * @inheritDoc
     */
    public function getSingularComposing(?string $key = null, $default = null)
    {
        if (is_null($this->singularComposing)) {
            $params = array_merge(
                $this->defaultsSingularComposing, $this->getMetaSingle($this->singularComposingKey, [])
            );

            $enabled = array_merge([
                'children' => true,
                'content'  => true,
                'date'     => false,
                'subtitle' => true,
                'title'    => true,
                'header'   => false,
            ], $params['enabled'] ?? []);
            array_walk($enabled, function (&$opt) {
                $opt = filter_var($opt, FILTER_VALIDATE_BOOLEAN);
            });
            $params['enabled'] = $enabled;

            $this->singularComposing = (new ParamsBag())->set($params);
        }

        return is_null($key) ? $this->singularComposing : $this->singularComposing->get($key, $default);
    }

    /**
     * Récupération du titre alternatif bas.
     *
     * @return string
     */
    public function getAltBottomTitle(): string
    {
        return $this->getGlobalComposing('alt_bottom_title', '') ?: $this->getTitle();
    }

    /**
     * Récupération du titre alternatif haut.
     *
     * @return string
     */
    public function getAltTopTitle(): string
    {
        return $this->getGlobalComposing('alt_top_title', '');
    }

    /**
     * Récupération de la bannière des page de flux.
     *
     * @param array $attrs
     *
     * @return string
     */
    public function getBannerImg(array $attrs = []): string
    {
        if (!$id = $this->getArchiveComposing('banner_img', 0)) {
            return $this->getThumbnail('banner', $attrs);
        } elseif ($img = wp_get_attachment_image($id, 'banner', false, $attrs)) {
            return $img;
        }

        return '';
    }

    /**
     * Récupération du titre bas des publications apparentées.
     *
     * @return string
     */
    public function getChildrenBottomTitle(): string
    {
        return $this->getSingularComposing('children_bottom_title', '') ?: $this->getTitle();
    }

    /**
     * Récupération du titre haut des publications apparentées.
     *
     * @return string
     */
    public function getChildrenTopTitle(): string
    {
        return $this->getSingularComposing('children_top_title', '') ?: __('En relation avec', 'theme');
    }

    /**
     * Récupération de l'image d'entête.
     *
     * @param array $attrs
     *
     * @return string
     */
    public function getHeaderImg(array $attrs = []): string
    {
        if (!$id = $this->getSingularComposing('header_img', 0)) {
            return $this->getThumbnail('header', $attrs);
        } elseif ($img = wp_get_attachment_image($id, 'header', false, $attrs)) {
            return $img;
        }

        return '';
    }

    /**
     * Récupération du title bas des éléments de flux associés.
     *
     * @return string
     */
    public function getRelatedBottomTitle(): string
    {
        return $this->getSingularComposing('related_bottom_title', '') ?: '';
    }

    /**
     * Récupération du title haut des élément de flux associés.
     *
     * @return string
     */
    public function getRelatedTopTitle(): string
    {
        return $this->getSingularComposing('related_top_title', '') ?: '';
    }
}