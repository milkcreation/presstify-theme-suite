<?php
/**
 * @var tiFy\Contracts\Partial\PartialView $this
 * @var tiFy\Wordpress\Contracts\Query\QueryPost|null $article
 */
?>
<<?php echo $this->get('tag', 'h1'); ?> <?php echo $this->htmlAttrs(); ?>>
    <?php if ($title = $this->get('title')) : ?>
        <span class="ArticleTitle--primary"><?php echo $title; ?></span>
    <?php endif; ?>
    <?php if ($subtitle = $this->get('subtitle')) : ?>
        <span class="ArticleTitle--secondary"><?php echo $subtitle; ?></span>
    <?php endif; ?>
</<?php echo $this->get('tag', 'h1'); ?>>