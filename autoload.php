<?php

/**
 * Auto loads files to be called by the index
 */

if (!function_exists('__autoload')) {
	function __autoload($classname) {
		@include_once("./$classname.php");
		@include_once("./Services/$classname.php");
		@include_once("./Models/$classname.php");
		@include_once("./Repository/$classname.php");
		@include_once("./Database/$classname.php");
		@include_once("./Exceptions/$classname.php");
		@include_once("./Lib/$classname.php");
	}
}
