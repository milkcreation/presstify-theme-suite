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
                'baseline' => true,
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
    public function getAltBottomTitle(): string
    {
        return $this->getGlobalComposing('alt_bottom_title', '') ?: $this->getTitle();
    }

    /**
     * @inheritDoc
     */
    public function getAltTopTitle(): string
    {
        return $this->getGlobalComposing('alt_top_title', '');
    }

    /**
     * @inheritDoc
     */
    public function getBannerImg(array $attrs = []): string
    {
        if (!$id = $this->getArchiveComposing('banner_img', 0)) {
            return $this->getThumbnail('composing-banner', $attrs);
        } elseif ($img = wp_get_attachment_image($id, 'composing-banner', false, $attrs)) {
            return $img;
        }

        return '';
    }

    /**
     * @inheritDoc
     */
    public function getBaseline(): string
    {
        return $this->getSingularComposing('baseline', '');
    }

    /**
     * @inheritDoc
     */
    public function getChildrenBottomTitle(): string
    {
        return $this->getSingularComposing('children_bottom_title', '') ?: $this->getTitle();
    }

    /**
     * @inheritDoc
     */
    public function getChildrenTopTitle(): string
    {
        return $this->getSingularComposing('children_top_title', '') ?: __('En relation avec', 'tify');
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
    public function getHeaderImg(array $attrs = []): string
    {
        if (!$id = $this->getSingularComposing('header_img', 0)) {
            return $this->getThumbnail('composing-header', $attrs);
        } elseif ($img = wp_get_attachment_image($id, 'composing-header', false, $attrs)) {
            return $img;
        }

        return '';
    }

    /**
     * @inheritDoc
     */
    public function getRelatedBottomTitle(): string
    {
        return $this->getSingularComposing('related_bottom_title', '') ?: '';
    }

    /**
     * @inheritDoc
     */
    public function getRelatedTopTitle(): string
    {
        return $this->getSingularComposing('related_top_title', '') ?: '';
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
                'baseline' => true,
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
     * @inheritDoc
     */
    public function getSubtitle(): string
    {
        return $this->getSingularComposing('subtitle', '');
    }
}