<?php
defined('_JEXEC') or die;

$width=$this->params->get('targetwidth');
$height=$this->params->get('targetheight');
$imagewidth=$this->params->get('imagewidth');
?>

<div class="mypreview">
	<?php foreach ($this->items as $item) : ?>
		<div class="mybplp">
			<div class="bplp_title">
				<a href="<?php echo JRoute::_('index.php?option=com_bplp&view=livre&id='.(int)$item->id); ?>"><?php echo $item->title; ?></a>
			</div>
			<div class="bplp_element">
				<?php switch ($this->params->get('target'))
				{
					case 1:
						// open in a new window
						echo '<a href="'. $item->url .'" target="_blank" rel="nofollow">'.
							'<img src="'. $item->image .'" width="'.$imagewidth.'"></a>';
						break;

					case 2:
						// open in a popup window
						$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width='.$this->escape($width).',height='.$this->escape($height).'';
						echo "<a href=\"$item->url\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">".
							'<img src="'. $item->image .'" width="'.$imagewidth.'"></a>';
						break;
					case 3:
						// open in a modal window
						JHtml::_('behavior.modal', 'a.modal'); ?>
						<a class="modal" href="<?php echo $item->url;?>"  rel="{handler: 'iframe', size: {x:<?php echo $this->escape($width);?>, y:<?php echo $this->escape($height);?>}}">
							<img src="<?php echo $item->image; ?>" width="<?php echo $imagewidth; ?>"></a>
						<?php
						break;

					default:
						// open in parent window
						echo '<a href="'.  $item->url . '" rel="nofollow">'.
							'<img src="'. $item->image .'" width="'.$imagewidth.'"></a>';
						break;
				}
				?>
			</div>
			<div class="bplp_element">
				<strong><?php echo JText::_('COM_BPLP_COMPANY');?></strong><?php echo $item->company; ?>
			</div>
			<div class="bplp_element">
				<strong><?php echo JText::_('COM_BPLP_EDITEUR');?></strong><?php echo $item->editeur; ?>
			</div>
			<div class="bplp_element">
				<?php echo $item->description; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>