<?php
//

/**
 * Display environment used for running behat.
 *
 * This file is used for behat testing to ensure cli and apache
 * version of environment is same.
 *
 * @package    tool_behat
 * @copyright  2016 onwards Rajesh Taneja
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../../../../../config.php');

// Only continue for behat site.
defined('BEHAT_SITE_RUNNING') ||  die();

require_once($CFG->libdir.'/behat/classes/util.php');
echo json_encode(behat_util::get_environment(), true);
