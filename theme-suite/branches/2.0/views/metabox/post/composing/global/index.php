<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 * @var WP_Post $wp_post
 * @var tiFy\Plugins\ThemeSuite\Query\QueryPost $post
 */
?>
<h3><?php _e('Titre alternatif', 'theme'); ?></h3>

<table class="form-table">
    <tr>
        <th><?php _e('Titre haut (fin)', 'theme'); ?></th>
        <td>
            <?php echo field('text', [
                'attrs' => [
                    'class' => 'widefat',
                ],
                'name'    => $this->name() .'[alt_top_title]',
                'value'   => $post->getGlobalComposing('alt_top_title')
            ]); ?>
        </td>
    </tr>
    <tr>
        <th><?php _e('Titre bas (gras)', 'theme'); ?></th>
        <td>
            <?php echo field('text', [
                'attrs' => [
                    'class' => 'widefat',
                ],
                'name'    => $this->name() .'[alt_bottom_title]',
                'value'   => $post->getGlobalComposing('alt_bottom_title')
            ]); ?>
        </td>
    </tr>
    <tr>
        <th><?php _e('Image représentative par défaut', 'theme'); ?></th>
        <td>
            <?php echo field('media-image', [
                'width' => 1920,
                'height'=> 1080,
                'name'  => '_thumbnail_id',
                'value' => $post->getMetaSingle('_thumbnail_id', -1),
            ]); ?>
        </td>
    </tr>
</table>