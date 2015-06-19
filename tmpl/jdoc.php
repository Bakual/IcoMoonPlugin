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

if ($style)
{
	JFactory::getDocument()->addStyleDeclaration($style);
}
?>
<?php if ($this->params->get('header')) : ?>
	<h4 class="icomoon-header"><?php echo JText::sprintf('PLG_CONTENT_ICOMOON_HEADER', count($items), $cClasses); ?></h4>
<?php endif; ?>
<!-- Start JDocs Output -->
<div class="icomoon-list">
<?php foreach ($items as $item) : ?>
<div class="small-4 columns"><span class="icon-<?php echo $item[0]; ?>">&nbsp;</span> <?php
foreach ($item as $i => $class)
{
	echo $class;
	echo ($i+1 < count($item)) ? ' / ' : '';
}
?></div>
<?php endforeach; ?>
</div>
<!-- End JDocs Output -->