<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 * @var WP_Post $wp_post
 * @var tiFy\Plugins\ThemeSuite\Query\QueryPost $post
 */
?>
<?php if ($this->params('baseline') || $this->params('alt_title') || $this->params('subtitle')) : ?>
    <h3><?php _e('Titres', 'tify'); ?></h3>

    <table class="form-table">
        <?php if ($this->params('baseline')) : ?>
            <?php $this->insert('baseline', $this->all()); ?>
        <?php endif; ?>

        <?php if ($this->params('alt_title')) : ?>
            <?php $this->insert('alt_title', $this->all()); ?>
        <?php endif; ?>

        <?php if ($this->params('subtitle')) : ?>
            <?php $this->insert('subtitle', $this->all()); ?>
        <?php endif; ?>
    </table>
<?php endif; ?>


<?php if ($this->params('thumbnail') && $post->getType()->supports('thumbnail')) : ?>
    <?php $this->insert('thumbnail', $this->all()); ?>
<?php endif; ?>
