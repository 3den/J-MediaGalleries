<?php
/**
 * Joomla! v1.5 Unit Test Facility
 *
 * @package Joomla
 * @subpackage UnitTest
 * @copyright Copyright (C) 2005 - 2010 Open Source Matters, Inc.
 * @version $Id: JFolderTest.php 16235 2010-04-20 04:13:25Z pasamio $
 *
 */


jimport( 'joomla.filesystem.folder' );

require_once 'JFolder-helper-dataset.php';

/**
 * A unit test class for JRequest
 */
class JFolderTest_static extends PHPUnit_Framework_TestCase
{

	static public function makeSafeData() {
		return JFolderTest_DataSet::$makeSafeTests;
	}

	/**
	 * @dataProvider makeSafeData
	 */
	public function testMakeSafeFromDataSet($path, $expect) {
		$actual = JFolder::makeSafe($path);
		$this->assertEquals($expect, $actual);
	}

}

