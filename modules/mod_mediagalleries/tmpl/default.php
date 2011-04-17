<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 

//Printing all the parameters
foreach($gallery as $key=>$value)
	{
		print $key."->".$value;
		print "<br/>";
	}

?>