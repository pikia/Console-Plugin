<?php 

namespace Pikia\Plugins\Console;

use Pikia\Kernel\Resources\Libs;
use Pikia\Kernel\Plugins\Plugins;
use Pikia\Kernel\Objects\Strings;
use Pikia\Kernel\Config\Config;
use Pikia\Kernel\Console\Console as cnsl;



class Response
{
	
	protected static $commands = array();

	public static function exec()
	{
		self::commands();
		die();
		//
		$command = $_POST['input_text'];
		//
		$command = self::input($command);
		//
		$response = self::switcher($command);
		//
		self::output($response);
	}

	protected static function input($input)
	{
		return Strings::trim($input);
	}

	protected static function output($output)
	{
		echo $output;
	}

	protected static function switcher($command)
	{
		switch ($command) {
			case 'login': return "please fill the password"; break;
			case 'hello': return "<div class='info'>Hello ".Config::get('app.owner').", how are you ?</div>" ; break;
			default : return "<div class='error'>I'm sorry ".Config::get('app.owner').", command '$command' not found.</div>" ; break;
		}
	}

	protected static function commands()
	{
		self::$commands = cnsl::getKernelClasses();
		$g = array();
		foreach (self::$commands as $key => $value) {
			$g[] = new $value;
		}
		//
		echo "<pre>";
		print_r($g);
	}
}
