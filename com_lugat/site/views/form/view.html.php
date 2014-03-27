<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
class FormViewForm extends JView
{
	// Overwriting JView display method
	function display($tpl = null) 
	{
		// Assign data to the view
		$model =& $this->getModel();	
		$this->top_words = $model->CloudTopCached(); // the cloud of top words
		$this->latest_words = $model->CloudLatestCached(); // the cloud of latest words
		$this->title = $model->GetTitles();
		$this->dic = $model->GetDic();
		$this->id = $model->getID();
		$this->tj_btn = $model->getTJ_btn();
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Display the view
		parent::display($tpl);
	}
}
