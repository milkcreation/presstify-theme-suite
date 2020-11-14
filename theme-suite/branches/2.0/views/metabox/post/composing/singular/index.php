<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 * @var WP_Post $wp_post
 * @var tiFy\Plugins\ThemeSuite\Query\QueryPost $post
 */
?>
    <table class="form-table">
        <tr>
            <th><?php _e('Activation de la bannière d\'entête', 'theme'); ?></th>
            <td>
                <?php echo field('toggle-switch', [
                    'attrs' => [
                        'id'          => 'SingleHeader-switcher',
                        'data-target' => '#SingleHeader-customizer',
                    ],
                    'name'  => $this->name() . '[enabled][header]',
                    'value' => $post->getSingularComposing('enabled.header') ? 'on' : 'off',
                ]); ?>
            </td>
        </tr>
        <tr id="SingleHeader-customizer">
            <th>
                <label style="display:block;"><?php _e('Image d\'entête personnalisé', 'theme'); ?></label>
                <i style="font-weight:normal;font-size:0.9em;color:#999;line-height:1;">
                    <?php _e('Utilise l\'image représentative par défaut de l\'onglet [Général]', 'theme'); ?>
                </i>
            </th>
            <td>
                <?php echo field('media-image', [
                    'default' => $post->getMetaSingle('_thumbnail_id'),
                    'size'    => 'banner',
                    'width'   => 1920,
                    'height'  => 1080,
                    'name'    => $this->name() . '[header_img]',
                    'value'   => $post->getSingularComposing('header_img'),
                ]); ?>
            </td>
        </tr>
    </table>

<?php if ($post->getType()->hierarchical) : ?>
    <h3><?php _e('Liste des publications apparentés', 'theme'); ?></h3>
    <table class="form-table">
        <tr>
            <th><?php _e('Activation de l\'affichage', 'theme'); ?></th>
            <td>
                <?php echo field('toggle-switch', [
                    'name'  => $this->name() . '[enabled][children]',
                    'value' => $post->getSingularComposing('enabled.children') ? 'on' : 'off',
                ]); ?>
            </td>
        </tr>
        <tr>
            <th><?php _e('Titre haut (requis) *', 'theme'); ?></th>
            <td>
                <?php echo field('text', [
                    'attrs' => [
                        'class'       => 'widefat',
                        'placeholder' => __('Texte par défaut : En relation avec', 'theme'),
                    ],
                    'name'  => $this->name() . '[children_top_title]',
                    'value' => $post->getSingularComposing('children_top_title'),
                ]); ?>
            </td>
        </tr>
        <tr>
            <th><?php _e('Titre bas (requis) *', 'theme'); ?></th>
            <td>
                <?php echo field('text', [
                    'attrs' => [
                        'class'       => 'widefat',
                        'placeholder' => __('Texte par défaut : {{ Titre de la page }}', 'theme'),
                    ],
                    'name'  => $this->name() . '[children_bottom_title]',
                    'value' => $post->getSingularComposing('children_bottom_title'),
                ]); ?>
            </td>
        </tr>
    </table>
<?php endif;