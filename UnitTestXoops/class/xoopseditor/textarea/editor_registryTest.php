<?php
require_once(dirname(__FILE__).'/../../../init.php');

global $config;
$config = null;

/**
* PHPUnit special settings :
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class Textarea_Editor_registryTest extends MY_UnitTestCase
{

    public function test_100()
    {
		global $config;
		
		ob_start();
		require_once (XOOPS_ROOT_PATH.'/class/xoopseditor/textarea/language/english.php');
		require_once (XOOPS_ROOT_PATH.'/class/xoopseditor/textarea/editor_registry.php');
		$x = ob_get_clean();
		$this->assertTrue(is_array($config));
		$this->assertTrue(isset($config['class']));
		$this->assertTrue(isset($config['file']));
		$this->assertTrue(isset($config['title']));
		$this->assertTrue(isset($config['order']));
		$this->assertTrue(isset($config['nohtml']));
    }
}
