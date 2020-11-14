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
            <label style="display:block;"><?php _e('Bannière personnalisée', 'theme'); ?></label>
            <i style="font-weight:normal;font-size:0.9em;color:#999;line-height:1;">
                <?php _e('Utilise l\'image représentative par défaut de l\'onglet [Général]', 'theme'); ?>
            </i>
        </th>
        <td>
            <?php echo field('media-image', [
                'attrs'   => [
                    'id' => 'ArchiveBannerAdjust-img'
                ],
                'default' => $post->getMetaSingle('_thumbnail_id'),
                'format'  => $post->getArchiveComposing('enabled.adjust') ? 'contain' : 'cover',
                'width'   => 640,
                'height'  => 360,
                'name'    => $this->name() .'[banner_img]',
                'value'   => $post->getArchiveComposing('banner_img'),
            ]); ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php _e('Ajuster l\'image', 'theme'); ?>

        </th>
        <td>
            <?php echo field('toggle-switch', [
                'attrs' => [
                    'id'          => 'ArchiveBannerAdjust-switcher',
                    'data-target' => '#ArchiveBannerAdjust-img',
                ],
                'name'  => $this->name() . '[enabled][adjust]',
                'value' => $post->getArchiveComposing('enabled.adjust') ? 'on' : 'off',
            ]); ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php _e('Extrait', 'theme'); ?>
        </th>
        <td>
            <?php echo field('text-remaining', [
                'name'  => 'excerpt',
                'value' => nl2br($post->get('post_excerpt', '')),
            ]); ?>
        </td>
    </tr>
</table>