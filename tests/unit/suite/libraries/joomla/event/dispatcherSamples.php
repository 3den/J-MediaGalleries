<?php
/**
 * @version		$Id: dispatcherSamples.php 16306 2010-04-21 18:47:28Z louis $
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

function myTestHandler($returnArgs = false, $returnValue = '12345') {
	static $args = array();

	if($returnArgs === true) {
		$returnArgs = $args;
		$args = array();
		return $returnArgs;
	} else {
		$args[] = func_get_args();
		return $returnValue;
	}
}


class myTestClassHandler
{
	public static $observables = array();

	public function __construct($observable)
	{
		self::$observables[] = $observable;
	}
}