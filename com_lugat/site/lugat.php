<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// specific controller?
// Require specific controller if requested
//if no controller then default controller = 'form'
$controller = JRequest::getVar('controller','form' );

//set the controller page  
require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');

$classname  = $controller.'controller';

//create a new class
$controller = new $classname( array('default_task' => 'display') );

// Perform the Request task
$controller->execute( JRequest::getVar('task' ));

// Redirect if set by the controller
$controller->redirect();

?>