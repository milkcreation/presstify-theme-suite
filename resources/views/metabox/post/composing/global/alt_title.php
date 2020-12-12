<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 * @var WP_Post $wp_post
 * @var tiFy\Plugins\ThemeSuite\Query\QueryPost $post
 */
?>
<tr>
    <th><?php _e('Titre alternatif', 'tify'); ?></th>
    <td>
        <?php echo field('text', [
            'attrs' => [
                'class' => 'widefat',
            ],
            'name'  => $this->name() . '[alt_title]',
            'value' => $post->getGlobalComposing('alt_title'),
        ]); ?>
    </td>
</tr>
