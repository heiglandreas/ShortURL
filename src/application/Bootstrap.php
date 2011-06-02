<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   hei.gl
 * @package    Bootstrap
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      12.05.2011
 */

/**
 * This is the main Bootstrap-File
 *
 * @category   hei.gl
 * @package    Bootstrap
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      12.05.2011
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoloader()
	{
	    $autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->registerNamespace('ShortUrl');
		$autoloader->pushAutoloader(array('ezcBase', 'autoload'), 'ezc');
	}

	/**
     * Initialize the plugin-system
     *
     * @return void
     */
	protected function _initPlugins ()
	{
		$front = Zend_Controller_Front::getInstance ();
		require_once 'ShortUrl/Controller/Plugin/Auth.php';
		$front -> registerPlugin ( new ShortUrl_Controller_Plugin_Auth () );
	}

	/**
	 * Initialize the configuration
	 *
	 * @return Zend_Config
	 */
	protected function _initConfig()
	{
	    $config = $this->getOptions();
	    Zend_Registry::set('Zend_Config',new Zend_Config($config));
	    return $config;
	}

	/**
	 * Initialize Routing
	 *
	 * @return void
	 */
	protected function _initRoute ()
	{
		$route = new Zend_Controller_Router_Route(
			':shortId',
		    array(
		        'controller' => 'url',
		        'action'     => 'get'
		    )
		);
		Zend_Controller_Front::getInstance () -> getRouter () -> addRoute ( 'short', $route );
	}

	/**
	 * Initialize the translation-system.
	 *
	 * Using the Zend_Translate-key acts as dependencyInjection
	 *
	 * @return void
	 */
	protected function _initTranslate ()
	{
		$translate = new Zend_Translate(
						'xliff',
			            APPLICATION_PATH . DIRECTORY_SEPARATOR . 'locale',
				        null,
						array('scan' => Zend_Translate::LOCALE_DIRECTORY));

		// Eine Log Instanz erstellen
		$writer = new Zend_Log_Writer_Stream(
			APPLICATION_PATH .
			DIRECTORY_SEPARATOR .
			'..' .
			DIRECTORY_SEPARATOR .
			'log' .
			DIRECTORY_SEPARATOR .
			date ( 'Ymd' ) . '-TranslateError.log' );
		$log = new Zend_Log($writer);
		//
		// Diese der Übersetzungs-Instanz hinzufügen
		$translate->setOptions(array(
		     'log' => $log,
		         'logUntranslated' => true));

		Zend_Registry::set('Zend_Translate', $translate);
	}

	/**
	 * Initialize Doctrine
	 *
	 *  @return void
	 */
	protected function _initDoctrine()
	{
		// include and register Doctrine's class loader
		require_once('Doctrine/Common/ClassLoader.php');
		$classLoader = new \Doctrine\Common\ClassLoader(
			'Doctrine'
			);
		$classLoader->register();

		// create the Doctrine configuration
		$config = new \Doctrine\ORM\Configuration();

		// setting the cache ( to ArrayCache. Take a look at
		// the Doctrine manual for different options ! )
		$cache = new \Doctrine\Common\Cache\ArrayCache;
		$config->setMetadataCacheImpl($cache);
		$config->setQueryCacheImpl($cache);

		// choosing the driver for our database schema
		// we'll use annotations
		$driver = $config->newDefaultAnnotationDriver(
		             APPLICATION_PATH . '/models'
		          );
		$config->setMetadataDriverImpl($driver);
        // set the proxy dir and set some options
        $config->setProxyDir(APPLICATION_PATH . '/proxies');
        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyNamespace('App\Proxies');

        // now create the entity manager and use the connection
        // settings we defined in our application.ini
        $conf = new Zend_Config_Ini ( APPLICATION_PATH . '/configs/database.ini', APPLICATION_ENV );

	    $entityManager = \Doctrine\ORM\EntityManager::create($conf -> toArray (), $config);
	    if($conf->encoding){
	        $entityManager->getConnection()->setCharset($conf->encoding);
	    }
	    // push the entity manager into our registry for later use
	    Zend_Registry::set('entityManager', $entityManager);
	    return $entityManager;
	}

	/**
	 * Initialize the logging system
	 *
	 * @return Zend_Log
	 */
	protected function _initLog()
	{
	    $log = new Zend_Log();
	    $logOptions = new Zend_Config_Xml( APPLICATION_PATH . '/configs/logs.ini.xml', APPLICATION_ENV);
	    foreach($logOptions->writers as $writer ){
	        $myWriter = new $writer->type(strftime($writer->url));
	        if($writer->filters){
	            foreach($writer->filters as $filter){
	                $myFilter = new $filter->type((int)$filter->options);
	                $myWriter->addFilter($myFilter);
	            }
	        }
	        if($writer->formatter){
	            $myFormatter = new $writer->formatter->type($writer->formatter->options);
	            $myWriter->setFormatter($myFormatter);
	        }
	        $log->addWriter($myWriter);
	    }
	    Zend_Registry::set('Zend_Log',$log);
	    return $log;
	}
}
