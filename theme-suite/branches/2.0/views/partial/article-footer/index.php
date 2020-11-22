<?php
/**
 * @var tiFy\Contracts\Partial\PartialView $this
 * @var tiFy\Wordpress\Contracts\Query\QueryPost|null $article
 */
?>
<?php if ($this->get('enabled', false)) : ?>
    <div <?php echo $this->htmlAttrs(); ?>>
        <?php if ($this->get('content') !== false) : ?>
            <div class="ArticleFooter-content">
                <?php echo $this->get('content'); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif;