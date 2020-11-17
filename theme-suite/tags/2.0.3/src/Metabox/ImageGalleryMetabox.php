<?php declare(strict_types=1);

namespace tiFy\Plugins\ThemeSuite\Metabox;

use tiFy\Support\Proxy\Partial;

class ImageGalleryMetabox extends AbstractMetaboxDriver
{
    /**
     * @inheritDoc
     */
    public function defaults(): array
    {
        return array_merge(parent::defaults(), [
            'name'  => 'image_gallery',
            'title' => __('Galerie d\'image', 'tify'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function defaultParams(): array
    {
        return [
            'amount'      => 9,
            'by_row'      => 3,
            /** @var array|bool */
            'media-image' => [
                'width'  => 480,
                'height' => 480,
                'size'   => 'thumbnail',
            ],
            /** @var array|bool */
            'caption'     => [
                'attrs' => [
                    'class'       => 'widefat',
                    'placeholder' => __('Légende ...', 'tify'),
                ],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        $amount = (int)$this->params('amount');
        $byRow = (int)$this->params('by_row');

        if (12 % $byRow !== 0) {
            return Partial::get('notice', [
                'type'    => 'warning',
                'content' => __('Le paramètre fourni [by_row] n\'est pas un multiple de 12', 'tify'),
            ])->render();
        }

        $mediaImg = $this->params('media-image');
        $caption = $this->params('caption');
        $col = 12 / $byRow;
        $rows = (int)ceil($amount / $byRow);

        $this->params([
            'media-image' => $mediaImg === false ? false : (is_array($mediaImg) ? $mediaImg : []),
            'caption'     => $caption === false ? false : (is_array($caption) ? $caption : []),
            'col'         => $col,
            'max'         => $amount,
            'rows'        => $rows,
        ]);

        return parent::render();
    }

    /**
     * @inheritDoc
     */
    protected function viewerDirectory(): string
    {
        return $this->ts()->resources('views/metabox/image-gallery');
    }
}