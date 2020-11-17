<?php
/**
 * @var tiFy\Contracts\Metabox\MetaboxView $this
 */
?>
<h3><?php _e('Images', 'tify'); ?></h3>
<div class="ThemeContainer" style="padding:0; overflow:hidden;">
    <?php $i = 0; ?>
    <?php foreach (range(1, $this->params('rows')) as $r) : ?>
        <div class="ThemeRow">
            <?php foreach (range(1, $this->params('by_row')) as $c) : ?>
                <?php if (++$i > $this->params('max')) {
                    continue;
                } ?>
                <div class="ThemeCol-<?php echo $this->params('col'); ?>">
                    <div class="ImageGalleryMetabox-image">
                        <?php if ($mediaImg = $this->params('media-image', [])) : ?>
                            <div class="ImageGalleryMetabox-imagePreview">
                                <?php echo field('media-image', array_merge($mediaImg, [
                                    'name'  => $this->name() . "[img][{$i}]",
                                    'value' => $this->value("img.{$i}"),
                                ])); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($caption = $this->params('caption', [])) : ?>
                            <div class="ImageGalleryMetabox-imageCaption">
                                <?php echo field('text', array_merge($caption, [
                                    'name'  => $this->name() . "[caption][{$i}]",
                                    'value' => $this->value("caption.{$i}"),
                                ])); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>