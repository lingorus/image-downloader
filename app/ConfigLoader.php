<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 04.02.2016
 * Time: 11:27
 */

namespace App;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;


class ConfigLoader extends FileLoader
{
	public function load($resource, $type = null)
	{
		$configValues = Yaml::parse(file_get_contents($resource));
		return $configValues;
	}

	public function supports($resource, $type = null)
	{
		return is_string($resource) && 'yml' === pathinfo(
			$resource,
			PATHINFO_EXTENSION
		);
	}
}