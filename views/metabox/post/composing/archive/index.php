<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 * @var WP_Post $wp_post
 * @var tiFy\Plugins\ThemeSuite\Query\QueryPost $post
 */
?>
<?php if ($this->params('banner')) : ?>
    <?php $this->insert('banner', $this->all()); ?>
<?php endif; ?>

<?php if ($this->params('banner_format')) : ?>
    <?php $this->insert('banner_format', $this->all()); ?>
<?php endif; ?>

<?php if ($this->params('excerpt')) : ?>
    <?php $this->insert('excerpt', $this->all()); ?>
<?php endif; ?>