<?php
//

/**
 * View all document policy with a version, one under another.
 *
 * Script parameters:
 *  -
 *
 * @package     tool_policy
 * @copyright   2018 Sara Arjona (sara@moodle.com)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use tool_policy\api;
use tool_policy\output\page_viewalldoc;

// Do not check for the site policies in require_login() to avoid the redirect loop.
define('NO_SITEPOLICY_CHECK', true);

// @codingStandardsIgnoreLine See the {@link page_viewalldoc} for the access control checks.
require(__DIR__.'/../../../config.php');

$returnurl = optional_param('returnurl', '', PARAM_LOCALURL); // A return URL.

$viewallpage = new page_viewalldoc($returnurl);

$output = $PAGE->get_renderer('tool_policy');

echo $output->header();
echo $output->render($viewallpage);
echo $output->footer();
