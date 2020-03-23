<?php
//

/**
 * Profiling tool settings.
 *
 * @package    tool
 * @subpackage profiling
 * @copyright  2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// Profiling tool, added to development.
$hasextension = extension_loaded('tideways_xhprof');
$hasextension = $hasextension || extension_loaded('tideways');
$hasextension = $hasextension || extension_loaded('xhprof');
$isenabled = !empty($CFG->profilingenabled) || !empty($CFG->earlyprofilingenabled);
if ($hasextension && $isenabled) {
    $ADMIN->add('development', new admin_externalpage('toolprofiling', get_string('pluginname', 'tool_profiling'),
            "$CFG->wwwroot/$CFG->admin/tool/profiling/index.php", 'moodle/site:config'));
}
