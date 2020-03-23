<?php

//

/**
 * Defines restore_local_plugin class
 *
 * @package    core_backup
 * @subpackage moodle2
 * @category   backup
 * @copyright  2011 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Class extending standard restore_plugin in order to implement some
 * helper methods related with local plugins
 */
abstract class restore_local_plugin extends restore_plugin {}