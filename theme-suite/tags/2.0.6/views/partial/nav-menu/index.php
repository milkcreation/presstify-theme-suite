<?php
/**
 * @var tiFy\Contracts\Partial\PartialView $this
 */
?>
<nav <?php echo $this->htmlAttrs(); ?>>
    <ul class="NavMenu-items">
        <?php foreach ($this->get('items') as $item) : ?>
            <?php echo partial('tag', $item); ?>
        <?php endforeach; ?>
    </ul>
</nav>