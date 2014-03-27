<?php
// No direct access to this file
defined('_JEXEC') or die;
 
/**
 * Lugat component helper.
 */
abstract class LugatHelper
{
	/**
	 * Configure the Linkbar.
	 */
/* 	public static function addSubmenu($submenu) 
	{
		JSubMenuHelper::addEntry(JText::_('COM_LUGAT_SUBMENU_MESSAGES'), 'index.php?option=com_lugat', $submenu == 'messages');
		JSubMenuHelper::addEntry(JText::_('COM_LUGAT_SUBMENU_CATEGORIES'), 'index.php?option=com_categories&view=categories&extension=com_lugat', $submenu == 'categories');
		// set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-lugat {background-image: url(../media/com_lugat/images/tux-48x48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_LUGAT_ADMINISTRATION_CATEGORIES'));
		}
	}
 */

	public static function addSubmenu($vName)
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_LUGAT_DB_RU2TJ'),
			'index.php?option=com_lugat&view=terms',
			$vName == 'ru2tj'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_LUGAT_DB_TJ2RU'),
			'index.php?option=com_lugat&view=lugat',
			$vName == 'categories'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_LUGAT_DB_TJ2EN'),
			'index.php?option=com_lugat&view=lugat',
			$vName == 'clients'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_LUGAT_DB_EN2TJ'),
			'index.php?option=com_lugat&view=lugat',
			$vName == 'tracks'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_LUGAT_DB_RU2UZ'),
			'index.php?option=com_lugat&view=terms',
			$vName == 'tracks'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_LUGAT_NOTFOUND_RU2TJ'),
			'index.php?option=com_lugat&view=lugat',
			$vName == 'ru2tj'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_LUGAT_NOTFOUND_TJ2RU'),
			'index.php?option=com_lugat&view=lugat',
			$vName == 'categories'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_LUGAT_NOTFOUND_TJ2EN'),
			'index.php?option=com_lugat&view=lugat',
			$vName == 'clients'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_LUGAT_NOTFOUND_EN2TJ'),
			'index.php?option=com_lugat&view=notfound&dic=en2tj',
			$vName == 'tracks'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_LUGAT_NOTFOUND_RU2UZ'),
			'index.php?option=com_lugat&view=notfound',
			$vName == 'notfound'
		);
	}


 
 /**
	 * Get the actions
	 */
	public static function getActions($messageId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;
 
		if (empty($messageId)) {
			$assetName = 'com_lugat';
		}
		else {
			$assetName = 'com_lugat.message.'.(int) $messageId;
		}
 
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
		);
 
		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}
 
		return $result;
	}
}
