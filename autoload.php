<?php

/**
 * Auto loads files to be called by the index
 */

if (!function_exists('__autoload')) {
	function __autoload($classname) {
		@require_once("./$classname.php");
		@require_once("./Services/$classname.php");
		@require_once("./Models/$classname.php");
		@require_once("./Repository/$classname.php");
		@require_once("./Database/$classname.php");
		@require_once("./Exceptions/$classname.php");
		@require_once("./Lib/$classname.php");
	}
}
