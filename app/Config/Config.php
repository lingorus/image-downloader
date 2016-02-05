<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 04.02.2016
 * Time: 13:26
 */

namespace App\Config;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;

class Config
{
	private static $config;

	private function __construct()
	{
	}

	public static function getConfig()
	{
		if (!self::$config){
			self::$config = self::prepareConfig();
		}
		return (new self);
	}

	private static function prepareConfig(){
		$configDirectories = array(dirname(__FILE__).'/../../config');
		$locator = new FileLocator($configDirectories);
		$loaderResolver = new LoaderResolver(array(new \App\ConfigLoader($locator)));
		$ymlConfig = $locator->locate(dirname(__FILE__) . '/../../config/config.yml', null, false);
		return  $loaderResolver->resolve($ymlConfig)->load($ymlConfig);
	}


	public function getParam($name = NULL)
	{
		if (!is_null($name)){
			$config = isset(self::$config[$name]) ? self::$config[$name] : '';
		} else {
			$config = self::$config;
		}
		return $config;
	}
}