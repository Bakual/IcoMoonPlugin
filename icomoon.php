<?php
/**
 * @package     SermonSpeaker
 * @subpackage  Plugin.Icomoon
 * @author      Thomas Hunziker <admin@bakual.net>
 * @copyright   (C) 2015 - Thomas Hunziker
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

/**
 * Plug-in to show a a list of available IcoMoon icons in an article
 * This uses the {icomoon} syntax
 *
 * @since  1.0
 */
class PlgContentIcomoon extends JPlugin
{
	/**
	 * Plugin that shows a Icon list
	 *
	 * @param   string  $context   The context of the content being passed to the plugin.
	 * @param   object  &$article  The article object.  Note $article->text is also available
	 * @param   object  &$params   The article params
	 * @param   int     $page      The 'page' number
	 *
	 * @return void
	 */
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// Don't run if there is no text property (in case of bad calls) or it is empty
		if (empty($article->text))
		{
			return;
		}

		// Simple performance check to determine whether bot should process further
		if (strpos($article->text, 'icomoon') === false)
		{
			return;
		}

		// Expression to search for (positions)
		$regex = '/{icomoon}/i';

		preg_match_all($regex, $article->text, $matches, PREG_SET_ORDER);

		if (!$matches)
		{
			return;
		}

		$lessFile = JPATH_SITE . '/media/jui/less/icomoon.less';

		// Check if .less file exists and is readable
		if (!is_readable($lessFile))
		{
			return;
		}

		// Load file into an array
		$lessArray = file($lessFile);
		$classes   = array();
		$items     = array();
		$cClasses  = 0;

		foreach ($lessArray as $i => $line)
		{
			// Line starts with "icon-"
			if (strpos($line, '.icon-') === 0)
			{
				$class     = explode(':', $line);
				$classes[] = substr($class[0], 6);
				$cClasses++;
			}

			if ($classes && (strpos($line, 'content:') !== false))
			{
				$items[] = $classes;
				$classes = array();
			}
		}

		// Nothing found
		if (!$items)
		{
			return;
		}

		$this->loadLanguage();

		// Get the path for the layout file
		$path = JPluginHelper::getLayoutPath('content', 'icomoon', $this->params->get('layout', 'default'));

		// Render the output
		ob_start();
		include $path;
		$output = ob_get_clean();

		// Replace the tag with the content
		foreach ($matches as $i => $match)
		{
			$article->text = str_replace($match[0], $output, $article->text);
		}
	}
}
