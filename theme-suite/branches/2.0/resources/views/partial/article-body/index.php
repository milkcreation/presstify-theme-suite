<?php
/**
 * @var tiFy\Contracts\Partial\PartialView $this
 * @var tiFy\Wordpress\Contracts\Query\QueryPost|null $article
 */
?>
<article <?php echo $this->htmlAttrs(); ?>>
    <?php if ($content = $this->get('content', '')) : ?>
        <div class="ArticleBody-content"><?php echo $content; ?></div>
    <?php endif; ?>
</article>