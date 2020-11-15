<?php
/**
 * @var tiFy\Contracts\Partial\PartialView $this
 * @var tiFy\Wordpress\Contracts\Query\QueryPost|null $article
 */
?>
<div <?php echo $this->htmlAttrs(); ?>>
    <?php if ($this->get('content') !== false) : ?>
        <div class="ArticleHeader-content">
            <?php echo $this->get('content'); ?>
        </div>
    <?php endif;?>

    <?php if ($this->get('title') !== false) : ?>
        <div class="ArticleHeader-title">
            <?php echo partial('article-title', $this->get('title')); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->get('breadcrumb') !== false) : ?>
        <div class="ArticleHeader-breadcrumb">
            <?php echo partial('breadcrumb', $this->get('breadcrumb')); ?>
        </div>
    <?php endif; ?>
</div>