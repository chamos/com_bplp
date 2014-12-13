<?php defined('_JEXEC') or die; ?>

<div class="mypreview">
	<?php foreach ($this->items as $item) : ?>
		<div class="mybplp">
			<div class="bplp_title">
				<?php echo $item->title; ?>
			</div>
			<div class="bplp_element_full">
				<a href="<?php echo $item->url; ?>" target="_blank" rel="nofollow">
					<img src="<?php echo $item->image; ?>">
				</a>
			</div>
			<div class="bplp_element_full">
				<strong><?php echo JText::_('COM_BPLP_COMPANY');?></strong><?php echo $item->company; ?>
			</div>
			<div class="bplp_element_full">
				<strong><?php echo JText::_('COM_BPLP_EDITEUR');?></strong><?php echo $item->editeur; ?>
			</div>
			<div class="bplp_element_full">
				<?php echo $item->description; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>