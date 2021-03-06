<?php
//

/**
 * Adds data generator support
 *
 * @package    core
 * @category   test
 * @copyright  2012 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: MOODLE_INTERNAL is not verified here because we load this before setup.php!

require_once(__DIR__.'/data_generator.php');
require_once(__DIR__.'/component_generator_base.php');
require_once(__DIR__.'/module_generator.php');
require_once(__DIR__.'/block_generator.php');
require_once(__DIR__.'/repository_generator.php');

