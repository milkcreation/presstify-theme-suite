<?php
/**
 * @var tiFy\Contracts\Partial\PartialView $this
 * @var tiFy\Wordpress\Contracts\Query\QueryPost $article
 */
?>
<article <?php echo $this->htmlAttrs(); ?>>
    <?php if ($this->get('enabled.thumb')) : ?>
        <figure class="ArticleCard-thumb">
            <?php if ($img = $article->getThumbnail('thumbnail', ['class' => 'ArticleCard-thumbImg'])) : ?>
                <?php echo $img; ?>
            <?php else : ?>
                <?php echo partial('holder', [
                    'attrs'  => [
                        'class' => 'ArticleCard-thumbImg',
                    ],
                    'height' => 150,
                    'width'  => 150,
                ]); ?>
            <?php endif; ?>
        </figure>
    <?php endif; ?>

    <?php if ($this->get('enabled.title')) : ?>
        <h3 class="ArticleCard-title"><?php echo $article->getTitle(); ?></h3>
    <?php endif; ?>

    <?php if ($this->get('enabled.excerpt')) : ?>
        <div class="ArticleCard-excerpt"><?php echo $article->getExcerpt(); ?></div>
    <?php endif; ?>

    <?php if ($this->get('enabled.readmore')) : ?>
        <a href="<?php echo $article->getPermalink(); ?>"
           class="ArticleCard-readmore Button--1"
           title="<?php printf($this->get('readmore.title', __('Consulter %s', 'tify')), $article->getTitle()); ?>"
        ><?php echo $this->get('readmore.txt', __('Lire la suite', 'tify')) ?></a>
    <?php endif; ?>
</article>