<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.pagetitlesuffix
 *
 * @copyright   (C) 2022 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;


/**
 * System plugin that attaches the text from the parameter field to each headline.
 *
 * @since  4.0.0
 */
class PlgSystemPageTitleSuffix extends CMSPlugin
{
    /**
     * Load the language file on instantiation
     * 
     * @var    boolean
     * @since  4.0.0
     */ 
	 

    /**
     * Application object.
     * 
     * @var    JApplicationCms
     * @since  4.0.0
     */
	 
    protected $app;

    /**
     * Constructor.
     *
     * @param   object  &$subject  The object to observe.
     * @param   array   $config    An optional associative array of configuration settings.
     *
     * @since  4.0.0
     */
	
    public function __construct(&$subject, $config)
    {
		$this->loadLanguage('plg_system_pagetitlesuffix');
        parent::__construct($subject, $config);
    }

    /**
     * Listener for the `onBeforeRender` event
     * 
     * @return  void
     *
     * @since   4.0.0
     */
	 
    public function onBeforeRender()
    {
        $app = JFactory::getApplication();
        $isAdmin = $app->isClient('administrator');

        // The feature is only available for administrator side
        if ($isAdmin) {
            $pagetitlesuffix_value = $this->params->get('pagetitlesuffix_value','');
		    HTMLHelper::_('script', 'media/plg_system_pagetitlesuffix/js/page-title-suffix.es6.js', array('version' => 'auto'));
            Factory::getDocument()->addScriptOptions(
                'page-title-suffix',
                array(
                    'pagetitlesuffix_value' => $pagetitlesuffix_value,
                )
            );
            return;
        }
    }
}