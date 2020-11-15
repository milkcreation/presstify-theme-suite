<?php
/**
 * @var tiFy\Contracts\Partial\PartialView $this
 * @var tiFy\Wordpress\Contracts\Query\QueryPost|null $article
 */
?>
<div <?php echo $this->htmlAttrs(); ?>>
    <?php echo $this->get('content'); ?>
</div>