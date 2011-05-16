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

ini_set('include_path', ini_get('include_path')
                        . PATH_SEPARATOR . dirname(__FILE__) . '/../src'
                        );