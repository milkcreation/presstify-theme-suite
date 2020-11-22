<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 * @var WP_Post $wp_post
 * @var tiFy\Plugins\ThemeSuite\Query\QueryPost $post
 */
?>
<tr>
    <th><?php _e('Sous-titre', 'tify'); ?></th>
    <td>
        <?php echo field('text', [
            'attrs' => [
                'class' => 'widefat',
            ],
            'name'  => $this->name() . '[subtitle]',
            'value' => $post->getGlobalComposing('subtitle'),
        ]); ?>
    </td>
</tr>
