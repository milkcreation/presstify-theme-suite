<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 * @var WP_Post $wp_post
 * @var tiFy\Plugins\ThemeSuite\Query\QueryPost $post
 */
?>
<?php if ($this->params('header')) : ?>
    <?php $this->insert('header', $this->all()); ?>
<?php endif; ?>

<?php if ($this->params('children') && $post->getType()->hierarchical) : ?>
    <?php $this->insert('children', $this->all()); ?>

    <?php if ($this->params('children_title')) : ?>
        <?php $this->insert('children_title', $this->all()); ?>
    <?php endif; ?>
<?php endif;