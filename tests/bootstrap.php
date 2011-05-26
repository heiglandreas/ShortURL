<?php
/**
 * $Id$
 *
 * @__LICENSE__@
 *
 * This is the main Bootstrap-File for PHPUnit
 *
 * @category   Tools
 * @package    hei.gl
 * @subpackage UnitTests
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    GIT: @__VERSION__@
 * @since      25.03.2011
 */
// TODO: check include path
ini_set ( 'date.timezone', 'Europe/Berlin' );

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../src/application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/library'),
    '/Volumes/Sites/Sites/doctrine-orm',
    '/Volumes/Sites/Sites/zf/library',
    get_include_path(),
)));

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();