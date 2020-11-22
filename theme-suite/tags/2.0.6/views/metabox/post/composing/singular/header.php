<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 * @var WP_Post $wp_post
 * @var tiFy\Plugins\ThemeSuite\Query\QueryPost $post
 */
?>
<table class="form-table">
    <tr>
        <th><?php _e('Activation de la bannière d\'entête', 'tify'); ?></th>
        <td>
            <?php echo field('toggle-switch', [
                'attrs' => [
                    'id'          => 'SingularHeader-switcher',
                    'data-target' => '#SingularHeader-customizer',
                ],
                'name'  => $this->name() . '[enabled][header]',
                'value' => $post->getSingularComposing('enabled.header') ? 'on' : 'off',
            ]); ?>
        </td>
    </tr>
    <tr id="SingularHeader-customizer">
        <th>
            <label style="display:block;"><?php _e('Image d\'entête personnalisé', 'tify'); ?></label>
            <i style="font-weight:normal;font-size:0.9em;color:#999;line-height:1;">
                <?php _e('Utilise l\'image représentative par défaut de l\'onglet [Général]', 'tify'); ?>
            </i>
        </th>
        <td>
            <?php echo field('media-image', [
                'default' => $post->getMetaSingle('_thumbnail_id'),
                'size'    => 'composing-header',
                'width'   => 1920,
                'height'  => 1080,
                'name'    => $this->name() . '[header_img]',
                'value'   => $post->getSingularComposing('header_img'),
            ]); ?>
        </td>
    </tr>
</table>
