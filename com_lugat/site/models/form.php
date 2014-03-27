<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
class FormModelForm extends JModelItem
{
	/**
	 * @var string msg
	 */

	function __construct() {
		parent::__construct();
		
		// take subscriber number and add prefix
		$this->_dic = JRequest::getCmd('dic', 'ru2tj');
	}
	
	function CloudTopCached() {
		$fname = JPATH_COMPONENT.DS."cache".DS."topwords_".$this->_dic.".txt";
		$topwords = file_get_contents($fname);
		return $topwords;
	}
	
	function CloudLatestCached() {
		$fname = JPATH_COMPONENT.DS."cache".DS."latestwords_".$this->_dic.".txt";
		$latest_words = file_get_contents($fname);
		return $latest_words;
	}
	
	function GetDic() {
		return $this->_dic;
	}
	
	function GetTitles() {
		$title = array();
		switch($this->_dic) {
		case 'ru2tj':
			$title = array (
			"page_head" => "Русско-таджикский словарь",
			"your_search" => "Ваш поиск",
			"enter" => "Введите русское слово",
			"button" => "перевод",
			"total_amount"  => "Русско-таджикский словарь онлайн содержит 69098 слов.",
			"latest_words" => "Недавно найденные слова",
			"top_words"   => "Популярные слова"
			);
			break;
		case 'en2tj':
			$title = array (
			"page_head" => "English-Tajik Dictionary",
			"your_search" => "Your search",
			"enter" => "Enter English word",
			"button" => "translate",
			"total_amount"  => "English-tajik dictionary consists of 4121 words.",
			"latest_words" => "Last found words",
			"top_words"   => "Popular words"
			);
			break;
		case 'tj2en':
			$title = array (
			"page_head" => "Tajik-English Dictionary",
			"your_search" => "Your search",
			"enter" => "Enter Tajik word",
			"button" => "translate",
			"total_amount"  => "Tajik-English dictionary consists of 25050 words.",
			"latest_words" => "Last found words",
			"top_words"   => "Popular words"
			);
			break;
		case 'tj2ru':
			$title = array (
			"page_head" => "Таджикско-русский словарь",
			"your_search" => "Ваш поиск",
			"enter" => "Введите таджикское слово",
			"button" => "перевод",
			"total_amount"  => "Таджикско-русский словарь онлайн содержит 40057 слов.",
			"latest_words" => "Недавно найденные слова",
			"top_words"   => "Популярные слова"
			);
			break;
		case 'ru2uz':
			$title = array (
			"page_head" => "Русско-узбекский словарь",
			"your_search" => "Ваш поиск",
			"enter" => "Введите русское слово",
			"button" => "перевод",
			"total_amount"  => "Русско-узбекский словарь онлайн содержит 10174 слов.",
			"latest_words" => "Недавно найденные слова",
			"top_words"   => "Популярные слова"
			);
			break;
		}
		
		return $title;
	}
  
	function getID() {
		// Data load from database by given id 
		$db = & JFactory::getDBO();
		$db->setQuery( "SELECT id FROM #__lugat_descript WHERE dic='".$this->_dic."'");
		return $db->loadResult();
	}
  
	function getTJ_btn() {
		$result = (substr($this->_dic,0,2) == 'tj')?true:false;
		return $result;
	}
}
