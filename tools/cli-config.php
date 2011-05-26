<?php
/**
 * @__LICENSE_TEXT__@
 *
 * Configuration file for the Doctrine-CLI
 *
 * @category   hei.gl
 * @package    Tools
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      12.05.2011
 */
// Setup Autoloader (1)
// See :doc:`Configuration <../reference/configuration>` for up to date autoloading details.

$config = new Doctrine\ORM\Configuration(); // (2)

// Proxy Configuration (3)
$config->setProxyDir(__DIR__.'/../src/application/proxies');
$config->setProxyNamespace('hei.gl\Proxies');
$config->setAutoGenerateProxyClasses((APPLICATION_ENV == "development"));

// Mapping Configuration (4)
$driverImpl = new Doctrine\ORM\Mapping\Driver\XmlDriver(__DIR__."/config/mappings/xml");
//$driverImpl = new Doctrine\ORM\Mapping\Driver\XmlDriver(__DIR__."/config/mappings/yml");
//$driverImpl = $config->newDefaultAnnotationDriver(__DIR__."/entities");
$config->setMetadataDriverImpl($driverImpl);

// Caching Configuration (5)
if (APPLICATION_ENV == "development") {
    $cache = new \Doctrine\Common\Cache\ArrayCache();
} else {
    $cache = new \Doctrine\Common\Cache\ApcCache();
}
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

// database configuration parameters (6)
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);

// obtaining the entity manager (7)
$evm = new Doctrine\Common\EventManager();
$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config, $evm);


$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager)
));
$cli->setHelperSet($helperSet);