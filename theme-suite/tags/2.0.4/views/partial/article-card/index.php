<?php
/**
 * @var tiFy\Contracts\Partial\PartialView $this
 * @var tiFy\Wordpress\Contracts\Query\QueryPost $article
 */
?>
<article <?php echo $this->htmlAttrs(); ?>>
    <header class="ArticleCardHeader">
        <a href="<?php echo $article->getPermalink(); ?>"
           title="<?php printf($this->get('readmore.title', __('Consulter %s', 'tify')), $article->getTitle()); ?>">
            <?php if ($this->get('enabled.thumb')) : ?>
                <figure class="ArticleCard-thumb">
                    <?php if ($img = $article->getThumbnail('banner', ['class' => 'ArticleCard-thumbImg'])) : ?>
                        <?php echo $img; ?>
                    <?php elseif ($holder = $this->get('holder')) : ?>
                        <?php echo $holder; ?>
                    <?php endif; ?>
                </figure>
            <?php endif; ?>

            <?php if ($this->get('enabled.title')) : ?>
                <h3 class="ArticleCard-title"><?php echo $article->getTitle(); ?></h3>
            <?php endif; ?>
        </a>
    </header>

    <main class="ArticleCardBody">
        <?php if ($this->get('enabled.excerpt')) : ?>
            <div class="ArticleCard-excerpt"><?php echo $article->getExcerpt(); ?></div>
        <?php endif; ?>
    </main>

    <footer class="ArticleCardFooter">
        <?php if ($this->get('enabled.readmore') && ($this->get('readmore') !== false)) : ?>
            <div class="ArticleCard-readmore">
                <?php echo $this->get('readmore'); ?>
            </div>
        <?php endif; ?>
    </footer>
</article>