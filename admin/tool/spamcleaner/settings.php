<?php
//

/**
 * Link to spamcleaner.
 *
 * For now keep in Reports folder, we should move it elsewhere once we deal with contexts in general reports and navigation
 *
 * @package    tool
 * @subpackage unsuproles
 * @copyright  2011 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('reports', new admin_externalpage('toolspamcleaner', get_string('pluginname', 'tool_spamcleaner'), "$CFG->wwwroot/$CFG->admin/tool/spamcleaner/index.php", 'moodle/site:config'));
}

