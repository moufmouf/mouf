<?php
/**
 * This is a file automatically generated by the Mouf framework. Do not modify it, as it could be overwritten.
 */
use Mouf\MoufManager;
use Interop\Container\ContainerInterface;
MoufManager::initMoufManager('/home/david/projects/mouf/mouf2/vendor/mouf/mouf/src/Mouf/../../mouf/instances.php', 'Mouf\\AdminContainer', 'src-dev/Mouf/AdminContainer.php', 'mouf/config_tpl.php', 'mouf/variables.php');
$moufManager = MoufManager::getMoufManager();

$moufManager->getConfigManager()->setConstantsDefinitionArray([]);

$moufManager->setAllVariables(array (
));

unset($moufManager);
/**
 * Bridge class to enable compatibility with Mouf 2.0
 *
 * @deprecated
 */
class MoufAdmin {
	public static function __callstatic($name, $arguments) {
		if (substr($name, 0, 3) == "get") {
			$moufManager = MoufManager::getMoufManager();
			$uppercaseInstanceName = substr($name, 3);
			if ($uppercaseInstanceName) {
				$lowercaseInstanceName = strtolower(substr($uppercaseInstanceName, 0 , 1)).substr($uppercaseInstanceName, 1);
				if ($moufManager->has($lowercaseInstanceName)) {
					return $moufManager->get($lowercaseInstanceName);
				}
				$lowercaseInstanceName = str_replace("_", ".", $lowercaseInstanceName);
				if ($moufManager->has($lowercaseInstanceName)) {
					return $moufManager->get($lowercaseInstanceName);
				}
				if ($moufManager->has($uppercaseInstanceName)) {
					return $moufManager->get($uppercaseInstanceName);
				}
				$uppercaseInstanceName = str_replace("_", ".", $uppercaseInstanceName);
				if ($moufManager->has($uppercaseInstanceName)) {
					return $moufManager->get($uppercaseInstanceName);
				}
			}
				
		}

		throw new Mouf\MoufException("Unknown method '$name' in MoufAdmin class.");
	}
}
