<?php
//

/**
 * Class for exporting competency data.
 *
 * @package    core_competency
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_competency\external;
defined('MOODLE_INTERNAL') || die();

/**
 * Class for exporting competency data.
 *
 * @copyright  2015 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class competency_exporter extends \core\external\persistent_exporter {

    protected static function define_class() {
        return \core_competency\competency::class;
    }

    protected static function define_related() {
        // We cache the context so it does not need to be retrieved from the framework every time.
        return array('context' => '\\context');
    }
}
