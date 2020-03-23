<?php
//

/**
 * Manage policy documents used on the site.
 *
 * Script arguments:
 * - archived=<int> Show only archived versions of the given policy document
 *
 * @package     tool_policy
 * @copyright   2018 David Mudrák <david@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');

$archived = optional_param('archived', 0, PARAM_INT);

admin_externalpage_setup('tool_policy_managedocs', '', ['archived' => $archived]);

$output = $PAGE->get_renderer('tool_policy');

$manpage = new \tool_policy\output\page_managedocs_list($archived);

echo $output->header();
echo $output->render($manpage);
echo $output->footer();
