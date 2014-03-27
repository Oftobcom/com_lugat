<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * Term Form Field class for the Lugat component
 */
class JFormFieldTerm extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'Term';
 
	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions() 
	{
		$db = JFactory::getDBO();
		$query = 'select id, term, trans from #__lugat_db_ru2uz_v01';
		$db->setQuery($query);
		$terms = $db->loadObjectList();
		$options = array();
		if ($terms)
		{
			foreach($terms as $term) 
			{
				$options[] = JHtml::_('select.option', $item->id, $item->term, $item->trans);
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}
