<?php
/**
 * @var tiFy\Contracts\Partial\PartialView $this
 * @var tiFy\Wordpress\Contracts\Query\QueryPost|null $article
 */
?>
<div <?php echo $this->htmlAttrs(); ?>>
    <?php if ($visual = $this->get('visual')) : ?>
        <div class="ArticleHeader-visual">
            <?php echo $visual; ?>
        </div>
    <?php endif; ?>
    <?php if ($title = $this->get('title')) : ?>
        <div class="ArticleHeader-title">
            <?php echo partial('article-title', $title); ?>
        </div>
    <?php endif; ?>
</div>