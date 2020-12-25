<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 */
?>
<div <?php echo $this->htmlAttrs(); ?>>
    <div class="ImageGalleryMetabox-images">
        <?php $this->insert('images', $this->all()); ?>
    </div>
</div>