<?php
//

/**
 * Configuration page.
 *
 * @package   tool_usertours
 * @copyright 2016 Andrew Nicols <andrew@nicols.co.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$action = optional_param('action', \tool_usertours\manager::ACTION_LISTTOURS, PARAM_ALPHANUMEXT);

$pluginmanager = new \tool_usertours\manager();
$PAGE->set_context(context_system::instance());

$pluginmanager->execute(
        $action
    );
