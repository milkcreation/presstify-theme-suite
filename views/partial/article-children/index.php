<?php
/**
 * @var tiFy\Contracts\Partial\PartialView $this
 * @var tiFy\Wordpress\Contracts\Query\QueryPost|null $article
 */
?>
<div <?php echo $this->htmlAttrs(); ?>>
    <?php if ($title = $this->get('title')) : ?>
        <h2 class="ArticleChildren-title"><?php echo $title; ?></h2>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($this->get('items') as $post) : ?>
            <div class="col-4">
                <?php echo partial('article-card', compact('post')); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>