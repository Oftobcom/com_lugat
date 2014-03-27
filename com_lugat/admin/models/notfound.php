<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * Terms Model
 */
class LugatModelNotfound extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		$dic = JRequest::getVar('dic','ru2uz');
		// Create a new query object.		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select terms and their counts
		$query->select('term, _count');
		// From the specified view
		$view_name = 'v_notfound_'.$dic;
		$query->from($view_name);
		// Descending order by _count 
		$query->order('_count DESC, term');
		return $query;
	}
}
