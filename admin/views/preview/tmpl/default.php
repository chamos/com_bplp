<?php
defined('_JEXEC') or die;
?>

<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
		<div class="clearfix"> </div>

		<div class="mypreview">
			<?php foreach ($this->items as $i => $item) : ?>
				<div class="mybplp">
					<div class="bplp_title">
						<?php echo $item->title; ?>
					</div>

					<div class="bplp_element">
						<a href="<?php echo $item->url; ?>" target="_blank"><img src="../<?php echo $item->image; ?>" width="150"></a>
					</div>
					<div class="bplp_element">
						<strong><?php echo JText::_('COM_BPLP_COMPANY');?></strong><?php echo $item->company; ?>
					</div>
					<div class="bplp_element">
						<strong><?php echo JText::_('COM_BPLP_EDITEUR');?></strong><?php echo $item->phone; ?>
					</div>
					<div class="bplp_element">
						<?php echo $item->description; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</form>