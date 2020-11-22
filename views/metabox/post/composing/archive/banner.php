<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 * @var WP_Post $wp_post
 * @var tiFy\Plugins\ThemeSuite\Query\QueryPost $post
 */
?>
<table class="form-table">
    <tr>
        <th>
            <label style="display:block;"><?php _e('Bannière personnalisée', 'tify'); ?></label>
            <i style="font-weight:normal;font-size:0.9em;color:#999;line-height:1;">
                <?php _e('Utilise l\'image représentative par défaut de l\'onglet [Général]', 'tify'); ?>
            </i>
        </th>
        <td>
            <?php echo field('media-image', [
                'attrs'   => [
                    'id' => 'ArchiveBannerAdjust-img',
                ],
                'default' => $post->getMetaSingle('_thumbnail_id'),
                'format'  => $post->getArchiveComposing('enabled.banner_format') ? 'contain' : 'cover',
                'width'   => 640,
                'height'  => 360,
                'size'    => 'composing-banner',
                'name'    => $this->name() . '[banner_img]',
                'value'   => $post->getArchiveComposing('banner_img'),
            ]); ?>
        </td>
    </tr>
</table>
