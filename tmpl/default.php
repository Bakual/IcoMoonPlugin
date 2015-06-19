<?php
/**
 * @package     Bakual.Plugin
 * @subpackage  Content.Icomoon
 *
 * @copyright   Bakual.net
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$columns = $this->params->get('columns', 4, 'int');
$style   = $this->params->get('style');
$column  = 0;

if ($style)
{
	JFactory::getDocument()->addStyleDeclaration($style);
}
?>
<?php if ($this->params->get('header')) : ?>
	<h4 class="icomoon-header"><?php echo JText::sprintf('PLG_CONTENT_ICOMOON_HEADER', count($items), $cClasses); ?></h4>
<?php endif; ?>
<div class="icomoon-list">
	<div class="row-fluid">
		<?php foreach ($items as $item) : ?>
			<?php $column++; ?>
			<div class="icomoon-item span<?php echo 12/$columns; ?>">
				<span class="icon-<?php echo $item[0]; ?>"> </span>
				<ul class="unstyled">
					<?php foreach ($item as $class) : ?>
						<li><?php echo $class; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php if ($column == $columns) : ?>
				</div>
				<div class="row-fluid">
				<?php $column = 0; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
